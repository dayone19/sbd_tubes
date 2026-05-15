<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\MasterAlbum;
use App\Models\Label;
use App\Models\Release;

class NavbarSearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->query('query');
        $type    = $request->query('type', 'all');

        $results = collect();

        // === ARTISTS ===
        if ($type == 'all' || $type == 'artists') {
            $artists = Artist::where('name', 'LIKE', "%{$keyword}%")
                ->limit(5)->get()
                ->map(fn($item) => [
                    'name'     => $item->name,
                    'type'     => 'ARTIST',
                    'img'      => $item->image ?? 'https://via.placeholder.com/150',
                    'category' => 'artists',
                    'url'      => route('show.artist', ['id' => $item->artist_id])
                ]);
            $results = $results->concat($artists);
        }

        // === MASTER RELEASES ===
        if ($type == 'all' || $type == 'masters') {
            $masters = MasterAlbum::with(['releases.artists','releases.images'])
                ->where('title','LIKE',"%{$keyword}%")
                ->limit(5)->get()
                ->map(function($item){
                    $firstRelease = $item->releases->first(fn($rel) => $rel->artists->isNotEmpty());
                    $artistName   = $firstRelease ? $firstRelease->artists->first()->name : 'Unknown Artist';

                    $firstReleaseWithImage = $item->releases->first(fn($rel) => $rel->images->isNotEmpty());
                    $imageUrl = $firstReleaseWithImage
                        ? asset('storage/' . $firstReleaseWithImage->images->first()->url)
                        : null;

                    return [
                        'name'     => $item->title,
                        'type'     => 'MASTER RELEASE',
                        'img'      => $imageUrl,
                        'artist'   => $artistName,
                        'year'     => $item->year ?? '',
                        'category' => 'master',
                        'url'      => route('show.album', ['master_id' => $item->master_id])
                    ];
                });
            $results = $results->concat($masters);
        }

        // === RELEASES ===
        if ($type == 'all' || $type == 'releases') {
            $releases = Release::with(['artists','images','products'])
                ->where('title','LIKE',"%{$keyword}%")
                ->limit(15)->get()
                ->map(function($item){
                    $imgModel = $item->images->first();
                    $minPrice = $item->products->min('price');
                    $maxPrice = $item->products->max('price');

                    return [
                        'name'     => $item->title,
                        'type'     => strtoupper($item->format ?? 'VINYL'),
                        'img'      => $imgModel ? asset('storage/' . $imgModel->url) : null,
                        'artist'   => $item->artists->first()->name ?? 'Unknown Artist',
                        'meta'     => ($item->release_date ?? '1977') . ' • ' . ($item->country ?? 'US'),
                        'price'    => ($minPrice && $maxPrice)
                                        ? '€' . $minPrice . ' – €' . $maxPrice
                                        : 'Price not available',
                        'category' => 'releases',
                        'url'      => route('show.release', ['id' => $item->release_id])
                    ];
                });
            $results = $results->concat($releases);
        }

        // === LABELS ===
        if ($type == 'all' || $type == 'labels') {
            $labels = Label::where('name', 'LIKE', "%{$keyword}%")
                ->limit(10)->get()
                ->map(fn($item) => [
                    'name'     => $item->name,
                    'type'     => 'LABEL',
                    'img'      => $item->image ?? 'https://via.placeholder.com/150',
                    'category' => 'labels',
                    'url'      => route('show.label', ['id' => $item->label_id])
                ]);
            $results = $results->concat($labels);
        }

        return response()->json($results);
    }

}
