<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Label;
use App\Models\ListModel;

class SubmitReleaseController extends Controller
{
    public function create()
    {
        $labels = Label::select('label_id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        $countries = DB::table('releases')
            ->select('country')
            ->whereNotNull('country')
            ->distinct()
            ->orderBy('country', 'asc')
            ->get();

        $genres = DB::table('genres')
            ->orderBy('name', 'asc')
            ->get();

        $dbFormats = DB::table('formats')->get();

        return view('release.add', compact(
            'labels',
            'countries',
            'genres',
            'dbFormats'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artists' => 'required|array',
            'submission_notes' => 'required|string',
        ]);

        DB::beginTransaction();

        try {


            $masterId = DB::table('master_albums')->insertGetId([
                'title' => $request->title,

                'year' => $request->release_date
                    ? date('Y', strtotime($request->release_date))
                    : null,
            ]);

            
            $catalogNumberUtama = null;

            if (
                $request->has('catalog_nos') &&
                is_array($request->catalog_nos)
            ) {
                $catalogNumberUtama =
                    $request->catalog_nos[0] ?? null;
            }

            

            $barcodeUtama = null;

            if (
                $request->has('identifiers_type') &&
                is_array($request->identifiers_type)
            ) {

                foreach ($request->identifiers_type as $idx => $type) {

                    if ($type === 'Barcode') {

                        $barcodeUtama =
                            $request->identifiers_value[$idx] ?? null;

                        break;
                    }
                }
            }


            $combinedNotes =
                ($request->notes ?? '') .
                "\n\n[Submission Notes]: " .
                $request->submission_notes;

            

            $releaseId = DB::table('releases')->insertGetId([
                'master_id'      => $masterId,
                'title'          => $request->title,
                'country'        => $request->country,
                'release_date'   => $request->release_date,
                'notes'          => trim($combinedNotes),
                'catalog_number' => $catalogNumberUtama,
                'barcode'        => $barcodeUtama,
            ]);

            

            if ($request->has('artists')) {

                foreach ($request->artists as $index => $artistName) {

                    if (!empty($artistName)) {

                        $artist = DB::table('artists')
                            ->where('name', $artistName)
                            ->first();

                        if ($artist) {

                            $artistId = $artist->artist_id;

                        } else {

                            $artistId = DB::table('artists')
                                ->insertGetId([
                                    'name' => $artistName,
                                ]);
                        }

                        DB::table('artist_release')->insert([
                            'artist_id'  => $artistId,
                            'release_id' => $releaseId,
                            'role'       => 'Main',
                        ]);
                    }
                }
            }

            

            if ($request->has('label_types')) {

                foreach ($request->label_types as $index => $labelId) {

                    if (!empty($labelId)) {

                        DB::table('label_release')->insert([
                            'label_id'        => $labelId,
                            'release_id'      => $releaseId,

                            'catalog_number' =>
                                $request->catalog_nos[$index] ?? null,
                        ]);
                    }
                }
            }

            

            if ($request->has('formats')) {

                foreach ($request->formats as $formatName) {

                    if (!empty($formatName)) {

                        $formatMaster = DB::table('formats')
                            ->where('name', $formatName)
                            ->first();

                        if ($formatMaster) {

                            $formatId = $formatMaster->format_id;

                        } else {

                            $formatId = DB::table('formats')
                                ->insertGetId([
                                    'name' => $formatName
                                ]);
                        }

                        DB::table('format_release')->insert([
                            'release_id' => $releaseId,
                            'format_id'  => $formatId,
                            'is_limited' => 0,
                        ]);
                    }
                }
            }

            

            if ($request->has('track_titles')) {

                foreach ($request->track_titles as $index => $trackTitle) {

                    if (!empty($trackTitle)) {

                        $duration = null;

                        if (!empty($request->track_durations[$index])) {

                            $parts = explode(
                                ':',
                                $request->track_durations[$index]
                            );

                            if (count($parts) == 2) {

                                $duration =
                                    '00:' .
                                    $parts[0] .
                                    ':' .
                                    $parts[1];
                            }
                        }

                        DB::table('tracks')->insert([
                            'release_id' => $releaseId,

                            'position' =>
                                $request->track_positions[$index]
                                ?? ($index + 1),

                            'title' =>
                                $trackTitle,

                            'duration' =>
                                $duration,
                        ]);
                    }
                }
            }

            

            if ($request->has('identifiers_type')) {

                $allowedTypes = [
                    'Barcode',
                    'Rights Society',
                    'Matrix / Runout',
                    'Other'
                ];

                foreach ($request->identifiers_type as $index => $type) {

                    $type = trim($type);

                    // skip kalau kosong
                    if (empty($type)) {
                        continue;
                    }

                    // skip kalau bukan enum valid
                    if (!in_array($type, $allowedTypes)) {
                        continue;
                    }

                    DB::table('identifiers')->insert([

                        'release_id' => $releaseId,

                        'type' => $type,

                        'value' =>
                            $request->identifiers_value[$index]
                            ?? null,

                        'description' =>
                            $request->identifiers_desc[$index]
                            ?? null,

                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }


            if (
                $request->has('genres') &&
                is_array($request->genres)
            ) {

                foreach ($request->genres as $genreName) {

                    $genreDb = DB::table('genres')
                        ->where('name', $genreName)
                        ->first();

                    if ($genreDb) {

                        DB::table('genre_release')->insert([
                            'release_id' => $releaseId,
                            'genre_id'   => $genreDb->genre_id,
                        ]);
                    }
                }
            }

            DB::commit();

            // return redirect()
            //     ->route('releases.create')
            //     ->with(
            //         'success',
            //         'Data Release berhasil masuk ke Database!'
            //     );

            return redirect()->route('releases.preview', ['id' => $releaseId]);

        } catch (\Exception $e) {

            DB::rollBack();

            dd($e->getMessage());
        }
    }

    
public function preview($id)
{
    $release = DB::table('releases')->where('release_id', $id)->firstOrFail();

    $artists = DB::table('artist_release')
        ->join('artists', 'artist_release.artist_id', '=', 'artists.artist_id')
        ->where('artist_release.release_id', $id)
        ->pluck('artists.name')
        ->join(', ');

    $labels = DB::table('label_release')
        ->join('labels', 'label_release.label_id', '=', 'labels.label_id')
        ->where('label_release.release_id', $id)
        ->select('labels.name', 'label_release.catalog_number')
        ->get();

    $formats = DB::table('format_release')
        ->join('formats', 'format_release.format_id', '=', 'formats.format_id')
        ->where('format_release.release_id', $id)
        ->pluck('formats.name')
        ->join(', ');

    $genres = DB::table('genre_release')
        ->join('genres', 'genre_release.genre_id', '=', 'genres.genre_id')
        ->where('genre_release.release_id', $id)
        ->pluck('genres.name')
        ->join(', ');

    $tracks = DB::table('tracks')
        ->where('release_id', $id)
        ->orderBy('position')
        ->get();

    $image = DB::table('images')
        ->where('release_id', $id)
        ->first();

    return view('release.preview', compact(
        'release', 'artists', 'labels',
        'formats', 'genres', 'tracks', 'image'
    ));
}
}