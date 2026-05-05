<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{

    public function index()
    {
         //home.blade.php
    //best selling dari hasil penjualan produk di transaction_details
    //SQL
    // SELECT i.url AS image,
    // 	   r.title,
    //        GROUP_CONCAT(DISTINCT ar.name) AS artis,
    //        m.year AS tahun,
    //        GROUP_CONCAT(DISTINCT s.name) AS style,
    //        GROUP_CONCAT(DISTINCT g.name) AS genre,
    //        GROUP_CONCAT(DISTINCT f.name) AS format,
    //        SUM(td.quantity) AS total_copies,
    //        MIN(p.price) AS lowest_price
    // FROM releases r

    //   JOIN images i ON r.release_id = i.release_id AND type = 'primary'
    //   JOIN artist_release arl ON r.release_id = arl.release_id
    //   JOIN artists ar ON arl.artist_id = ar.artist_id
    
    //   LEFT JOIN master_albums m ON r.master_id = m.master_id

    //   JOIN release_style sr ON r.release_id = sr.release_id
    //   JOIN styles s ON sr.style_id = s.style_id
    //   JOIN genre_release gr ON r.release_id = gr.release_id
    //   JOIN genres g ON gr.genre_id = g.genre_id

    // JOIN products p ON r.release = p.release

    //   LEFT JOIN format_release fr ON r.release_id = fr.release_id
    //   LEFT JOIN formats f ON fr.format_id = f.format_id

    //   JOIN transaction_details td ON p.product_id = td.product_id
    //   JOIN transactions t ON td.transaction_id = t.transaction_id
    
    // WHERE t.created_at >= NOW() - INTERVAL 7 DAY

    // GROUP BY  r.release_id,
    // 		     i.url,
    //           m.year,

    // ORDER BY total_copies DESC

    // LIMIT 15;
        $albums = DB::table('releases as r')

        ->join('images as i', function($join) {
            $join->on('r.release_id', '=', 'i.release_id')
                 ->where('i.type', '=', 'primary');
            }) 
        ->join('artist_release as arl', 'r.release_id', '=', 'arl.release_id')
        ->join('artists as ar', 'arl.artist_id', '=', 'ar.artist_id')

        ->leftJoin('master_albums as m', 'r.master_id', '=', 'm.master_id')

        ->join('release_style as sr', 'r.release_id', '=', 'sr.release_id')
        ->join('styles as s', 'sr.style_id', '=', 's.style_id')

        ->join('genre_release as gr', 'r.release_id', '=', 'gr.release_id')
        ->join('genres as g', 'gr.genre_id', '=', 'g.genre_id')

        ->join('products as p', 'r.release_id', '=', 'p.release_id')

        ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
        ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')


        ->join('transaction_details as td', 'p.product_id', '=', 'td.product_id')
        ->join('transactions as t', 'td.transaction_id', '=', 't.transaction_id')

        ->select('i.url AS image',
                 'r.title',
                  DB::raw("GROUP_CONCAT(DISTINCT ar.name) AS artis"),
                  'm.year AS tahun',
                  DB::raw("GROUP_CONCAT(DISTINCT s.name SEPARATOR ', ') AS style"),
                  DB::raw("GROUP_CONCAT(DISTINCT g.name SEPARATOR ', ') AS genre"),
                  DB::raw("GROUP_CONCAT(DISTINCT f.name SEPARATOR ', ') AS format"),
                  DB::raw('SUM(td.quantity) as total_copies'),
                  DB::raw('MIN(p.price) as lowest_price')
                )

                // , 'cd','digital', 'album', 'record store day'
        // ->whereBetween('t.created_at', [
        //     now()->startOfWeek(),
        //     now()->endOfWeek()
        // ])

        ->groupBy('r.release_id',
                 'i.url',
                 'r.title',
                 'm.year',
                )
        
        ->orderByDesc('total_copies')
        ->limit(15)
        ->get();


        //home.blade.php
        //valuable dari harga paling mahal, stok sikit dan penjualan terbanyak
        //SQL
        // SELECT 
        //     i.url AS image,
        //     r.title,
        //     GROUP_CONCAT(DISTINCT ar.name) AS artis,
        //     m.year AS tahun,
        //     GROUP_CONCAT(DISTINCT s.name) AS style,
        //     GROUP_CONCAT(DISTINCT g.name) AS genre,
        //     GROUP_CONCAT(DISTINCT f.name) AS format,
        //     MAX(p.price) AS paling_mahal,
        //     SUM(td.quantity) AS total_copies,
        //     SUM(p.stock) AS total_stock
        // FROM releases r

        // JOIN images i 
        //     ON r.release_id = i.release_id 
        //     AND i.type = 'primary'

        // JOIN artist_release arl ON r.release_id = arl.release_id
        // JOIN artists ar ON arl.artist_id = ar.artist_id

        // LEFT JOIN master_albums m ON r.master_id = m.master_id

        // JOIN release_style sr ON r.release_id = sr.release_id
        // JOIN styles s ON sr.style_id = s.style_id

        // JOIN genre_release gr ON r.release_id = gr.release_id
        // JOIN genres g ON gr.genre_id = g.genre_id

        // JOIN products p ON r.release = p.release

        //   LEFT JOIN format_release fr ON r.release_id = fr.release_id
        //   LEFT JOIN formats f ON fr.format_id = f.format_id

        // JOIN transaction_details td ON p.product_id = td.product_id

        // WHERE t.created_at >= NOW() - INTERVAL 7 DAY

        // GROUP BY  
        //     r.release_id,
        //     i.url,
        //     r.title,
        //     m.year,

        // ORDER BY 
        //     paling_mahal DESC,
        //     total_copies DESC,
        //     total_stock ASC

        // LIMIT 15;
        $valuables = DB::table('releases as r')

        ->join('images as i', function($join) {
            $join->on('r.release_id', '=', 'i.release_id')
                 ->where('i.type', '=', 'primary');
            }) 
        ->join('artist_release as arl', 'r.release_id', '=', 'arl.release_id')
        ->join('artists as ar', 'arl.artist_id', '=', 'ar.artist_id')

        ->leftJoin('master_albums as m', 'r.master_id', '=', 'm.master_id')

        ->join('release_style as sr', 'r.release_id', '=', 'sr.release_id')
        ->join('styles as s', 'sr.style_id', '=', 's.style_id')

        ->join('genre_release as gr', 'r.release_id', '=', 'gr.release_id')
        ->join('genres as g', 'gr.genre_id', '=', 'g.genre_id')

        ->join('products as p', 'r.release_id', '=', 'p.release_id')

        ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
        ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')

        ->join('transaction_details as td', 'p.product_id', '=', 'td.product_id')
        ->join('transactions as t', 'td.transaction_id', '=', 't.transaction_id')

        ->select('i.url AS image',
                 'r.title',
                  DB::raw("GROUP_CONCAT(DISTINCT ar.name) AS artis"),
                  'm.year AS tahun',
                  DB::raw("GROUP_CONCAT(DISTINCT s.name SEPARATOR ', ') AS style"),
                  DB::raw("GROUP_CONCAT(DISTINCT g.name SEPARATOR ', ') AS genre"),
                  DB::raw("GROUP_CONCAT(DISTINCT f.name SEPARATOR ', ') AS format"),
                  DB::raw('MAX(p.price) as paling_mahal'),
                  DB::raw('SUM(td.quantity) as total_copies'),
                  DB::raw('SUM(p.stock) as total_stock'),
                )

        // ->whereBetween('t.created_at', [
        //      now()->startOfWeek(),
        //      now()->endOfWeek()
        // ])

        ->groupBy('r.release_id',
                 'i.url',
                 'r.title',
                 'm.year',
                )
        
        ->orderByDesc('paling_mahal')
        ->orderByDesc('total_copies')
        ->orderBy('total_stock', 'asc')
        ->limit(15)
        ->get();

        //home.blade.php
        //valuable dari harga paling mahal, stok sikit dan penjualan terbanyak
        //SQL
        // SELECT 
        //     i.url AS image,
        //     r.title,
        //     GROUP_CONCAT(DISTINCT ar.name) AS artis,
        //     m.year AS tahun,
        //     GROUP_CONCAT(DISTINCT s.name) AS style,
        //     GROUP_CONCAT(DISTINCT g.name) AS genre,
        //     GROUP_CONCAT(DISTINCT f.name) AS format,
        //     SUM(td.quantity) AS total_copies,
        //     COUNT(DISTINCT t.user_id) AS total_yang_di_koleksi
        //     SUM(p.price) AS lowest_price
        // FROM releases r

        // JOIN images i 
        //     ON r.release_id = i.release_id 
        //     AND i.type = 'primary'

        // JOIN artist_release arl ON r.release_id = arl.release_id
        // JOIN artists ar ON arl.artist_id = ar.artist_id

        // LEFT JOIN master_albums m ON r.master_id = m.master_id

        // JOIN release_style sr ON r.release_id = sr.release_id
        // JOIN styles s ON sr.style_id = s.style_id

        // JOIN genre_release gr ON r.release_id = gr.release_id
        // JOIN genres g ON gr.genre_id = g.genre_id

        // JOIN products p ON r.release = p.release

        //   LEFT JOIN format_release fr ON r.release_id = fr.release_id
        //   LEFT JOIN formats f ON fr.format_id = f.format_id

        // JOIN transaction_details td ON p.product_id = td.product_id
        // JOIN transactions t ON td.transaction_id = t.transaction_id

        // GROUP BY  
        //     r.release_id,
        //     i.url,
        //     r.title,
        //     m.year,

        // ORDER BY 
        //     total_yang_di_koleksi DESC

        // LIMIT 15;
        $collecteds = DB::table('releases as r')

        ->join('images as i', function($join) {
            $join->on('r.release_id', '=', 'i.release_id')
                 ->where('i.type', '=', 'primary');
            }) 
        ->join('artist_release as arl', 'r.release_id', '=', 'arl.release_id')
        ->join('artists as ar', 'arl.artist_id', '=', 'ar.artist_id')

        ->leftJoin('master_albums as m', 'r.master_id', '=', 'm.master_id')

        ->join('release_style as sr', 'r.release_id', '=', 'sr.release_id')
        ->join('styles as s', 'sr.style_id', '=', 's.style_id')

        ->join('genre_release as gr', 'r.release_id', '=', 'gr.release_id')
        ->join('genres as g', 'gr.genre_id', '=', 'g.genre_id')

        ->join('products as p', 'r.release_id', '=', 'p.release_id')

        ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
        ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')

        ->join('transaction_details as td', 'p.product_id', '=', 'td.product_id')
        ->join('transactions as t', 'td.transaction_id', '=', 't.transaction_id')

        ->select('i.url AS image',
                 'r.title',
                  DB::raw("GROUP_CONCAT(DISTINCT ar.name) AS artis"),
                  'm.year AS tahun',
                  DB::raw("GROUP_CONCAT(DISTINCT s.name SEPARATOR ', ') AS style"),
                  DB::raw("GROUP_CONCAT(DISTINCT g.name SEPARATOR ', ') AS genre"),
                  DB::raw("GROUP_CONCAT(DISTINCT f.name SEPARATOR ', ') AS format"),
                  DB::raw('SUM(td.quantity) as total_copies'),
                  DB::raw('COUNT(DISTINCT t.user_id) as total_yang_di_koleksi'),
                  DB::raw('SUM(p.price) as total_lowest'),
                )
        
        // ->whereBetween('t.created_at', [
        //      now()->startOfYear(),
        //      now()->endOfYear()
        // ])

        ->groupBy('r.release_id',
                 'i.url',
                 'r.title',
                 'm.year',
                )
        
        ->orderByDesc('total_yang_di_koleksi')
        ->limit(15)
        ->get();

            return view('home', compact('albums', 'valuables', 'collecteds'));

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
        //
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