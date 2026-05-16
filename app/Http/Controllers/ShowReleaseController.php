<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Release;
use Illuminate\Support\Facades\DB;

class ShowReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // SQL
        // SELECT r.release_id,
        //        r.title,
        //        i.url as image,
        //        r.country,
        //        r.release_date,
        //        r.notes,
        //        m.year,
        //        m.master_id,
        //        r.barcode,
        // FROM release r
        // LEFT JOIN images i ON r.release_id = i.release_id AND i.type = 'primary'
        // LEFT JOIN master_album m ON r.release_id = m.release_id 

        $release = DB::table('releases as r')

        ->leftJoin('images as i', function ($join) {
            $join->on('r.release_id', '=', 'i.release_id')
            ->where('i.type', '=', 'primary');
        
        })

        ->leftJoin('master_albums as m', 'r.master_id', '=', 'm.master_id')

        ->where('r.release_id', $id)
        ->select('r.release_id',
                 'r.title',
                 'i.url as image',
                 'r.country',
                 'r.release_date',
                 'r.notes',
                 'm.year',
                 'm.master_id',
                 'r.barcode',
                 )
        ->first();

            if (!$release) {
                abort(404, 'Release not found');
            }

            if (empty($release->master_id)) {
                abort(404, 'Master ID not found');
            }
        
        // SQL:
        // SELECT ar.name
        // FROM artist_release arl
        // JOIN artists ar ON arl.artist_id = ar.artist_id
        // WHERE arl.role = "Main" AND arl.release_id = ?
        $artists = DB::table('artist_release as arl')
            ->join('artists as ar', 'arl.artist_id', '=', 'ar.artist_id')
            ->where('arl.role', '=', 'Main')
            ->where('arl.release_id', $release->release_id)
            ->select('ar.artist_id', 'ar.name')
            ->get();

        // SQL:
        // SELECT g.name
        // FROM genre_release gr
        // JOIN genres g ON gr.genre_id = g.genre_id
        // WHERE gr.release_id = ?
        $genres = DB::table('genre_release as gr')
            ->join('genres as g', 'gr.genre_id', '=', 'g.genre_id')
            ->where('gr.release_id', $release->release_id)
            ->pluck('g.name');

        // SQL:
        // SELECT s.name
        // FROM release_style rs
        // JOIN styles s ON rs.style_id = s.style_id
        // WHERE rs.release_id = ?
        $styles = DB::table('release_style as rs')
            ->join('styles as s', 'rs.style_id', '=', 's.style_id')
            ->where('rs.release_id', $release->release_id)
            ->pluck('s.name');

        // SQL:
        // SELECT f.name
        // FROM format_release fr
        // JOIN formats f ON fr.format_id = f.format_id
        // WHERE fr.release_id = ?
        $formats = DB::table('format_release as fr')
            ->join('formats as f', 'fr.format_id', '=', 'f.format_id')
            ->where('fr.release_id', $release->release_id)
            ->pluck('f.name');    

        // SQL:
        // SELECT track_id,
        //        title,
        //        duration,
        //        position,
        //        audio_url,
        // FROM tracks
        // WHERE release_id = ?
        $tracks = DB::table('tracks')
            ->where('release_id', $release->release_id)
            ->select(
                'track_id',
                'title',
                'duration',
                'position',
                'audio_url'
            )
            ->get();

        // SQL:
        // SELECT c.name
        //        cr.role
        // FROM companies_release cr
        // JOIN companies c ON cr.company_id = c.company_id
        // WHERE release_id = ?
        $companies = DB::table('companies_release as cr')
            ->join('companies as c', 'cr.company_id', '=', 'c.company_id')
            ->where('cr.release_id', $release->release_id)
            ->select('c.name', 'cr.role')
            ->get();

        // SQL:
        // SELECT r.release_id,
        //        r.title,
        //        i.url AS image,
        //        r.release_date,
        //        r.county,
        //        GROUP_CONCAT(DISTINCT a.name) AS artist
        // FROM release r
        // LEFT JOIN images i ON r.release_id = i.release_id AND i.type = 'primary'
        // JOIN genre_release gr ON r.release_id = gr.release_id
        // JOIN artist_release arl ON r.release_id = arl.release_id
        // JOIN artists a ON arl.artist_id = a.artist_id
        // WHERE gr.genre_id IN (
        //      SELECT genre_id
        //      FROM genre_release
        //      WHERE release_id = ?
        // )
        // AND r.release_id != ?
        // GROUP BY r.release_id, r.title, i.url
        // ORDER BY RAND()
        // LIMIT 6

        $recommendations = DB::table('releases as r')

            ->leftJoin('images as i', function ($join) {
                $join->on('r.release_id', '=', 'i.release_id')
                    ->where('i.type', '=', 'primary');
            })

            ->join('genre_release as gr', 'r.release_id', '=', 'gr.release_id')
            ->join('artist_release as arl', 'r.release_id', '=', 'arl.release_id')
            ->join('artists as a', 'arl.artist_id', '=', 'a.artist_id')
            ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
            ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')

            ->whereIn('gr.genre_id', function ($query) use ($release) {
                $query->select('genre_id')
                    ->from('genre_release')
                    ->where('release_id', $release->release_id);
            })

            ->where('arl.role', '=', 'Main')
            ->where('r.release_id', '!=', $release->release_id)

            ->select(
                'r.release_id',
                'r.title',
                'i.url as image',
                'r.release_date',
                'r.country',
                DB::raw('GROUP_CONCAT(DISTINCT a.name) as artist'),
                DB::raw("GROUP_CONCAT(DISTINCT f.name SEPARATOR ', ') as formats")
            )

            ->groupBy(
                'r.release_id',
                'r.title',
                'i.url',
                'r.country',
                'r.release_date',
            )

            ->inRandomOrder()
            ->limit(6)
            ->get();

            // SQL 
            // SELECT re.review_id,
            //        urp.image,
            //        ur.username,
            //        re.created_at,
            //        re.rating,
            //        re.comment
            // FROM reviews re
            // JOIN users ur ON re.user_id = ur.user_id
            // LEFT JOIN user_profiles urp ON ur.user_id = urp.user_id
            // JOIN products p ON re.product_id = p.product_id
            // WHERE re.release_id?
            // GROUP BY re.review_id,
            //          urp.image,
            //          ur.username,
            //          re.created_at,
            //          re.rating,
            //          re.comment
            
        $reviews = DB::table('reviews as re')

            ->join('users as ur', 're.user_id', '=', 'ur.user_id')
            ->leftJoin('user_profiles as urp', 'ur.user_id', '=', 'urp.user_id')
            ->join('products as p', 're.product_id', '=', 'p.product_id')

            ->where('p.release_id', $id)

            ->select(
                're.review_id',
                'urp.image',
                'ur.username',
                're.created_at',
                're.rating',
                're.comment'
            )

            ->groupBy(
                're.review_id',
                'urp.image',
                'ur.username',
                're.created_at',
                're.rating',
                're.comment'
            )

            ->latest('re.created_at')

            ->get();

        // SQL:
        // SELECT SUM(td.quantity) as have, 
        //        SUM(ct.quantity) as want, 
        //        AVG(rw.rating) as avg_rating, 
        //        COUNT(rw.rating) as total_rating,
        //        MAX(t.created_at) as last_sold,
        //        MIN(p.price) as lowest_price, 
        //        MAX(p.price) as highest_price,
        //        AVG(p.price) as median_price
        // FROM products p
        // LEFT JOIN transaction_details td ON p.product_id = td.product_id
        // LEFT JOIN cart_items ct ON p.product_id = ct.product_id
        // LEFT JOIN reviews rw ON p.product_id = rw.product_id
        // LEFT JOIN transactions t ON td.transaction_id = t.transaction_id
        // WHERE p.release_id = ?
        $stats = DB::table('products as p')
            ->leftJoin('transaction_details as td', 'p.product_id', '=', 'td.product_id')
            ->leftJoin('cart_items as ct', 'p.product_id', '=', 'ct.product_id')
            ->leftJoin('reviews as rw', 'p.product_id', '=', 'rw.product_id')
            ->leftJoin('transactions as t', 'td.transaction_id', '=', 't.transaction_id')
            ->where('p.release_id', $release->release_id)
            ->select(
                DB::raw("SUM(td.quantity) as have"),
                DB::raw("SUM(ct.quantity) as want"),
                DB::raw("AVG(rw.rating) as avg_rating"),
                DB::raw("COUNT(rw.rating) as total_rating"),
                DB::raw("MAX(t.created_at) as last_sold"),
                DB::raw("MIN(p.price) as lowest_price"),
                DB::raw("MAX(p.price) as highest_price"),
                DB::raw("AVG(p.price) as median_price")
            )
            ->first();

        // SELECT *
        // FROM videos
        // WHERE release_id = ?
        $videos = DB::table('videos')
        ->where('release_id', $release->release_id)
        ->distinct()
        ->get();
        
        // SELECT l.name AS list_name, 
        //        u.username
        // FROM list_release lr
        // JOIN lists l ON lr.list_id = l.list_id
        // JOIN users u ON l.user_id = u.user_id
        // WHERE lr.release_id = ?;
        $lists = DB::table('list_release AS lr')
        ->join('lists as l', 'lr.list_id', '=', 'l.list_id')
        ->join('users as u', 'l.user_id', '=', 'u.user_id')

        ->where('lr.release_id', $release->release_id)
        ->select('l.name AS list_name',
                     'u.username')
        ->get();

        // SELECT u.username
        // FROM users u
        // LEFT JOIN contributor_release cr ON u.user_id = cr.user_id
        // WHERE cr.release_id = ?
        $contributors = DB::table('users as u')
        ->leftJoin('contributor_release as cr', 'u.user_id', '=', 'cr.user_id')
        ->where('cr.release_id', $release->release_id)
        ->select('u.username')
        ->get();

        // SQL:
        // SELECT ar.name, arl.role, i.url
        // FROM artist_release arl
        // JOIN artists ar ON arl.artist_id = ar.artist_id
        // WHERE arl.release_id = ?
        // AND arl.role != 'Main'
        $credits = DB::table('artist_release as arl')
            ->join('artists as ar', 'arl.artist_id', '=', 'ar.artist_id')
            ->where('arl.release_id', $release->release_id)
            ->where('arl.role', '!=', 'Main')
            ->select(
                'ar.name',
                'arl.role'
            )
            ->get();

        // SELECT 
        //         idf.type,
        //         idf.description,
        //         idf.value
        //  FROM identifiers AS idf
        //  WHERE idf.release_id = ?;    
        $barcodes = DB::table('identifiers as idf')
        ->select('idf.type',
                 'idf.description',        
                 'idf.value',        
                )
        ->where('idf.release_id', $release->release_id)
        ->get();

        // SQL:
        // SELECT
        //         r.release_id,
        //         r.title,
        //         r.country,
        //         r.release_date,
        //         i.url,
        //         GROUP_CONCAT(DISTINCT f.name SEPARATOR ', ') as formats,
        //         GROUP_CONCAT(DISTINCT l.name SEPARATOR ', ') as labels,
        //         GROUP_CONCAT(DISTINCT rl.catalog_number SEPARATOR ', ') as catno
        // FROM releases r
        //  LEFT JOIN images i ON r.release_id = i.release_id AND i.type = 'primary'
        //  LEFT JOIN format_release fr ON r.release_id = fr.release_id
        //  LEFT JOIN formats f ON fr.format_id = f.format_id
        //  LEFT JOIN release_label rl ON r.release_id = rl.release_id
        //  LEFT JOIN labels l ON rl.label_id = l.label_id
        // WHERE r.master_id = ?
        // AND r.release_id != ?
        // GROUP BY
        //          r.release_id,
        //          r.title,
        //          r.country,
        //          r.release_date,
        //          i.url
        $otherVersions = DB::table('releases as r')

            ->leftJoin('images as i', function ($join) {
                $join->on('r.release_id', '=', 'i.release_id')
                    ->where('i.type', '=', 'primary');
            })

            ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
            ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')

            ->leftJoin('label_release as rl', 'r.release_id', '=', 'rl.release_id')
            ->leftJoin('labels as l', 'rl.label_id', '=', 'l.label_id')

            ->where('r.master_id', $release->master_id)
            ->where('r.release_id', '!=', $release->release_id)

            ->select(
                'r.release_id',
                'r.title',
                'r.country',
                'r.release_date',
                'i.url',
                DB::raw("GROUP_CONCAT(DISTINCT f.name SEPARATOR ', ') as formats"),
                DB::raw("GROUP_CONCAT(DISTINCT l.name SEPARATOR ', ') as labels"),
                DB::raw("GROUP_CONCAT(DISTINCT rl.catalog_number SEPARATOR ', ') as catno")
            )
            ->groupBy(
                'r.release_id',
                'r.title',
                'r.country',
                'r.release_date',
                'i.url'
            )
            ->take(5)
            ->get();

        $totalVersions = DB::table('releases')
        ->where('master_id', $release->master_id)
        ->where('release_id', '!=', $release->release_id)
        ->count();

        $productCount = DB::table('products')
        ->where('release_id', $release->release_id)
        ->count();

        $labels = DB::table('label_release as lr')
        ->join('labels as l', 'lr.label_id', '=', 'l.label_id')
        ->where('lr.release_id', $release->release_id)
        ->pluck('l.name');



        return view('showRelease', compact(
                    'release',
                    'artists',
                    'genres',
                    'styles',
                    'tracks',
                    'companies',
                    'recommendations',
                    'reviews',
                    'stats',
                    'videos',
                    'lists',
                    'contributors',
                    'credits',
                    'barcodes',
                    'otherVersions',
                    'totalVersions',
                    'productCount',
                    'labels',
                    'formats',
        ));
    }

   public function storeReview(Request $request, $id)
{
    // 1. Validasi input comment
    $request->validate([
        'comment' => 'required',
        'rating'  => 'nullable|integer|between:1,5',
    ]);

    // Cari product_id yang memiliki release_id sesuai dengan ID di URL
    $product = DB::table('products')->where('release_id', $id)->first();

    if (!$product) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan!');
    }

    // 2. Simpan ke database
    // Gunakan 'product_id' karena tabel 'reviews' tidak punya kolom 'release_id'
    DB::table('reviews')->insert([
        'product_id' => $product->product_id, // Ambil ID asli produk
        'user_id'    => 1,                    // Sementara dummy
        'comment'    => $request->comment,
        'rating'     => $request->rating ?? null,
        'created_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Review berhasil ditambah!');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}