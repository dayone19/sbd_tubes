<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    
    public function index() {
        $perPage = request('per_page', 25);

        // 1. Ambil Data Genre + Count
        // SELECT 
        //     genres.genre_id, 
        //     genres.name, 
        //     COUNT(genre_release.release_id) as releases_count
        // FROM genres 
        // LEFT JOIN genre_release ON genres.genre_id = genre_release.genre_id
        // GROUP BY genres.genre_id, genres.name 
        // ORDER BY releases_count DESC;
        $Genre = DB::table('genres')
            ->leftJoin('genre_release', 'genres.genre_id', '=', 'genre_release.genre_id')
            ->select('genres.genre_id', 'genres.name', DB::raw('count(genre_release.release_id) as releases_count'))
            ->groupBy('genres.genre_id', 'genres.name')
            ->orderBy('releases_count', 'desc')
            ->get();

        // 2. Ambil Data Style + Count 
        // SELECT 
        //     styles.style_id, 
        //     styles.name, 
        //     COUNT(release_style.release_id) as releases_count
        // FROM styles 
        // LEFT JOIN release_style ON styles.style_id = release_style.style_id
        // GROUP BY styles.style_id, styles.name 
        // ORDER BY releases_count DESC;
        $Style = DB::table('styles')
            ->leftJoin('release_style', 'styles.style_id', '=', 'release_style.style_id')
            ->select('styles.style_id', 'styles.name', DB::raw('count(release_style.release_id) as releases_count'))
            ->groupBy('styles.style_id', 'styles.name')
            ->orderBy('releases_count', 'desc')
            ->get();

        // 3. Ambil Data Format + Count
        // SELECT 
        //     formats.format_id, 
        //     formats.name, 
        //     COUNT(format_release.format_id) as releases_count
        // FROM formats 
        // LEFT JOIN format_release ON formats.format_id = format_release.format_id
        // GROUP BY formats.format_id, formats.name 
        // ORDER BY releases_count DESC;
         $Format = DB::table('formats')
                ->leftJoin('format_release', 'formats.format_id', '=', 'format_release.format_id')
                ->select('formats.format_id', 'formats.name', DB::raw('count(format_release.format_id) as releases_count'))
                ->groupBy('formats.format_id', 'formats.name')
                ->orderBy('releases_count', 'desc')
                ->get();

        // 4. Ambil Data Country
        // SELECT 
        //     r.country, 
        //     COUNT(r.release_id) as releases_count 
        // FROM master_albums ma
        // JOIN releases r ON ma.master_id = r.master_id 
        // WHERE r.country IS NOT NULL AND r.country != ''
        // GROUP BY r.country 
        // ORDER BY releases_count DESC;
            $Country = DB::table('master_albums')
                    ->join('releases', 'master_albums.master_id', '=', 'releases.master_id')
                    ->select('releases.country', DB::raw('count(releases.release_id) as releases_count'))
                    ->whereNotNull('releases.country') 
                    ->where('releases.country', '!=', '')
                    ->groupBy('releases.country')
                    ->orderBy('releases_count', 'desc')
                    ->get();

        // 5. Ambil Data Decade
        // SELECT 
        //     FLOOR(year / 10) * 10 AS decade, 
        //     COUNT(master_id) as releases_count
        // FROM master_albums 
        // WHERE year IS NOT NULL AND year > 0
        // GROUP BY decade 
        // ORDER BY releases_count DESC;
            $Decade = DB::table('master_albums')
                        ->select(
                                DB::raw('FLOOR(year / 10) * 10 AS decade'), 
                                DB::raw('count(master_id) as releases_count') )
                        ->whereNotNull('year')
                        ->where('year', '>', 0)
                        ->groupBy('decade')
                        ->orderBy('releases_count', 'desc')
                        ->get();

        // 6. Ambil Data Year
        $Years = [];
        if (request()->has('decade')) {
            // SELECT 
            //     year, 
            //     COUNT(master_id) as releases_count 
            // FROM master_albums
            // WHERE FLOOR(year / 10) * 10 IN (...) 
            //   AND year IS NOT NULL 
            //   AND year > 0
            // GROUP BY year 
            // ORDER BY releases_count DESC;
            $Years = DB::table('master_albums')
                ->select('year', DB::raw('count(master_id) as releases_count'))
                ->whereIn(DB::raw('FLOOR(year / 10) * 10'), request('decade')) 
                ->whereNotNull('year')
                ->where('year', '>', 0)
                ->groupBy('year')
                ->orderBy('releases_count', 'desc')
                ->get();
        }

        // 7. Membuat Pencarian Dinamis (Find Music)
        $type = request('type', 'all');
        $filterGenre = request('genre', []);
        $filterStyle = request('style', []);
        $filterFormat = request('format', []);
        $filterCountry = request('country', []);
        $filterDecade = request('decade', []);
        $sort = request('sort', 'relevance');

        // SELECT 
        //     ma.master_id, 
        //     NULL as release_id, 
        //     ma.title as judul, 
        //     ma.year as tahun, 
        //     MIN(ar.name) as nama_artis, 
        //     MIN(img.url) as foto, 
        //     'MASTER RELEASE' as format_name
        // FROM master_albums as ma 
        // JOIN releases as r ON ma.master_id = r.master_id
        // JOIN artist_release as art_rel ON r.release_id = art_rel.release_id
        // JOIN artists as ar ON art_rel.artist_id = ar.artist_id
        // LEFT JOIN images as img ON r.release_id = img.release_id
        // GROUP BY ma.master_id, ma.title, ma.year
        $masterRelease = DB::table('master_albums as ma')
            ->select('ma.master_id', DB::raw('NULL as release_id'), 'ma.title as judul', 'ma.year as tahun', DB::raw('MIN(ar.name) as nama_artis'), DB::raw('MIN(img.url) as foto'), DB::raw("'MASTER RELEASE' as format_name"))
            ->join('releases as r', 'ma.master_id', '=', 'r.master_id')
            ->join('artist_release as art_rel', 'r.release_id', '=', 'art_rel.release_id')
            ->join('artists as ar', 'art_rel.artist_id', '=', 'ar.artist_id')
            ->leftJoin('images as img', 'r.release_id', '=', 'img.release_id')
            ->when($filterGenre, function($q) use ($filterGenre) {
                $ids = implode(',', array_map('intval', $filterGenre));
                $q->join('genre_release as gr', 'r.release_id', '=', 'gr.release_id')->whereRaw("gr.genre_id IN ($ids)");
            })
            ->when($filterStyle, function($q) use ($filterStyle) {
                $ids = implode(',', array_map('intval', $filterStyle));
                $q->join('release_style as rs', 'r.release_id', '=', 'rs.release_id')->whereRaw("rs.style_id IN ($ids)");
            })
            ->when($filterCountry, function($q) use ($filterCountry) {
                $escaped = implode(',', array_map(fn($c) => "'" . addslashes($c) . "'", $filterCountry));
                $q->whereRaw("r.country IN ($escaped)");
            })
            ->when($filterDecade, function($q) use ($filterDecade) {
                $ids = implode(',', array_map('intval', $filterDecade));
                $q->whereRaw("FLOOR(ma.year / 10) * 10 IN ($ids)");
            })
            ->when(request('year'), function($q) {
                $q->whereIn('ma.year', request('year'));
            })
            ->groupBy('ma.master_id', 'ma.title', 'ma.year');

        // SELECT 
        //     ma.master_id, 
        //     r.release_id, 
        //     ma.title as judul, 
        //     ma.year as tahun, 
        //     MIN(ar.name) as nama_artis, 
        //     MIN(img.url) as foto, 
        //     CONCAT(MIN(f.name), IF(MAX(fr.is_limited) = 1, ' • Ltd Edition', '')) as format_name
        // FROM master_albums as ma 
        // JOIN releases as r ON ma.master_id = r.master_id
        // JOIN artist_release as art_rel ON r.release_id = art_rel.release_id
        // JOIN artists as ar ON art_rel.artist_id = ar.artist_id
        // LEFT JOIN images as img ON r.release_id = img.release_id
        // LEFT JOIN format_release as fr ON r.release_id = fr.release_id
        // LEFT JOIN formats as f ON fr.format_id = f.format_id
        // GROUP BY ma.master_id, r.release_id, ma.title, ma.year
        $releases = DB::table('master_albums as ma')
            ->select('ma.master_id', 'r.release_id', 'ma.title as judul', 'ma.year as tahun', DB::raw('MIN(ar.name) as nama_artis'), DB::raw('MIN(img.url) as foto'), DB::raw('CONCAT(MIN(f.name), IF(MAX(fr.is_limited) = 1, " • Ltd Edition", "")) as format_name'))
            ->join('releases as r', 'ma.master_id', '=', 'r.master_id')
            ->join('artist_release as art_rel', 'r.release_id', '=', 'art_rel.release_id')
            ->join('artists as ar', 'art_rel.artist_id', '=', 'ar.artist_id')
            ->leftJoin('images as img', function ($join) {
                $join->on('r.release_id', '=', 'img.release_id')
                    ->where('img.type', '=', 'primary');
            })
            ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
            ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')
            ->when($filterGenre, function($q) use ($filterGenre) {
                $ids = implode(',', array_map('intval', $filterGenre));
                $q->join('genre_release as gr', 'r.release_id', '=', 'gr.release_id')->whereRaw("gr.genre_id IN ($ids)");
            })
            ->when($filterStyle, function($q) use ($filterStyle) {
                $ids = implode(',', array_map('intval', $filterStyle));
                $q->join('release_style as rs', 'r.release_id', '=', 'rs.release_id')->whereRaw("rs.style_id IN ($ids)");
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
            ->when(request('year'), function($q) {
                $q->whereIn('ma.year', request('year'));
            })
            ->groupBy('ma.master_id', 'r.release_id', 'ma.title', 'ma.year');

        if ($type == 'master') {
            $albums = DB::table(DB::raw("({$masterRelease->toSql()}) as combined"))
                ->mergeBindings($masterRelease)
                ->when($sort == 'title_az', fn($q) => $q->orderBy('judul', 'asc'))   
                ->when($sort == 'title_za', fn($q) => $q->orderBy('judul', 'desc'))  
                ->when($sort == 'latest', fn($q) => $q->orderBy('master_id', 'desc'))
                ->when($sort == 'relevance', fn($q) => $q->orderByRaw('RAND()'))
                ->paginate($perPage)->withQueryString();

        } elseif ($type == 'release') {
            $albums = DB::table(DB::raw("({$releases->toSql()}) as combined"))
                ->mergeBindings($releases)
                ->when($sort == 'title_az', fn($q) => $q->orderBy('judul', 'asc'))   
                ->when($sort == 'title_za', fn($q) => $q->orderBy('judul', 'desc'))  
                ->when($sort == 'latest', fn($q) => $q->orderBy('master_id', 'desc'))
                ->when($sort == 'relevance', fn($q) => $q->orderByRaw('RAND()'))
                ->paginate($perPage)->withQueryString();

        } elseif ($type == 'artist') {
            // SELECT 
            //     artist_id as master_id, 
            //     NULL as release_id, 
            //     name as judul, 
            //     NULL as tahun, 
            //     name as nama_artis, 
            //     image as foto, 
            //     'ARTIST' as format_name 
            // FROM artists;
            $albums = DB::table('artists')
                ->select('artist_id as master_id', DB::raw('NULL as release_id'), 'name as judul', DB::raw('NULL as tahun'), 'name as nama_artis', 'image as foto', DB::raw("'ARTIST' as format_name"))
                ->when($sort == 'title_az', fn($q) => $q->orderBy('name', 'asc'))   
                ->when($sort == 'title_za', fn($q) => $q->orderBy('name', 'desc'))
                ->when($sort == 'relevance', fn($q) => $q->orderByRaw('RAND()'))
                ->paginate($perPage)->withQueryString();

        } elseif ($type == 'label') {
            // SELECT 
            //     label_id as master_id, 
            //     NULL as release_id, 
            //     name as judul, 
            //     NULL as tahun, 
            //     name as nama_artis, 
            //     image as foto, 
            //     'LABEL' as format_name 
            // FROM labels;
            $albums = DB::table('labels')
                ->select('label_id as master_id', DB::raw('NULL as release_id'), 'name as judul', DB::raw('NULL as tahun'), 'name as nama_artis', 'image as foto', DB::raw("'LABEL' as format_name"))
                ->when($sort == 'title_az', fn($q) => $q->orderBy('name', 'asc'))  
                ->when($sort == 'title_za', fn($q) => $q->orderBy('name', 'desc'))
                ->when($sort == 'relevance', fn($q) => $q->orderByRaw('RAND()'))
                ->paginate($perPage)->withQueryString();

        } else {
            $artists = DB::table('artists')->select('artist_id as master_id', DB::raw('NULL as release_id'), 'name as judul', DB::raw('NULL as tahun'), 'name as nama_artis', 'image as foto', DB::raw("'ARTIST' as format_name"));
            $labelQuery = DB::table('labels')->select('label_id as master_id', DB::raw('NULL as release_id'), 'name as judul', DB::raw('NULL as tahun'), 'name as nama_artis', 'image as foto', DB::raw("'LABEL' as format_name"));

            $union = $masterRelease->unionAll($releases)->unionAll($artists)->unionAll($labelQuery);

            $albums = DB::table(DB::raw("({$union->toSql()}) as combined"))
                ->mergeBindings($union)
                ->when($sort == 'title_az', fn($q) => $q->orderBy('judul', 'asc'))
                ->when($sort == 'title_za', fn($q) => $q->orderBy('judul', 'desc'))
                ->when($sort == 'latest', fn($q) => $q->orderBy('master_id', 'desc'))
                ->when($sort == 'relevance', fn($q) => $q->orderByRaw('RAND()'))
                ->paginate($perPage)->withQueryString();
        }

        // 8. Count Dinamis untuk Navigasi
        $countMaster = $masterRelease->get()->count();
        $countRelease = $releases->get()->count();
        
        // SELECT COUNT(*) FROM artists;
        $countArtist = DB::table('artists')->count(); 

        // SELECT COUNT(*) FROM labels;
        $countLabel = DB::table('labels')->count();   

        $countAll = $countMaster + $countRelease + $countArtist + $countLabel;

        return view('search', compact(
            'Genre', 'Style', 'Format', 'Country', 'Decade', 'albums', 'Years',
            'countAll', 'countRelease', 'countMaster', 'countArtist', 'countLabel'
        ));
    }

    public function showLabel($id)
    {
        $perPage = request('per_page', 25);

        // SELECT * FROM labels WHERE label_id = ? LIMIT 1;
        $label = DB::table('labels')->where('label_id', $id)->first();

        // SELECT * FROM labels WHERE label_id = ? LIMIT 1;
        $parentLabel = null;
        if($label && $label->parent_label_id) {
            $parentLabel = DB::table('labels')->where('label_id', $label->parent_label_id)->first();
        }

        // SELECT * FROM labels WHERE parent_label_id = ?;
        $sublabels = DB::table('labels')->where('parent_label_id', $id)->get();

        // SELECT 
        //     ma.master_id, 
        //     ma.title, 
        //     ma.year, 
        //     MIN(p.product_id) as product_id, 
        //     MIN(img.url) as foto, 
        //     GROUP_CONCAT(DISTINCT f.name SEPARATOR " · ") as format_name, 
        //     MIN(p.price) as min_price, 
        //     MAX(p.price) as max_price, 
        //     COUNT(p.product_id) as total_listings
        // FROM label_release lr 
        // JOIN releases r ON lr.release_id = r.release_id 
        // JOIN master_albums ma ON r.master_id = ma.master_id 
        // JOIN products p ON r.release_id = p.release_id
        // LEFT JOIN images img ON r.release_id = img.release_id
        // LEFT JOIN format_release fr ON r.release_id = fr.release_id
        // LEFT JOIN formats f ON fr.format_id = f.format_id
        // WHERE lr.label_id = ? AND p.status = 'tersedia' 
        // GROUP BY ma.master_id, ma.title, ma.year 
        // LIMIT 5;
        $forSale = DB::table('label_release as lr')
            ->join('releases as r', 'lr.release_id', '=', 'r.release_id')
            ->join('master_albums as ma', 'r.master_id', '=', 'ma.master_id')
            ->join('products as p', 'r.release_id', '=', 'p.release_id')
            ->leftJoin('images as img', 'r.release_id', '=', 'img.release_id')
            ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
            ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')
            ->select('ma.master_id', 'ma.title', 'ma.year', DB::raw('MIN(p.product_id) as product_id'), DB::raw('MIN(img.url) as foto'), DB::raw('GROUP_CONCAT(DISTINCT f.name SEPARATOR " · ") as format_name'), DB::raw('MIN(p.price) as min_price'), DB::raw('MAX(p.price) as max_price'), DB::raw('COUNT(p.product_id) as total_listings'))
            ->where('lr.label_id', $id)
            ->where('p.status', 'tersedia')
            ->groupBy('ma.master_id', 'ma.title', 'ma.year') 
            ->limit(5)
            ->get();

        $q = request('q');
        $filterFormat = request('format');
        $filterCountry = request('country');
        $filterYear = is_array(request('year')) ? request('year')[0] : request('year');

        // SELECT 
        //     r.release_id, 
        //     ma.title, 
        //     ma.year, 
        //     lr.catalog_number, 
        //     MIN(img.url) as foto, 
        //     GROUP_CONCAT(DISTINCT f.name SEPARATOR ", ") as format_name
        // FROM label_release lr 
        // JOIN releases r ON lr.release_id = r.release_id 
        // JOIN master_albums ma ON r.master_id = ma.master_id
        // LEFT JOIN images img ON r.release_id = img.release_id
        // LEFT JOIN format_release fr ON r.release_id = fr.release_id
        // LEFT JOIN formats f ON fr.format_id = f.format_id
        // WHERE lr.label_id = ? 
        // GROUP BY r.release_id, ma.title, ma.year, lr.catalog_number 
        // ORDER BY ma.year ASC;
        $releases = DB::table('label_release as lr')
            ->join('releases as r', 'lr.release_id', '=', 'r.release_id')
            ->join('master_albums as ma', 'r.master_id', '=', 'ma.master_id')
            ->leftJoin('images as img', 'r.release_id', '=', 'img.release_id')
            ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
            ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')
            ->select('r.release_id', 'ma.title', 'ma.year', 'lr.catalog_number', DB::raw('MIN(img.url) as foto'), DB::raw('GROUP_CONCAT(DISTINCT f.name SEPARATOR ", ") as format_name'))
            ->where('lr.label_id', $id)
            ->when($q, fn($query) => $query->where('ma.title', 'like', "%$q%"))
            ->when($filterFormat, fn($query) => $query->where('f.name', 'like', "%$filterFormat%"))
            ->when($filterCountry, fn($query) => $query->where('r.country', 'like', "%$filterCountry%"))
            ->when($filterYear, fn($query) => $query->whereIn('ma.year', (array)$filterYear))
            ->groupBy('r.release_id', 'ma.title', 'ma.year', 'lr.catalog_number')
            ->orderBy('ma.year', 'asc')
            ->paginate($perPage);

        // SELECT 
        //     rv.review_id, 
        //     rv.rating, 
        //     rv.comment, 
        //     rv.created_at, 
        //     u.username as user_name
        // FROM reviews rv 
        // JOIN products p ON rv.product_id = p.product_id 
        // JOIN releases r ON p.release_id = r.release_id
        // JOIN label_release lr ON r.release_id = lr.release_id 
        // JOIN users u ON rv.user_id = u.user_id
        // WHERE lr.label_id = ? 
        // ORDER BY rv.created_at DESC;
        $reviews = DB::table('reviews as rv')
            ->join('products as p', 'rv.product_id', '=', 'p.product_id')
            ->join('releases as r', 'p.release_id', '=', 'r.release_id')
            ->join('label_release as lr', 'r.release_id', '=', 'lr.release_id')
            ->join('users as u', 'rv.user_id', '=', 'u.user_id')  
            ->select('rv.review_id', 'rv.rating', 'rv.comment', 'rv.created_at', 'u.username as user_name')
            ->where('lr.label_id', $id)
            ->orderBy('rv.created_at', 'desc')
            ->get();

        return view('showLabel', compact('label', 'releases', 'id', 'sublabels', 'parentLabel', 'forSale', 'reviews'));
    }

    public function storeReview(Request $request, $id)
    {
        // INSERT INTO reviews (user_id, product_id, rating, comment, created_at) 
        // VALUES (1, ?, ?, ?, NOW());
        DB::table('reviews')->insert([
            'user_id' => 1, 
            'product_id' => $request->product_id,
            'rating' => $request->rating ?? 5,
            'comment' => $request->comment,
            'created_at' => now(),
        ]);

        return redirect()->back();
    }
}