<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvancedSearchController extends Controller
{
    public function search(Request $request)
    {
        // 1. Ambil semua input dari form
        $type       = $request->input('type', 'all');
        $title      = $request->input('title');
        $artist     = $request->input('artist');
        $label      = $request->input('label');
        $genre      = $request->input('genre');
        $style      = $request->input('style');
        $track      = $request->input('track');
        $country    = $request->input('country');
        $catalog    = $request->input('catalog');
        $year       = $request->input('year');
        $format     = $request->input('format');
        $credit     = $request->input('credit');
        $sort       = $request->input('sort', 'relevance');
        $perPage    = (int) $request->input('per_page', 25);
        $page       = (int) $request->input('page', 1);

        // 2. Inisialisasi variabel hasil
        $releases = collect();
        $artists  = collect();
        $labels   = collect();
        $masters  = collect();

        $releaseCount = 0;
        $artistCount  = 0;
        $labelCount   = 0;
        $masterCount  = 0;

        // --- A. QUERY RELEASES ---
        if ($type === 'all' || $type === 'release') {
            $qRelease = DB::table('releases as r')
                ->leftJoin('images as i', function ($join) {
                    $join->on('r.release_id', '=', 'i.release_id')
                         ->where('i.type', '=', 'primary');
                })
                ->leftJoin('artist_release as arl', 'r.release_id', '=', 'arl.release_id')
                ->leftJoin('artists as ar', 'arl.artist_id', '=', 'ar.artist_id')
                ->leftJoin('master_albums as m', 'r.master_id', '=', 'm.master_id')
                ->leftJoin('genre_release as gr', 'r.release_id', '=', 'gr.release_id')
                ->leftJoin('genres as g', 'gr.genre_id', '=', 'g.genre_id')
                ->leftJoin('release_style as sr', 'r.release_id', '=', 'sr.release_id')
                ->leftJoin('styles as s', 'sr.style_id', '=', 's.style_id')
                ->leftJoin('label_release as lr', 'r.release_id', '=', 'lr.release_id')
                ->leftJoin('labels as l', 'lr.label_id', '=', 'l.label_id')
                ->leftJoin('products as p', 'r.release_id', '=', 'p.release_id');

            if ($title)   $qRelease->where('r.title', 'LIKE', "%{$title}%");
            if ($artist)  $qRelease->where('ar.name', 'LIKE', "%{$artist}%");
            if ($genre)   $qRelease->where('g.name', 'LIKE', "%{$genre}%");
            if ($style)   $qRelease->where('s.name', 'LIKE', "%{$style}%");
            if ($label)   $qRelease->where('l.name', 'LIKE', "%{$label}%");
            if ($country) $qRelease->where('r.country', 'LIKE', "%{$country}%");
            if ($catalog) $qRelease->where('r.catalog_number', 'LIKE', "%{$catalog}%");
            if ($year)    $qRelease->where('m.year', '=', $year);
            if ($format)  $qRelease->where('p.format', 'LIKE', "%{$format}%");
            if ($credit)  $qRelease->where('arl.role', 'LIKE', "%{$credit}%");
            if ($track) {
                $qRelease->leftJoin('tracks as t', 'r.release_id', '=', 't.release_id')
                         ->where('t.title', 'LIKE', "%{$track}%");
            }

            $qRelease->select(
                'r.release_id', 'r.title', 'r.country', 'r.catalog_number', 'i.url as image',
                DB::raw("GROUP_CONCAT(DISTINCT ar.name SEPARATOR ', ') as artis"),
                DB::raw("GROUP_CONCAT(DISTINCT l.name SEPARATOR ', ') as label_name"),
                DB::raw("GROUP_CONCAT(DISTINCT g.name SEPARATOR ', ') as genre"),
                DB::raw("GROUP_CONCAT(DISTINCT s.name SEPARATOR ', ') as style"),
                'm.year as tahun'
            )->groupBy('r.release_id', 'r.title', 'r.country', 'r.catalog_number', 'i.url', 'm.year');

            $releaseCount = $qRelease->get()->count();
            $releases = $qRelease->offset(($page - 1) * $perPage)->limit($perPage)->get();
        }

        // --- B. QUERY ARTISTS ---
        if ($type === 'all' || $type === 'artist') {
            $qArtist = DB::table('artists as ar');
            if ($title)  $qArtist->where('ar.name', 'LIKE', "%{$title}%");
            if ($artist) $qArtist->where('ar.name', 'LIKE', "%{$artist}%");
            $artistCount = $qArtist->count();
            $artists = $qArtist->orderBy('ar.name')->offset(($page - 1) * $perPage)->limit($perPage)->get();
        }

        // --- C. QUERY LABELS ---
        if ($type === 'all' || $type === 'label') {
            $qLabel = DB::table('labels as l');
            if ($title) $qLabel->where('l.name', 'LIKE', "%{$title}%");
            if ($label) $qLabel->where('l.name', 'LIKE', "%{$label}%");
            $labelCount = $qLabel->count();
            $labels = $qLabel->orderBy('l.name')->offset(($page - 1) * $perPage)->limit($perPage)->get();
        }

        // --- D. QUERY MASTER RELEASES ---
        if ($type === 'all' || $type === 'master') {
            $qMaster = DB::table('master_albums as m');
            if ($title) $qMaster->where('m.title', 'LIKE', "%{$title}%");
            if ($year)  $qMaster->where('m.year', '=', $year);
            $masterCount = $qMaster->count();
            $masters = $qMaster->orderBy('m.title')->offset(($page - 1) * $perPage)->limit($perPage)->get();
        }

        $totalAll = $releaseCount + $artistCount + $labelCount + $masterCount;

        return view('search', compact(
            'releases', 'artists', 'labels', 'masters',
            'releaseCount', 'artistCount', 'labelCount', 'masterCount',
            'totalAll', 'type', 'perPage', 'page'
        ))->withInput($request->all());
    }
}
