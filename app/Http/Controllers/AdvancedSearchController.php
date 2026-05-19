<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvancedSearchController extends Controller
{
    public function index()
    {
        return view('search.advanced');
    }

    public function search(Request $request)
    {
        $perPage = $request->get('per_page', 25);
        $type = $request->get('type', 'all');
        
        // --- DATA SIDEBAR UNTUK HASIL PENCARIAN ---
        $Genre = DB::table('genres')
            ->leftJoin('genre_release', 'genres.genre_id', '=', 'genre_release.genre_id')
            ->select('genres.genre_id', 'genres.name', DB::raw('count(genre_release.release_id) as releases_count'))
            ->groupBy('genres.genre_id', 'genres.name')->orderBy('releases_count', 'desc')->get();

        $Style = DB::table('styles')
            ->leftJoin('release_style', 'styles.style_id', '=', 'release_style.style_id')
            ->select('styles.style_id', 'styles.name', DB::raw('count(release_style.release_id) as releases_count'))
            ->groupBy('styles.style_id', 'styles.name')->orderBy('releases_count', 'desc')->get();

        $Format = DB::table('formats')
            ->leftJoin('format_release', 'formats.format_id', '=', 'format_release.format_id')
            ->select('formats.format_id', 'formats.name', DB::raw('count(format_release.format_id) as releases_count'))
            ->groupBy('formats.format_id', 'formats.name')->orderBy('releases_count', 'desc')->get();

        $Country = DB::table('releases')
            ->select('country', DB::raw('count(release_id) as releases_count'))
            ->whereNotNull('country')->where('country', '!=', '')
            ->groupBy('country')->orderBy('releases_count', 'desc')->get();

        $Decade = DB::table('master_albums')
            ->select(DB::raw('FLOOR(year / 10) * 10 AS decade'), DB::raw('count(master_id) as releases_count'))
            ->whereNotNull('year')->where('year', '>', 0)
            ->groupBy('decade')->orderBy('releases_count', 'desc')->get();

        // --- 1. QUERY MASTER ---
        $masterQuery = DB::table('master_albums as ma')
            ->select('ma.master_id', DB::raw('NULL as release_id'), 'ma.title as judul', 'ma.year as tahun', 
                     DB::raw('MIN(ar.name) as nama_artis'), DB::raw('MIN(img.url) as foto'), DB::raw("'MASTER RELEASE' as format_name"))
            ->leftJoin('releases as r', 'ma.master_id', '=', 'r.master_id')
            ->leftJoin('artist_release as art_rel', 'r.release_id', '=', 'art_rel.release_id')
            ->leftJoin('artists as ar', 'art_rel.artist_id', '=', 'ar.artist_id')
            ->leftJoin('images as img', 'r.release_id', '=', 'img.release_id')
            ->groupBy('ma.master_id', 'ma.title', 'ma.year');

        // --- 2. QUERY RELEASE ---
        $releaseQuery = DB::table('releases as r')
            ->select('ma.master_id', 'r.release_id', 'r.title as judul', 'ma.year as tahun',
                     DB::raw('MIN(ar.name) as nama_artis'), DB::raw('MIN(img.url) as foto'), 
                     DB::raw('MIN(f.name) as format_name'))
            ->leftJoin('master_albums as ma', 'r.master_id', '=', 'ma.master_id')
            ->leftJoin('artist_release as art_rel', 'r.release_id', '=', 'art_rel.release_id')
            ->leftJoin('artists as ar', 'art_rel.artist_id', '=', 'ar.artist_id')
            ->leftJoin('images as img', 'r.release_id', '=', 'img.release_id')
            ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
            ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')
            ->groupBy('ma.master_id', 'r.release_id', 'r.title', 'ma.year');

        // --- 3. QUERY ARTIST ---
        $artistQuery = DB::table('artists as a')
            ->select('a.artist_id as master_id', DB::raw('NULL as release_id'), 'a.name as judul', DB::raw('NULL as tahun'),
                     'a.name as nama_artis', 'a.image as foto', DB::raw("'ARTIST' as format_name"))
            ->groupBy('a.artist_id', 'a.name', 'a.image');

        // --- 4. QUERY LABEL ---
        $labelQuery = DB::table('labels as l')
            ->select('l.label_id as master_id', DB::raw('NULL as release_id'), 'l.name as judul', DB::raw('NULL as tahun'),
                     'l.name as nama_artis', DB::raw('NULL as foto'), DB::raw("'LABEL' as format_name"))
            ->groupBy('l.label_id', 'l.name');


        $applyFilters = function($q) use ($request) {
            if ($request->filled('title')) $q->where('ma.title', 'like', '%' . $request->title . '%');
            if ($request->filled('artist')) $q->where('ar.name', 'like', '%' . $request->artist . '%');
            if ($request->filled('year')) $q->where('ma.year', 'like', $request->year . '%');
            if ($request->filled('country')) $q->where('r.country', 'like', '%' . $request->country . '%');
            if ($request->filled('catno')) $q->where('r.catalog_number', 'like', '%' . $request->catno . '%');
            if ($request->filled('barcode')) $q->where('r.barcode', 'like', '%' . $request->barcode . '%');
            if ($request->filled('genre')) {
                $q->join('genre_release as gr_f', 'r.release_id', '=', 'gr_f.release_id')
                  ->join('genres as g_f', 'gr_f.genre_id', '=', 'g_f.genre_id')
                  ->where('g_f.name', 'like', '%' . $request->genre . '%');
            }
            if ($request->filled('style')) {
                $q->join('release_style as rs_f', 'r.release_id', '=', 'rs_f.release_id')
                  ->join('styles as s_f', 'rs_f.style_id', '=', 's_f.style_id')
                  ->where('s_f.name', 'like', '%' . $request->style . '%');
            }
            if ($request->filled('label')) {
                $q->join('label_release as lr_f', 'r.release_id', '=', 'lr_f.release_id')
                  ->join('labels as l_f', 'lr_f.label_id', '=', 'l_f.label_id')
                  ->where('l_f.name', 'like', '%' . $request->label . '%');
            }
            if ($request->filled('format')) {
                $q->join('format_release as fr_f', 'r.release_id', '=', 'fr_f.release_id')
                  ->join('formats as f_f', 'fr_f.format_id', '=', 'f_f.format_id')
                  ->where('f_f.name', 'like', '%' . $request->format . '%');
            }
            if ($request->filled('track')) {
                $q->join('tracks as t_f', 'r.release_id', '=', 't_f.release_id')
                  ->where('t_f.title', 'like', '%' . $request->track . '%');
            }
            if ($request->filled('credit')) {
                $q->where('art_rel.role', 'like', '%' . $request->credit . '%');
            }
            if ($request->filled('anv')) {
                $q->join('artist_variations as av_f', 'ar.artist_id', '=', 'av_f.artist_id')
                  ->where('av_f.variation_name', 'like', '%' . $request->anv . '%');
            }
        };

        $applyFilters($masterQuery);
        $applyFilters($releaseQuery);

        // --- FUNGSI FILTER UNTUK ARTIST & LABEL ---
        if ($request->filled('title') || $request->filled('artist')) {
            $keyword = $request->title ?: $request->artist;
            $artistQuery->where('a.name', 'like', '%' . $keyword . '%');
        }
        if ($request->filled('title') || $request->filled('label')) {
            $keyword = $request->title ?: $request->label;
            $labelQuery->where('l.name', 'like', '%' . $keyword . '%');
        }

        // --- GABUNGKAN / FILTER BERDASARKAN TIPE ---
        if ($type == 'all') {
            $union = $masterQuery->unionAll($releaseQuery)->unionAll($artistQuery)->unionAll($labelQuery);
            
            // subquery untuk menggabungkan hasil query master, release, artist, dan label
            $albums = DB::table(DB::raw("({$union->toSql()}) as combined"))
                ->mergeBindings($union)->paginate($perPage);

        } elseif ($type == 'master') {
            $albums = $masterQuery->paginate($perPage);
        } elseif ($type == 'artist') {
            $albums = $artistQuery->paginate($perPage);
        } elseif ($type == 'label') {
            $albums = $labelQuery->paginate($perPage);
        } else {
            $albums = $releaseQuery->paginate($perPage);
        }

        // --- COUNT UNTUK SIDEBAR/NAV ---
        $countRelease = DB::table('releases')->count();
        $countMaster = DB::table('master_albums')->count();
        $countArtist = DB::table('artists')->count();
        $countLabel = DB::table('labels')->count();
        $countAll = $countRelease + $countMaster + $countArtist + $countLabel;

        // Bawa data query string agar pagination tidak hilang pas pindah halaman
        $albums->appends($request->all());

        return view('search', compact(
            'Genre', 'Style', 'Format', 'Country', 'Decade', 'albums',
            'countAll', 'countRelease', 'countMaster', 'countArtist', 'countLabel'
        ));
    }
}
