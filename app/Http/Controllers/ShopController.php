<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Genre;
use App\Models\Style;
use App\Models\Format;
use App\Models\Seller;
use App\Models\Release;
use App\Models\Review;
use App\Models\Artist;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // 1. Query dasar dengan custom select shipping dan pajak (tax) 11%
        // SQL:
        // SELECT products.*, 25000.00 as shipping, (products.price * 0.11) as tax 
        // FROM products 
        // LEFT JOIN label_release ON products.release_id = label_release.release_id
        // LEFT JOIN labels ON label_release.label_id = labels.label_id
        // WHERE products.stock > 0
        $query = Product::with(['release.images', 'release.artists', 'release.labels', 'release.formats', 'seller.reviews'])
            ->leftJoin('label_release', 'products.release_id', '=', 'label_release.release_id')
            ->leftJoin('labels', 'label_release.label_id', '=', 'labels.label_id')
            
            ->select(
                'products.*', 
                DB::raw('25000.00 as shipping'), 
                DB::raw('(products.price * 0.11) as tax')
            )
            ->where('products.stock', '>', 0);

        // 2. FILTER dari sidebar
        $filterCountry     = $request->get('country');
        $filterFormat      = $request->get('format');
        $filterGenre       = $request->get('genre');
        $filterStyle       = $request->get('style');
        $filterCondition   = $request->get('condition');
        $filterYear        = $request->get('year');
        $filterFormatDesc  = $request->get('format_desc');

        if ($filterCountry) {
            // SQL:
            // JOIN releases r_country ON products.release_id = r_country.release_id
            // WHERE r_country.country = ?
            $query->join('releases as r_country', 'products.release_id', '=', 'r_country.release_id')
                  ->where('r_country.country', $filterCountry);
        }

        if ($filterFormat) {
            // SQL:
            // JOIN format_release fr_filter ON products.release_id = fr_filter.release_id
            // JOIN formats f_filter ON fr_filter.format_id = f_filter.format_id
            // WHERE f_filter.name = ?
            $query->join('format_release as fr_filter', 'products.release_id', '=', 'fr_filter.release_id')
                  ->join('formats as f_filter', 'fr_filter.format_id', '=', 'f_filter.format_id')
                  ->where('f_filter.name', $filterFormat);
        }

        if ($filterGenre) {
            // SQL:
            // JOIN genre_release gr_filter ON products.release_id = gr_filter.release_id
            // JOIN genres g_filter ON gr_filter.genre_id = g_filter.genre_id
            // WHERE g_filter.name = ?
            $query->join('genre_release as gr_filter', 'products.release_id', '=', 'gr_filter.release_id')
                  ->join('genres as g_filter', 'gr_filter.genre_id', '=', 'g_filter.genre_id')
                  ->where('g_filter.name', $filterGenre);
        }

        if ($filterStyle) {
            // SQL:
            // JOIN release_style rs_filter ON products.release_id = rs_filter.release_id
            // JOIN styles s_filter ON rs_filter.style_id = s_filter.style_id
            // WHERE s_filter.name = ?
            $query->join('release_style as rs_filter', 'products.release_id', '=', 'rs_filter.release_id')
                  ->join('styles as s_filter', 'rs_filter.style_id', '=', 's_filter.style_id')
                  ->where('s_filter.name', $filterStyle);
        }

        if ($filterCondition) {
            // SQL:
            // WHERE products.condition = ?
            $query->where('products.condition', $filterCondition);
        }

        if ($filterYear) {
            // SQL:
            // JOIN releases r_year ON products.release_id = r_year.release_id
            // JOIN master_albums ma_filter ON r_year.master_id = ma_filter.master_id
            // WHERE ma_filter.year = ?
            $query->join('releases as r_year', 'products.release_id', '=', 'r_year.release_id')
                  ->join('master_albums as ma_filter', 'r_year.master_id', '=', 'ma_filter.master_id')
                  ->where('ma_filter.year', $filterYear);
        }

        if ($filterFormatDesc) {
            // SQL:
            // JOIN format_release fr_desc ON products.release_id = fr_desc.release_id
            // JOIN format_descriptions fd_filter ON fr_desc.id = fd_filter.format_release_id
            // WHERE fd_filter.description = ?
            $query->join('format_release as fr_desc', 'products.release_id', '=', 'fr_desc.release_id')
                  ->join('format_descriptions as fd_filter', 'fr_desc.id', '=', 'fd_filter.format_release_id')
                  ->where('fd_filter.description', $filterFormatDesc);
        }

        // Filter by release_id (dari tombol Shop di halaman Release)
        $filterReleaseId = $request->get('release_id');
        $filterMasterId  = $request->get('master_id');

        if ($filterReleaseId) {
            // SQL:
            // WHERE products.release_id = ?
            $query->where('products.release_id', $filterReleaseId);
        }

        if ($filterMasterId) {
            // SQL Langkah 1: SELECT release_id FROM releases WHERE master_id = ?
            // SQL Langkah 2: WHERE products.release_id IN (?, ?, ...)
            $releaseIds = \App\Models\Release::where('master_id', $filterMasterId)->pluck('release_id');
            $query->whereIn('products.release_id', $releaseIds);
        }

        // 3. Sort
        $perPage = $request->get('show', 25);
        $sort    = $request->get('sort', 'newest');

        switch ($sort) {
            case 'price_asc':  
                // SQL: ORDER BY products.price ASC
                $query->orderBy('products.price', 'asc'); 
                break;
            case 'price_desc': 
                // SQL: ORDER BY products.price DESC
                $query->orderBy('products.price', 'desc'); 
                break;
            case 'condition':  
                // SQL: ORDER BY products.condition ASC
                $query->orderBy('products.condition', 'asc'); 
                break;
            case 'artist':
                // SQL:
                // JOIN releases r_artist ON products.release_id = r_artist.release_id
                // JOIN artist_release ON r_artist.release_id = artist_release.release_id
                // JOIN artists ON artist_release.artist_id = artists.artist_id
                // ORDER BY artists.name ASC
                $query->join('releases as r_artist', 'products.release_id', '=', 'r_artist.release_id')
                      ->join('artist_release', 'r_artist.release_id', '=', 'artist_release.release_id')
                      ->join('artists', 'artist_release.artist_id', '=', 'artists.artist_id')
                      ->orderBy('artists.name', 'asc');
                break;
            case 'title':
                // SQL:
                // JOIN releases r_title ON products.release_id = r_title.release_id
                // ORDER BY r_title.title ASC
                $query->join('releases as r_title', 'products.release_id', '=', 'r_title.release_id')
                      ->orderBy('r_title.title', 'asc');
                break;
            case 'label':
                // SQL: ORDER BY labels.name ASC
                $query->orderBy('labels.name', 'asc');
                break;
                
            default: 
                // SQL: ORDER BY products.product_id DESC
                $query->orderBy('products.product_id', 'desc'); 
                break;
        }

        // 4. Pagination
        $products = $query->distinct()->paginate($perPage)->withQueryString();
        $total    = $products->total();
        $from     = $products->firstItem() ?? 0;
        $to       = $products->lastItem() ?? 0;

        // 5. Sidebar data
        
        // SQL:
        // SELECT releases.country, COUNT(products.product_id) as product_count 
        // FROM products 
        // JOIN releases ON products.release_id = releases.release_id 
        // WHERE releases.country IS NOT NULL AND releases.country != '' 
        // GROUP BY releases.country ORDER BY product_count DESC
        $countries = Product::join('releases', 'products.release_id', '=', 'releases.release_id')
            ->select('releases.country', DB::raw('COUNT(products.product_id) as product_count'))
            ->whereNotNull('releases.country')->where('releases.country', '!=', '')
            ->groupBy('releases.country')->orderBy('product_count', 'desc')->get();

        // SQL:
        // SELECT formats.name as format_name, COUNT(products.product_id) as product_count 
        // FROM products 
        // JOIN format_release ON products.release_id = format_release.release_id 
        // JOIN formats ON format_release.format_id = formats.format_id 
        // GROUP BY formats.format_id, formats.name ORDER BY product_count DESC
        $formats = Product::join('format_release', 'products.release_id', '=', 'format_release.release_id')
            ->join('formats', 'format_release.format_id', '=', 'formats.format_id')
            ->select('formats.name as format_name', DB::raw('COUNT(products.product_id) as product_count'))
            ->groupBy('formats.format_id', 'formats.name')->orderBy('product_count', 'desc')->get();

        // SQL:
        // SELECT genres.name, COUNT(products.product_id) as product_count 
        // FROM products 
        // JOIN genre_release ON products.release_id = genre_release.release_id 
        // JOIN genres ON genre_release.genre_id = genres.genre_id 
        // GROUP BY genres.genre_id, genres.name ORDER BY product_count DESC
        $genres = Product::join('genre_release', 'products.release_id', '=', 'genre_release.release_id')
            ->join('genres', 'genre_release.genre_id', '=', 'genres.genre_id')
            ->select('genres.name', DB::raw('COUNT(products.product_id) as product_count'))
            ->groupBy('genres.genre_id', 'genres.name')->orderBy('product_count', 'desc')->get();

        // SQL:
        // SELECT styles.name, COUNT(products.product_id) as product_count 
        // FROM products 
        // JOIN release_style ON products.release_id = release_style.release_id 
        // JOIN styles ON release_style.style_id = styles.style_id 
        // GROUP BY styles.style_id, styles.name ORDER BY product_count DESC
        $styles = Product::join('release_style', 'products.release_id', '=', 'release_style.release_id')
            ->join('styles', 'release_style.style_id', '=', 'styles.style_id')
            ->select('styles.name', DB::raw('COUNT(products.product_id) as product_count'))
            ->groupBy('styles.style_id', 'styles.name')->orderBy('product_count', 'desc')->get();

        // SQL:
        // SELECT format_descriptions.description as name, COUNT(products.product_id) as product_count 
        // FROM products 
        // JOIN format_release ON products.release_id = format_release.release_id 
        // JOIN format_descriptions ON format_release.id = format_descriptions.format_release_id 
        // GROUP BY format_descriptions.description ORDER BY product_count DESC
        $formatDescriptions = Product::join('format_release', 'products.release_id', '=', 'format_release.release_id')
            ->join('format_descriptions', 'format_release.id', '=', 'format_descriptions.format_release_id')
            ->select('format_descriptions.description as name', DB::raw('COUNT(products.product_id) as product_count'))
            ->groupBy('format_descriptions.description')->orderBy('product_count', 'desc')->get();

        // SQL:
        // SELECT master_albums.year as year, COUNT(products.product_id) as product_count 
        // FROM products 
        // JOIN releases ON products.release_id = releases.release_id 
        // JOIN master_albums ON releases.master_id = master_albums.master_id 
        // WHERE master_albums.year IS NOT NULL AND master_albums.year != 0 
        // GROUP BY master_albums.master_id, master_albums.year HAVING product_count > 0 ORDER BY product_count DESC
        $years = Product::join('releases', 'products.release_id', '=', 'releases.release_id')
            ->join('master_albums', 'releases.master_id', '=', 'master_albums.master_id')
            ->select('master_albums.year as year', DB::raw('COUNT(products.product_id) as product_count'))
            ->whereNotNull('master_albums.year')->where('master_albums.year', '!=', 0)
            ->groupBy('master_albums.master_id', 'master_albums.year')
            ->having('product_count', '>', 0)->orderBy('product_count', 'desc')->get();

        // SQL:
        // SELECT condition, COUNT(product_id) as product_count 
        // FROM products 
        // GROUP BY condition ORDER BY product_count DESC
        $conditions = Product::select('condition', DB::raw('COUNT(product_id) as product_count'))
            ->groupBy('condition')->orderBy('product_count', 'desc')->get();

        // 6. Kumpulkan active filters
        $activeFilters = [];
        if ($filterCountry)    $activeFilters['country']     = ['label' => 'Ships From: ' . $filterCountry,     'param' => 'country'];
        if ($filterFormat)     $activeFilters['format']      = ['label' => 'Format: ' . $filterFormat,          'param' => 'format'];
        if ($filterGenre)      $activeFilters['genre']       = ['label' => 'Genre: ' . $filterGenre,           'param' => 'genre'];
        if ($filterStyle)      $activeFilters['style']       = ['label' => 'Style: ' . $filterStyle,           'param' => 'style'];
        if ($filterCondition)  $activeFilters['condition']   = ['label' => 'Condition: ' . $filterCondition,   'param' => 'condition'];
        if ($filterYear)       $activeFilters['year']        = ['label' => 'Year: ' . $filterYear,             'param' => 'year'];
        if ($filterFormatDesc) $activeFilters['format_desc'] = ['label' => 'Format Desc: ' . $filterFormatDesc, 'param' => 'format_desc'];
        if ($filterReleaseId)  $activeFilters['release_id']  = ['label' => 'Release #' . $filterReleaseId,      'param' => 'release_id'];
        if ($filterMasterId)   $activeFilters['master_id']   = ['label' => 'Master #'  . $filterMasterId,       'param' => 'master_id'];

        return view('sell.list', compact(
            'products', 'total', 'from', 'to', 'perPage', 'sort',
            'countries', 'formats', 'genres', 'styles', 'conditions', 'years', 'formatDescriptions',
            'activeFilters',
            'filterCountry', 'filterFormat', 'filterGenre', 'filterStyle',
            'filterCondition', 'filterYear', 'filterFormatDesc'
        ));
    }

    public function showRelease($id)
    {
        // SQL: SELECT * FROM releases WHERE release_id = ? LIMIT 1
        $release = Release::where('release_id', $id)->firstOrFail();
        
        // SQL: SELECT * FROM artists LIMIT 10
        $artists = Artist::take(10)->get();
        
        return view('showrelease', compact('release', 'artists'));
    }
}