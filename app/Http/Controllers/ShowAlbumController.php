<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterAlbum;


class ShowAlbumController extends Controller
{
    
    public function show($id)
    {

        // SQL:
        // SELECT r.release_id, r.title, i.url, m.year, m.master_id
        // FROM releases r
        // LEFT JOIN images i ON r.release_id = i.release_id AND i.type = 'primary'
        // LEFT JOIN master_albums m ON r.master_id = m.master_id
        // WHERE r.master_id = ?
        $album = DB::table('releases as r')
            ->leftJoin('images as i', function ($join) {
                $join->on('r.release_id', '=', 'i.release_id')
                    ->where('i.type', '=', 'primary');
            })
            ->leftJoin('master_albums as m', 'r.master_id', '=', 'm.master_id')
            ->where('r.master_id', $id)
            ->select(
                'r.release_id',
                'r.title',
                'i.url as image',
                'm.year',
                'm.master_id'
            )
            ->first();

            if (!$album) {
                abort(404, 'Album not found');
            }

        // SQL:
        // SELECT ar.name
        // FROM artist_release arl
        // JOIN artists ar ON arl.artist_id = ar.artist_id
        // WHERE arl.release_id = ?
        $artists = DB::table('artist_release as arl')
            ->join('artists as ar', 'arl.artist_id', '=', 'ar.artist_id')
            ->where('arl.role', '=', 'Main')
            ->where('arl.release_id', $album->release_id)
            ->select('ar.artist_id', 'ar.name')
            ->get();

        // SQL:
        // SELECT g.name
        // FROM genre_release gr
        // JOIN genres g ON gr.genre_id = g.genre_id
        // WHERE gr.release_id = ?
        $genres = DB::table('genre_release as gr')
            ->join('genres as g', 'gr.genre_id', '=', 'g.genre_id')
            ->where('gr.release_id', $album->release_id)
            ->pluck('g.name');

        // SQL:
        // SELECT s.name
        // FROM release_style rs
        // JOIN styles s ON rs.style_id = s.style_id
        // WHERE rs.release_id = ?
        $styles = DB::table('release_style as rs')
            ->join('styles as s', 'rs.style_id', '=', 's.style_id')
            ->where('rs.release_id', $album->release_id)
            ->pluck('s.name');

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
        // SELECT ar.name, arl.role, i.url
        // FROM artist_release arl
        // JOIN artists ar ON arl.artist_id = ar.artist_id
        // LEFT JOIN images i ON ar.artist_id = i.artist_id AND i.type = 'primary'
        // WHERE arl.release_id = ?
        // AND arl.role != 'Main'
        $credits = DB::table('artist_release as arl')
            ->join('artists as ar', 'arl.artist_id', '=', 'ar.artist_id')
            ->leftJoin('images as i', function ($join) {
                $join->on('ar.artist_id', '=', 'i.artist_id')
                    ->where('i.type', '=', 'primary');
            })
            ->where('arl.release_id', $album->release_id)
            ->where('arl.role', '!=', 'Main')
            ->select(
                'ar.name',
                'arl.role',
                'i.url as photo'
            )
            ->get();
            $credits_count = $credits->count();

        // SQL:
        // SELECT SUM(td.quantity), SUM(ct.quantity), AVG(rw.rating), COUNT(rw.rating),
        //        MIN(p.price), MAX(p.price)
        // FROM products p
        // LEFT JOIN transaction_details td ON p.product_id = td.product_id
        // LEFT JOIN cart_items ct ON p.product_id = ct.product_id
        // LEFT JOIN reviews rw ON p.product_id = rw.product_id
        // WHERE p.release_id = ?
        $stats = DB::table('products as p')
            ->leftJoin('transaction_details as td', 'p.product_id', '=', 'td.product_id')
            ->leftJoin('cart_items as ct', 'p.product_id', '=', 'ct.product_id')
            ->leftJoin('reviews as rw', 'p.product_id', '=', 'rw.product_id')
            ->where('p.release_id', $album->release_id)
            ->select(
                DB::raw("SUM(td.quantity) as have"),
                DB::raw("SUM(ct.quantity) as want"),
                DB::raw("AVG(rw.rating) as avg_rating"),
                DB::raw("COUNT(rw.rating) as total_rating"),
                DB::raw("MIN(p.price) as lowest_price"),
                DB::raw("MAX(p.price) as highest_price")
            )
            ->first();

            // SQL:
            // SELECT DISTINCT name FROM formats
            $formats = DB::table('formats')->pluck('name');

            // SQL:
            // SELECT DISTINCT name FROM labels
            $labels = DB::table('labels')->pluck('name');

            // SQL:
            // SELECT DISTINCT country FROM releases
            $countries = DB::table('releases')->distinct()->pluck('country');

            // SQL:
            // SELECT DISTINCT year FROM master_albums
            $years = DB::table('master_albums')->distinct()->pluck('year');

            // SELECT COUNT(*) AS listing_count
            // FROM products
            // WHERE release_id = ?;
            $listing_count = DB::table('products')
            ->where('release_id', $album->release_id)
            ->count();

            // SELECT l.name AS list_name, 
            //        u.username,
            //        l.comments,
            //        l.description,
            //        l.created_at,
            //        l.list_id,
            // FROM list_release lr
            // JOIN lists l ON lr.list_id = l.list_id
            // JOIN users u ON l.user_id = u.user_id
            // WHERE lr.release_id = ?;
            $lists = DB::table('list_release AS lr')
            ->join('lists as l', 'lr.list_id', '=', 'l.list_id')
            ->join('users as u', 'l.user_id', '=', 'u.user_id')

            ->where('lr.release_id', $album->release_id)
             ->select('l.name AS list_name',
                     'u.username',
                     'l.comments',
                     'l.description',
                     'l.created_at',
                     'l.list_id',
                )
            ->orderby('l.created_at', 'desc')
            ->get();

            // SELECT *
            // FROM videos
            // WHERE release_id = ?
            $videos = DB::table('videos')
            ->where('release_id', $album->release_id)
            ->distinct()
            ->get();

            // SQL:
            // SELECT rw.comment,
            //        rw.rating,
            //        rw.created_at,
            //        u.username
            // FROM reviews rw
            // JOIN users u ON rw.user_id = u.user_id
            // JOIN products p ON rw.product_id = p.product_id
            // WHERE p.release_id = ?

            $reviews = DB::table('reviews as rw')
            ->join('users as u', 'rw.user_id', '=', 'u.user_id')
            ->join('products as p', 'rw.product_id', '=', 'p.product_id')
            ->join('releases as r', 'p.release_id', '=', 'r.release_id')

            ->where('p.release_id', $album->release_id)

            ->select(
                'rw.review_id', // TAMBAH INI
                'rw.comment',
                'rw.rating',
                'rw.created_at',
                'u.username',
                'r.title as release_title', //tmbhn
                'r.release_id as release_id' //tmbhn
            )

            ->orderBy('rw.created_at', 'desc')
            ->get();


        return view('showAlbum', compact(
            'album',
            'artists',
            'genres',
            'styles',
            'tracks',
            'credits',
            'stats',
            'formats',
            'labels',
            'countries',
            'years',
            'listing_count',
            'lists',
            'videos',
            'reviews',
            'credits_count'
        ));
    }

    public function versions(Request $request, $master_id)
    {
        
        // $albums = Release::findOrFail($id);
        // ambil input filter dari view
        $format  = $request->format;
        $label   = $request->label;
        $country = $request->country;
        $year    = $request->year;
        $barcode = $request->barcode;
        $catalog_number = $request->catalog_number;

        // SQL:
        // SELECT r.release_id, r.title, i.url, m.year, m.master_id
        // FROM releases r
        // LEFT JOIN images i ON r.release_id = i.release_id AND i.type = 'primary'
        // LEFT JOIN master_albums m ON r.master_id = m.master_id
        // WHERE r.master_id = ?
        $album = DB::table('releases as r')
            ->leftJoin('images as i', function ($join) {
                $join->on('r.release_id', '=', 'i.release_id')
                    ->where('i.type', '=', 'primary');
            })
            ->leftJoin('master_albums as m', 'r.master_id', '=', 'm.master_id')
            ->where('r.master_id', $master_id)
            ->select(
                'r.release_id',
                'r.title',
                'i.url as image',
                'm.year',
                'm.master_id'
            )
            ->first();

            if (!$album) {
                abort(404, 'Album not found');
            }

        // SQL:
        // SELECT ar.name
        // FROM artist_release arl
        // JOIN artists ar ON arl.artist_id = ar.artist_id
        // WHERE arl.release_id = ?
        $artists = DB::table('artist_release as arl')
            ->join('artists as ar', 'arl.artist_id', '=', 'ar.artist_id')
            ->where('arl.role', '=', 'Main')
            ->where('arl.release_id', $album->release_id)
            ->select('ar.artist_id', 'ar.name')
            ->get();
        
        // SQL:
        // SELECT SUM(td.quantity), SUM(ct.quantity), AVG(rw.rating), COUNT(rw.rating),
        //        MIN(p.price), MAX(p.price)
        // FROM products p
        // LEFT JOIN transaction_details td ON p.product_id = td.product_id
        // LEFT JOIN cart_items ct ON p.product_id = ct.product_id
        // LEFT JOIN reviews rw ON p.product_id = rw.product_id
        // WHERE p.release_id = ?
        $stats = DB::table('products as p')
            ->leftJoin('transaction_details as td', 'p.product_id', '=', 'td.product_id')
            ->leftJoin('cart_items as ct', 'p.product_id', '=', 'ct.product_id')
            ->leftJoin('reviews as rw', 'p.product_id', '=', 'rw.product_id')
            ->where('p.release_id', $album->release_id)
            ->select(
                DB::raw("SUM(td.quantity) as have"),
                DB::raw("SUM(ct.quantity) as want"),
                DB::raw("AVG(rw.rating) as avg_rating"),
                DB::raw("COUNT(rw.rating) as total_rating"),
                DB::raw("MIN(p.price) as lowest_price"),
                DB::raw("MAX(p.price) as highest_price")
            )
            ->first();


        $query = DB::table('releases as r')

            // SQL:
            // SELECT *
            // FROM master_albums
            // WHERE master_id = ?
            ->join('master_albums as m', 'r.master_id', '=', 'm.master_id')

            // SQL:
            // SELECT *
            // FROM format_release
            // JOIN formats ON format_release.format_id = formats.format_id
            ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')
            ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')

            // SQL:
            // SELECT *
            // FROM label_release
            // JOIN labels ON label_release.label_id = labels.label_id
            ->leftJoin('label_release as lr', 'r.release_id', '=', 'lr.release_id')
            ->leftJoin('labels as l', 'lr.label_id', '=', 'l.label_id')

            // SQL:
            // SELECT *
            // FROM releases
            ->select(
                'r.release_id',
                'r.title',
                'm.year',
                'r.country',
                'r.barcode',
                DB::raw('GROUP_CONCAT(DISTINCT f.name) as format'),
                DB::raw('GROUP_CONCAT(DISTINCT l.name) as label'),
                DB::raw('GROUP_CONCAT(DISTINCT lr.catalog_number) as catalog_number')
            )

            ->where('r.master_id', $master_id)

            ->groupBy(
                'r.release_id',
                'r.title',
                'm.year',
                'r.country',
                'r.barcode',
            );

        // SQL:
        // SELECT g.name
        // FROM genre_release gr
        // JOIN genres g ON gr.genre_id = g.genre_id
        // WHERE gr.release_id = ?
        $genres = DB::table('genre_release as gr')
            ->join('genres as g', 'gr.genre_id', '=', 'g.genre_id')
            ->where('gr.release_id', $album->release_id)
            ->pluck('g.name');

        if ($format) {
            $query->havingRaw("format LIKE ?", ["%$format%"]);
        }

        if ($label) {
            $query->havingRaw("label LIKE ?", ["%$label%"]);
        }

        if ($country) {
            $query->where('r.country', $country);
        }

        if ($year) {
            $query->where('m.year', $year);
        }
        if ($barcode) {
            $query->where('r.barcode', 'LIKE', "%$barcode%");
        }

        $versions = $query->get();

        foreach ($versions as $v) {
            $v->dropdown_stats = DB::table('products as p')
                ->leftJoin('transaction_details as td', 'p.product_id', '=', 'td.product_id')
                ->leftJoin('cart_items as ct', 'p.product_id', '=', 'ct.product_id')
                ->leftJoin('reviews as rw', 'p.product_id', '=', 'rw.product_id')
                ->where('p.release_id', $v->release_id)
                ->select(
                    DB::raw("IFNULL(SUM(td.quantity), 0) as have"),
                    DB::raw("IFNULL(SUM(ct.quantity), 0) as want"),
                    DB::raw("ROUND(IFNULL(AVG(rw.rating), 0), 1) as avg_rating"),
                    DB::raw("COUNT(rw.rating) as total_rating"),
                    DB::raw("IFNULL(MIN(p.price), 0) as lowest_price"),
                    DB::raw("IFNULL(MAX(p.price), 0) as highest_price"),
                    DB::raw("IFNULL(AVG(p.price), 0) as median_price"),
                )
                ->first();

                $v->dropdown_stats->listing_count = DB::table('products')
                ->where('release_id', $v->release_id)
                ->count();

                $lastSales = DB::table('transaction_details as td')
                ->join('transactions as t', 'td.transaction_id', '=', 't.transaction_id')
                ->join('products as p', 'td.product_id', '=', 'p.product_id')
                ->where('p.release_id', $v->release_id)
                ->orderBy('t.created_at', 'desc') // Urutkan dari yang paling baru
                ->value('t.created_at');

                $v->dropdown_stats->last_sold = $lastSales ? date('M j, Y', strtotime($lastSales)) : 'Never';
                
        }

        // DATA UNTUK DROPDOWN

        $tracks = DB::table('tracks')->where('release_id', $album->release_id)->get();
    
        $credits = DB::table('artist_release as arl')
            ->join('artists as ar', 'arl.artist_id', '=', 'ar.artist_id')
            // ->leftJoin('images as i', function ($join) {
            //     $join->on('arl.release_id', '=', 'i.release_id')->where('i.type', '=', 'primary');
            // })
            ->where('arl.release_id', $album->release_id)
            ->where('arl.role', '!=', 'Main')
            ->select('ar.name', 'arl.role', 'ar.image as photo')
            ->get();
        
            $credits_count = $credits->count();

        $videos = DB::table('videos')->where('release_id', $album->release_id)->get();
        
        // SELECT l.name AS list_name, 
            //        u.username,
            //        l.comments,
            //        l.description,
            //        l.created_at,
            //        l.list_id,
            // FROM list_release lr
            // JOIN lists l ON lr.list_id = l.list_id
            // JOIN users u ON l.user_id = u.user_id
            // WHERE lr.release_id = ?;
            $lists = DB::table('list_release AS lr')
            ->join('lists as l', 'lr.list_id', '=', 'l.list_id')
            ->join('users as u', 'l.user_id', '=', 'u.user_id')

            ->where('lr.release_id', $album->release_id)
             ->select('l.name AS list_name',
                     'u.username',
                     'l.comments',
                     'l.description',
                     'l.created_at',
                     'l.list_id',
                )
            ->orderby('l.created_at', 'desc')
            ->get();

        $reviews = DB::table('reviews as rw')
        ->join('users as u', 'rw.user_id', '=', 'u.user_id')
        ->join('products as p', 'rw.product_id', '=', 'p.product_id')
        ->join('releases as r', 'p.release_id', '=', 'r.release_id') //tmbhn

        ->where('p.release_id', $album->release_id)
        ->select(
            'rw.review_id', // TAMBAH INI
            'rw.comment',
            'rw.rating',
            'rw.created_at',
            'u.username',
            'r.title as release_title',     //tmbhn
            'r.release_id as release_id'    //tmbhn
        )

        ->orderBy('rw.created_at', 'desc')
        ->get();

    // Hitung listing_count untuk sidebar
    $listing_count = DB::table('products')->where('release_id', $album->release_id)->count();

        // SQL:
        // SELECT DISTINCT name FROM formats
        $formats = DB::table('formats')->pluck('name');

        // SQL:
        // SELECT DISTINCT name FROM labels
        $labels = DB::table('labels')->pluck('name');

        // SQL:
        // SELECT DISTINCT country FROM releases
        $countries = DB::table('releases')->distinct()->pluck('country');

        // SQL:
        // SELECT DISTINCT year FROM master_albums
        $years = DB::table('master_albums')->distinct()->pluck('year');

        // SQL:
        // SELECT DISTINCT catalog_number FROM label_release
        $catalog_number = DB::table('label_release')->distinct()->pluck('catalog_number');

        // SQL:
        // SELECT s.name
        // FROM release_style rs
        // JOIN styles s ON rs.style_id = s.style_id
        // WHERE rs.release_id = ?
        $styles = DB::table('release_style as rs')
            ->join('styles as s', 'rs.style_id', '=', 's.style_id')
            ->where('rs.release_id', $album->release_id)
            ->pluck('s.name');

        return view('showAlbum', compact(
            'album',
            'artists',
            'stats',
            'versions',
            'formats',
            'labels',
            'countries',
            'years',
            'genres',
            'tracks',
            'credits',
            'credits_count',
            'videos',
            'lists',
            'reviews',
            'listing_count',
            'styles',
        ));
    }

   public function storeReview(Request $request, $master_id)
    {
        $request->validate([
            'comment' => 'required|min:10',
        ]);

        // cari release pertama dari album/master
        $release = DB::table('releases')
            ->where('master_id', $master_id)
            ->first();

        if (!$release) {
            return back()->with('error', 'Release tidak ditemukan');
        }

        // cari product berdasarkan release
        $product = DB::table('products')
            ->where('release_id', $release->release_id)
            ->first();

        if (!$product) {
            return back()->with('error', 'Product tidak ditemukan');
        }  

        DB::table('reviews')->insert([
            'product_id' => $product->product_id,

            // sementara hardcode dulu
            'user_id' => 1,

            'comment' => $request->comment,

            // default rating sementara
            'rating'     => $request->rating ?? null,

            'created_at' => now(),

        ]);

        return back()->with('success', 'Review berhasil ditambahkan!');
    }


    public function updateReview(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        DB::table('reviews')
            ->where('review_id', $id)
            ->update([
                'comment' => $request->comment,
            ]);

        return redirect()->back()->with('success', 'Review berhasil diupdate!');
    }

    public function destroyReview($id)
    {
        DB::table('reviews')
            ->where('review_id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Review berhasil dihapus!');
    }

     public function addToList(Request $request, $id)
    {
        $releaseData = DB::table('releases')->where('master_id', $id)->first();

        if (!$releaseData) {
            return redirect()->back()->with('error', 'Release tidak ditemukan.');
        }

        if ($request->listOption === 'new') {
            // Buat list baru
            $list = ListModel::create([
                'user_id' => 1,
                // 'user_id' => auth()->id(),
                'name'    => $request->name,
                'description'=> $request->description,
                'comments'=> $request->comments,
            ]);

          
            DB::table('list_release')->insert([
                'list_id'    => $list->list_id,
                'release_id' => $releaseData->release_id, 
            ]);
            
        } else {
          
            $list = ListModel::findOrFail($request->list_id);

            DB::table('list_release')->insert([
                'list_id'    => $list->list_id,
                'release_id' => $releaseData->release_id,
            ]);
        }

        // Redirect menggunakan property artist_id dari object $releaseData yang dicari di atas
        return redirect()->route('album.versions', $releaseData->artist_id)
                        ->with('success', 'Item berhasil ditambahkan ke list: ' . $list->name);
    }

}