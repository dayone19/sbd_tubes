<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\models\Genre;
// use App\models\Style;
// use App\models\Format;
// use App\models\MasterAlbum;
// use App\models\Release;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    
    
public function index() {
        $perPage = request('per_page', 25);

    //  1. Ambil Data Genre + Count query sql
    //     SELECT 
    //     g.genre_id, 
    //     g.name, 
    //     COUNT(gr.release_id) AS total_album
    //  FROM genres g
    //  LEFT JOIN genre_release gr ON g.genre_id = gr.genre_id
    //  GROUP BY g.genre_id, g.name;

   //   1. Ambil Data Genre + Count
        $Genre = DB::table('genres')
            ->leftJoin('genre_release', 'genres.genre_id', '=', 'genre_release.genre_id')
            ->select('genres.genre_id', 'genres.name', DB::raw('count(genre_release.release_id) as releases_count'))
            ->groupBy('genres.genre_id', 'genres.name')
            ->orderBy('releases_count', 'desc')
            ->get();

    //  2. Ambil Data Style + Count query sql
    //     SELECT 
    //     s.style_id, 
    //     s.name, 
    //     COUNT(sr.release_id) AS total_album
    //  FROM styles s
    //  LEFT JOIN style_release sr ON s.style_id = sr.style_id
    //  GROUP BY s.style_id, s.name;

    // 2. Ambil Data Style + Count 
        $Style = DB::table('styles')
            ->leftJoin('release_style', 'styles.style_id', '=', 'release_style.style_id')
            ->select('styles.style_id', 'styles.name', DB::raw('count(release_style.release_id) as releases_count'))
            ->groupBy('styles.style_id', 'styles.name')
            ->orderBy('releases_count', 'desc')
            ->get();

    // 3. Ambil Data Format + Count query sql
//         SELECT
// 	   f.format_id,
//         f.name,
//      COUNT(fr.format_id) AS total_format
//      FROM formats f 
//      LEFT JOIN format_release fr ON f.format_id = fr.format_id
//      group BY f.format_id, f.name;

//     3. Ambil Data Format + Count
         $Format = DB::table('formats')
                ->leftJoin('format_release', 'formats.format_id', '=', 'format_release.format_id')
                ->select('formats.format_id', 'formats.name', DB::raw('count(format_release.format_id) as releases_count'))
                ->groupBy('formats.format_id', 'formats.name')
                ->orderBy('releases_count', 'desc')
                ->get();

//      4. Ambil Data Country query sql
    //     SELECT
//         r.country,
//      COUNT(r.release_id) AS total_country
// 	FROM master_albums ma
//      JOIN releases r ON ma.master_id = r.master_id
//      where r.country is not null and r.country <> ''
//      GROUP BY r.country;

//      4. Ambil Data Country
            $Country = DB::table('master_albums')
                    ->join('releases', 'master_albums.master_id', '=', 'releases.master_id')
                    ->select('releases.country', DB::raw('count(releases.release_id) as releases_count'))
                    ->whereNotNull('releases.country') 
                    ->where('releases.country', '!=', '')
                    ->groupBy('releases.country')
                    ->orderBy('releases_count', 'desc')
                    ->get();

//      5. Ambil Data Decade query sql
//         SELECT
// 	       floor(year / 10) * 10 AS decade,
//         COUNT(master_id) AS release_count
// 	    FROM master_albums
//     	WHERE year is NOT null and year > 0
//     	GROUP BY decade
//     	ORDER by decade DESC;

//      5. Ambil Data Decade
            $Decade = DB::table('master_albums')
                        ->select(
                                DB::raw('FLOOR(year / 10) * 10 AS decade'), 
                                DB::raw('count(master_id) as releases_count') )
                        ->whereNotNull('year')
                        ->where('year', '>', 0)
                        ->groupBy('decade')
                        ->orderBy('releases_count', 'desc')
                        ->get();



    // 6. membuat query find music on Discogs query sql
//     -- Master Release
//        SELECT 
//        ma.master_id,
//        ma.title AS judul,
//        ma.year AS tahun,
//        MIN(ar.name) AS nama_artis,
//        MIN(img.url) AS foto,
//        'MASTER RELEASE' AS format_name
//  FROM master_albums ma
//  JOIN releases r ON ma.master_id = r.master_id
//  JOIN artist_release art_rel ON r.release_id = art_rel.release_id
//  JOIN artists ar ON art_rel.artist_id = ar.artist_id
//  LEFT JOIN images img ON r.release_id = img.release_id
//  GROUP BY ma.master_id, ma.title, ma.year

//  UNION ALL

//     -- Releases dengan format
//        SELECT 
//        ma.master_id,
//        ma.title AS judul,
//        ma.year AS tahun,
//        MIN(ar.name) AS nama_artis,
//        MIN(img.url) AS foto,
//        GROUP_CONCAT(DISTINCT f.name SEPARATOR ', ') AS format_name
//  FROM master_albums ma
//  JOIN releases r ON ma.master_id = r.master_id
//  JOIN artist_release art_rel ON r.release_id = art_rel.release_id
//  JOIN artists ar ON art_rel.artist_id = ar.artist_id
//  LEFT JOIN images img ON r.release_id = img.release_id
//  LEFT JOIN format_release fr ON r.release_id = fr.release_id
//  LEFT JOIN formats f ON fr.format_id = f.format_id
//  GROUP BY ma.master_id, ma.title, ma.year;

    //  6. membuat query find music on Discogs
              // Ambil type dari request
$type = request('type', 'all');

// Ambil filter dari request
$filterGenre = request('genre', []);
$filterStyle = request('style', []);
$filterFormat = request('format', []);
$filterCountry = request('country', []);
$filterDecade = request('decade', []);
$sort = request('sort', 'relevance');

$masterRelease = DB::table('master_albums as ma')
    ->select(
        'ma.master_id',
        DB::raw('NULL as release_id'),
        'ma.title as judul',
        'ma.year as tahun',
        DB::raw('MIN(ar.name) as nama_artis'),
        DB::raw('MIN(img.url) as foto'),
        DB::raw("'MASTER RELEASE' as format_name")
    )
    ->join('releases as r', 'ma.master_id', '=', 'r.master_id')
    ->join('artist_release as art_rel', 'r.release_id', '=', 'art_rel.release_id')
    ->join('artists as ar', 'art_rel.artist_id', '=', 'ar.artist_id')
    ->leftJoin('images as img', 'r.release_id', '=', 'img.release_id')

    ->when($filterGenre, function($q) use ($filterGenre) {
    $ids = implode(',', array_map('intval', $filterGenre));
    $q->join('genre_release as gr', 'r.release_id', '=', 'gr.release_id')
      ->whereRaw("gr.genre_id IN ($ids)");
})
->when($filterStyle, function($q) use ($filterStyle) {
    $ids = implode(',', array_map('intval', $filterStyle));
    $q->join('release_style as rs', 'r.release_id', '=', 'rs.release_id')
      ->whereRaw("rs.style_id IN ($ids)");
})
->when($filterCountry, function($q) use ($filterCountry) {
    $escaped = implode(',', array_map(fn($c) => "'" . addslashes($c) . "'", $filterCountry));
    $q->whereRaw("r.country IN ($escaped)");
})
->when($filterDecade, function($q) use ($filterDecade) {
    $ids = implode(',', array_map('intval', $filterDecade));
    $q->whereRaw("FLOOR(ma.year / 10) * 10 IN ($ids)");
})
    ->groupBy('ma.master_id', 'ma.title', 'ma.year');

$releases = DB::table('master_albums as ma')
    ->select(
        'ma.master_id',
        'r.release_id',
        'ma.title as judul',
        'ma.year as tahun',
        DB::raw('MIN(ar.name) as nama_artis'),
        DB::raw('MIN(img.url) as foto'),
        DB::raw('CONCAT(MIN(f.name), IF(MAX(fr.is_limited) = 1, " • Ltd Edition", "")) as format_name')
    )
    ->join('releases as r', 'ma.master_id', '=', 'r.master_id')
    ->join('artist_release as art_rel', 'r.release_id', '=', 'art_rel.release_id')
    ->join('artists as ar', 'art_rel.artist_id', '=', 'ar.artist_id')
    ->leftJoin('images as img', 'r.release_id', '=', 'img.release_id')
    ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
    ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')

    ->when($filterGenre, function($q) use ($filterGenre) {
    $ids = implode(',', array_map('intval', $filterGenre));
    $q->join('genre_release as gr', 'r.release_id', '=', 'gr.release_id')
      ->whereRaw("gr.genre_id IN ($ids)");
})
->when($filterStyle, function($q) use ($filterStyle) {
    $ids = implode(',', array_map('intval', $filterStyle));
    $q->join('release_style as rs', 'r.release_id', '=', 'rs.release_id')
      ->whereRaw("rs.style_id IN ($ids)");
})
->when($filterFormat, function($q) use ($filterFormat) {
    $ids = implode(',', array_map('intval', $filterFormat));
    $q->whereRaw("fr.format_id IN ($ids)");
})
->when($filterCountry, function($q) use ($filterCountry) {
    $escaped = implode(',', array_map(fn($c) => "'" . addslashes($c) . "'", $filterCountry));
    $q->whereRaw("r.country IN ($escaped)");
})
->when($filterDecade, function($q) use ($filterDecade) {
    $ids = implode(',', array_map('intval', $filterDecade));
    $q->whereRaw("FLOOR(ma.year / 10) * 10 IN ($ids)");
})
    ->groupBy('ma.master_id', 'r.release_id', 'ma.title', 'ma.year');

// Filter berdasarkan type
if ($type == 'master') {
    $albums = DB::table(DB::raw("({$masterRelease->toSql()}) as combined"))
        ->mergeBindings($masterRelease)
        ->when($sort == 'title_az', fn($q) => $q->orderBy('judul', 'asc'))   
        ->when($sort == 'title_za', fn($q) => $q->orderBy('judul', 'desc'))  
        ->when($sort == 'latest', fn($q) => $q->orderBy('master_id', 'desc'))
        ->when($sort == 'relevance', fn($q) => $q->orderByRaw('RAND()'))
        ->paginate($perPage);

} elseif ($type == 'release') {
    $albums = DB::table(DB::raw("({$releases->toSql()}) as combined"))
        ->mergeBindings($releases)
          ->when($sort == 'title_az', fn($q) => $q->orderBy('judul', 'asc'))   
        ->when($sort == 'title_za', fn($q) => $q->orderBy('judul', 'desc'))  
        ->when($sort == 'latest', fn($q) => $q->orderBy('master_id', 'desc'))
        ->when($sort == 'relevance', fn($q) => $q->orderByRaw('RAND()'))
        ->paginate($perPage);

}  elseif ($type == 'artist') {
    $albums = DB::table('artists')
        ->select(
            'artist_id as master_id',
            DB::raw('NULL as release_id'),
            'name as judul',
            DB::raw('NULL as tahun'),
            'name as nama_artis',
            'image as foto',  // ← tambah ini
            DB::raw("'ARTIST' as format_name")
        )
        ->when($sort == 'title_az', fn($q) => $q->orderBy('name', 'asc'))   
        ->when($sort == 'title_za', fn($q) => $q->orderBy('name', 'desc'))
        ->when($sort == 'relevance', fn($q) => $q->orderByRaw('RAND()'))
        ->paginate($perPage);


} elseif ($type == 'label') {
    $albums = DB::table('labels')
        ->select(
            'label_id as master_id', 
            DB::raw('NULL as release_id'),
            'name as judul',
            DB::raw('NULL as tahun'),
            'name as nama_artis',
            DB::raw('NULL as foto'),
            DB::raw("'LABEL' as format_name")
        )
        ->when($sort == 'title_az', fn($q) => $q->orderBy('name', 'asc'))  
        ->when($sort == 'title_za', fn($q) => $q->orderBy('name', 'desc'))
        ->when($sort == 'relevance', fn($q) => $q->orderByRaw('RAND()'))
        ->paginate($perPage);

} else {
    $artists = DB::table('artists')
        ->select(
            'artist_id as master_id',
            DB::raw('NULL as release_id'),
            'name as judul',
            DB::raw('NULL as tahun'),
            'name as nama_artis',
            'image as foto',
            DB::raw("'ARTIST' as format_name")
        );

    $labelQuery = DB::table('labels')
        ->select(
            'label_id as master_id',
            DB::raw('NULL as release_id'),
            'name as judul',
            DB::raw('NULL as tahun'),
            'name as nama_artis',
            DB::raw('NULL as foto'),
            DB::raw("'LABEL' as format_name")
        );

    $union = $masterRelease->unionAll($releases)->unionAll($artists)->unionAll($labelQuery);

    $albums = DB::table(DB::raw("({$union->toSql()}) as combined"))
        ->mergeBindings($union)
        ->when($sort == 'title_az', fn($q) => $q->orderBy('judul', 'asc'))
        ->when($sort == 'title_za', fn($q) => $q->orderBy('judul', 'desc'))
        ->when($sort == 'latest', fn($q) => $q->orderBy('master_id', 'desc'))
        ->when($sort == 'relevance', fn($q) => $q->orderByRaw('RAND()'))
        ->paginate($perPage);
}

// 7. Count untuk Nav
$countRelease = DB::table('releases')->count();
$countMaster = DB::table('master_albums')->count();
$countArtist = DB::table('artists')->count();
$countLabel = DB::table('labels')->count();
$countAll = $countRelease + $countMaster + $countArtist + $countLabel;

// Kirim ke View
return view('search', compact(
    'Genre', 'Style', 'Format', 'Country', 'Decade', 'albums',
    'countAll', 'countRelease', 'countMaster', 'countArtist', 'countLabel'
));
}

public function showLabel($id)
{
    $perPage = request('per_page', 25);

    $label = DB::table('labels')->where('label_id', $id)->first();

    $parentLabel = null;
    // if($label && $label->parent_label_id) {
    //     $parentLabel = DB::table('labels')->where('label_id', $label->parent_label_id)->first();
    // }

    // $sublabels = DB::table('labels')->where('parent_label_id', $id)->get();
    $sublabels = collect();

    $forSale = DB::table('label_release as lr')
        ->join('releases as r', 'lr.release_id', '=', 'r.release_id')
        ->join('master_albums as ma', 'r.master_id', '=', 'ma.master_id')
        ->join('products as p', 'r.release_id', '=', 'p.release_id')
        ->leftJoin('images as img', 'r.release_id', '=', 'img.release_id')
        ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
        ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')
        ->select(
            'ma.master_id',
            'ma.title',
            'ma.year',
            DB::raw('MIN(img.url) as foto'),
            DB::raw('GROUP_CONCAT(DISTINCT f.name SEPARATOR " · ") as format_name'),
            DB::raw('MIN(p.price) as min_price'),
            DB::raw('MAX(p.price) as max_price'),
            DB::raw('COUNT(p.product_id) as total_listings')
        )
        ->where('lr.label_id', $id)
        ->where('p.status', 'tersedia')
        ->groupBy('ma.master_id', 'ma.title', 'ma.year')
        ->limit(5)
        ->get();

    $releases = DB::table('label_release as lr')
        ->join('releases as r', 'lr.release_id', '=', 'r.release_id')
        ->join('master_albums as ma', 'r.master_id', '=', 'ma.master_id')
        ->leftJoin('images as img', 'r.release_id', '=', 'img.release_id')
        ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
        ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')
        ->select(
            'r.release_id',
            'ma.title',
            'ma.year',
            'lr.catalog_number',
            DB::raw('MIN(img.url) as foto'),
            DB::raw('GROUP_CONCAT(DISTINCT f.name SEPARATOR ", ") as format_name')
        )
        ->where('lr.label_id', $id)
        ->groupBy('r.release_id', 'ma.title', 'ma.year', 'lr.catalog_number')
        ->orderBy('ma.year', 'asc')
        ->paginate($perPage);

    return view('showLabel', compact('label', 'releases', 'id', 'sublabels', 'parentLabel', 'forSale'));
}

    

}