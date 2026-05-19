<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ListModel;
use App\Models\Artist;


class ArtistController extends Controller
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
    public function show(Request $request, string $id)
    {

        // $artist = Artist::with('releases')->findOrFail($id);

        //SQL
        //SELECT ar.name,
        //       ar.real_name,
        //       ar.profile,
        //       ar.image,
        //       GROUP_CONCAT(DISTINCT ars.url) as sites,
        //       GROUP_CONCAT(DISTINCT arv.variation_name) as variations,
        //       GROUP_CONCAT(DISTINCT g.name) as groupss
        // FROM artists ar
        // LEFT JOIN artist_sites ars ON ar.artist_id = ars.artist_id
        // LEFT JOIN artist_variations arv ON ar.artist_id = arv.artist_id
        // LEFT JOIN artist_groups arg ON ar.artist_id = arg.artist_id
        // LEFT JOIN groups g ON arg.group_id = g.group_id
        // WHERE ar.artist_id = ?
        // GROUP BY ar.artist_id,
        //          ar.name,
        //          ar.real_name,
        //          ar.profile;

        $artis = DB::table('artists as ar')
            ->leftJoin('artist_sites as ars', 'ar.artist_id', '=', 'ars.artist_id')
            ->leftJoin('artist_variations as arv', 'ar.artist_id', '=', 'arv.artist_id')
            ->leftJoin('artist_groups as arg', 'ar.artist_id', '=', 'arg.artist_id')
            ->leftJoin('groups as g', 'arg.group_id', '=', 'g.group_id')

            ->select(
                'ar.artist_id',
                'ar.name',
                'ar.real_name',
                'ar.profile',
                'ar.image',
                DB::raw("GROUP_CONCAT(DISTINCT ars.url SEPARATOR ', ') as sites"),
                DB::raw("GROUP_CONCAT(DISTINCT arv.variation_name SEPARATOR ', ') as variations"),
                DB::raw("GROUP_CONCAT(DISTINCT g.name SEPARATOR ', ') as 'groups'")
            )

            ->where('ar.artist_id', $id)

            ->groupBy(
                'ar.artist_id',
                'ar.name',
                'ar.real_name',
                'ar.profile',
                'ar.image'
            )

            ->first();


        // SELECT r.release_id,
        //        r.title,
        //        r.master_id,
        //        i.url AS image,
        //        m.year,
        //        GROUP_CONCAT(DISTINCT f.name SEPARATOR ' · ') AS formats,
        //        MIN(p.price) AS lowest_price,
        //        MAX(p.price) AS highest_price,
        //        COUNT(p.product_id) AS listing_count
        // FROM releases r
        // JOIN artist_release ar ON r.release_id = ar.release_id
        // LEFT JOIN images i ON r.release_id = i.release_id AND i.type = 'primary'
        // LEFT JOIN master_albums m ON r.master_id = m.master_id
        // LEFT JOIN format_release fr ON r.release_id = fr.release_id
        // LEFT JOIN formats f ON fr.format_id = f.format_id
        // LEFT JOIN products p ON r.release_id = p.release_id
        // WHERE ar.artist_id = ?
        // GROUP BY r.release_id,
        //          r.title,
        //          i.url,
        //          m.year
        // LIMIT 3;

        $masters = DB::table('releases as r')

            ->join('artist_release as ar', 'r.release_id', '=', 'ar.release_id')

            ->leftJoin('images as i', function ($join) {
                $join->on('r.release_id', '=', 'i.release_id')
                    ->where('i.type', '=', 'primary');
            })

            ->leftJoin('master_albums as m', 'r.master_id', '=', 'm.master_id')

            ->leftJoin('format_release as fr', 'r.release_id', '=', 'fr.release_id')

            ->leftJoin('formats as f', 'fr.format_id', '=', 'f.format_id')

            ->leftJoin('products as p', 'r.release_id', '=', 'p.release_id')

            ->select(
                'r.release_id',
                'r.title',
                'r.master_id',
                'i.url as image',
                'm.year',
                DB::raw("GROUP_CONCAT(DISTINCT f.name SEPARATOR ' · ') as formats"),
                DB::raw("MIN(p.price) as lowest_price"),
                DB::raw("MAX(p.price) as highest_price"),
                DB::raw("COUNT(DISTINCT p.product_id) as listing_count")
            )

            ->where('ar.artist_id', $id)

            ->groupBy(
                'r.release_id',
                'r.title',
                'r.master_id',
                'i.url',
                'm.year'
            )

            ->take(3)

            ->get();


        // SELECT
        //     COUNT(DISTINCT r.release_id) AS total_releases,
        //     SUM(CASE WHEN fd.description = 'Album' THEN 1 ELSE 0 END) AS albums,
        //     SUM(CASE WHEN fd.description IN ('Single','EP') THEN 1 ELSE 0 END) AS singles_eps,
        //     SUM(CASE WHEN fd.description = 'Compilation' THEN 1 ELSE 0 END) AS compilations,
        //     SUM(CASE WHEN fd.description = 'Misc' THEN 1 ELSE 0 END) AS miscellaneous
        // FROM releases r
        // JOIN artist_release ar ON r.release_id = ar.release_id
        // JOIN format_release fr ON r.release_id = fr.release_id
        // JOIN formats f ON fr.format_id = f.format_id
        // JOIN format_descriptions fd ON fr.id = fd.format_release_id
        // WHERE ar.artist_id = ?;

        $discographys = DB::table('releases as r')

            ->join('artist_release as ar', 'r.release_id', '=', 'ar.release_id')

            ->join('format_release as fr', 'r.release_id', '=', 'fr.release_id')

            ->join('formats as f', 'fr.format_id', '=', 'f.format_id')

            ->join('format_descriptions as fd', 'fr.id', '=', 'fd.format_release_id')

            ->select(
                DB::raw('COUNT(DISTINCT r.release_id) as total_releases'),
                DB::raw("SUM(CASE WHEN fd.description = 'Album' THEN 1 ELSE 0 END) as albums"),
                DB::raw("SUM(CASE WHEN fd.description IN ('Single','EP') THEN 1 ELSE 0 END) as singles_eps"),
                DB::raw("SUM(CASE WHEN fd.description = 'Compilation' THEN 1 ELSE 0 END) as compilations"),
                DB::raw("SUM(CASE WHEN fd.description = 'Misc' THEN 1 ELSE 0 END) as miscellaneous")
            )

            ->where('ar.artist_id', $id)

            ->first();


        // SELECT
        //     COUNT(DISTINCT r.release_id) AS total_appearances,
        //     SUM(CASE WHEN fd.description = 'Album' THEN 1 ELSE 0 END) AS albums,
        //     SUM(CASE WHEN fd.description IN ('Single','EP') THEN 1 ELSE 0 END) AS singles_eps,
        //     SUM(CASE WHEN fd.description = 'Compilation' THEN 1 ELSE 0 END) AS compilations,
        //     SUM(CASE WHEN fd.description = 'Mix' THEN 1 ELSE 0 END) AS mixes,
        //     SUM(CASE WHEN fd.description = 'Video' THEN 1 ELSE 0 END) AS videos,
        //     SUM(CASE WHEN fd.description = 'Misc' THEN 1 ELSE 0 END) AS miscellaneous
        // FROM releases r
        // JOIN artist_release ar ON r.release_id = ar.release_id
        // JOIN format_release fr ON r.release_id = fr.release_id
        // JOIN format_descriptions fd ON fr.id = fd.format_release_id
        // WHERE ar.artist_id = ?;

        $appearances = DB::table('releases as r')

            ->join('artist_release as ar', 'r.release_id', '=', 'ar.release_id')

            ->join('format_release as fr', 'r.release_id', '=', 'fr.release_id')

            ->join('format_descriptions as fd', 'fr.id', '=', 'fd.format_release_id')

            ->select(
                DB::raw('COUNT(DISTINCT r.release_id) as total_appearances'),
                DB::raw("SUM(CASE WHEN fd.description = 'Album' THEN 1 ELSE 0 END) as albums"),
                DB::raw("SUM(CASE WHEN fd.description IN ('Single','EP') THEN 1 ELSE 0 END) as singles_eps"),
                DB::raw("SUM(CASE WHEN fd.description = 'Compilation' THEN 1 ELSE 0 END) as compilations"),
                DB::raw("SUM(CASE WHEN fd.description = 'Mix' THEN 1 ELSE 0 END) as mixes"),
                DB::raw("SUM(CASE WHEN fd.description = 'Video' THEN 1 ELSE 0 END) as videos"),
                DB::raw("SUM(CASE WHEN fd.description = 'Misc' THEN 1 ELSE 0 END) as miscellaneous")
            )

            ->where('ar.artist_id', $id)

            ->first();


        // SELECT
        //     COUNT(DISTINCT r.release_id) AS total_unofficial,
        //     SUM(CASE WHEN fd.description = 'Album' THEN 1 ELSE 0 END) AS albums,
        //     SUM(CASE WHEN fd.description IN ('Single','EP') THEN 1 ELSE 0 END) AS singles_eps,
        //     SUM(CASE WHEN fd.description = 'Compilation' THEN 1 ELSE 0 END) AS compilations,
        //     SUM(CASE WHEN fd.description = 'Video' THEN 1 ELSE 0 END) AS videos,
        //     SUM(CASE WHEN fd.description = 'Misc' THEN 1 ELSE 0 END) AS miscellaneous
        // FROM releases r
        // JOIN artist_release ar ON r.release_id = ar.release_id
        // JOIN format_release fr ON r.release_id = fr.release_id
        // JOIN format_descriptions fd ON fr.id = fd.format_release_id
        // WHERE ar.artist_id = ?
        // AND r.notes LIKE '%Unofficial%';

        $unofficial = DB::table('releases as r')

            ->join('artist_release as ar', 'r.release_id', '=', 'ar.release_id')

            ->join('format_release as fr', 'r.release_id', '=', 'fr.release_id')

            ->join('format_descriptions as fd', 'fr.id', '=', 'fd.format_release_id')

            ->select(
                DB::raw('COUNT(DISTINCT r.release_id) as total_unofficial'),
                DB::raw("SUM(CASE WHEN fd.description = 'Album' THEN 1 ELSE 0 END) as albums"),
                DB::raw("SUM(CASE WHEN fd.description IN ('Single','EP') THEN 1 ELSE 0 END) as singles_eps"),
                DB::raw("SUM(CASE WHEN fd.description = 'Compilation' THEN 1 ELSE 0 END) as compilations"),
                DB::raw("SUM(CASE WHEN fd.description = 'Video' THEN 1 ELSE 0 END) as videos"),
                DB::raw("SUM(CASE WHEN fd.description = 'Misc' THEN 1 ELSE 0 END) as miscellaneous")
            )

            ->where('ar.artist_id', $id)

            ->where('r.notes', 'like', '%Unofficial%')

            ->first();


        // SELECT
        //     COUNT(DISTINCT ar.release_id) AS total_credits,
        //     SUM(CASE WHEN ar.role = 'Featuring' THEN 1 ELSE 0 END) AS featuring,
        //     SUM(CASE WHEN ar.role IN ('Vocals','Backing Vocals','Choir') THEN 1 ELSE 0 END) AS vocals,
        //     SUM(CASE WHEN ar.role IN ('Written By','Composed By','Lyrics By','Arranged By') THEN 1 ELSE 0 END) AS writing_arrangement,
        //     SUM(CASE WHEN ar.role IN ('Producer','Executive Producer','Co-Producer') THEN 1 ELSE 0 END) AS production,
        //     SUM(CASE WHEN ar.role IN ('Engineer','Recording Engineer','Mixing','Mastered By','Edited By','Programmed By') THEN 1 ELSE 0 END) AS technical,
        //     SUM(CASE WHEN ar.role IN ('Guitar','Bass','Drums','Percussion','Piano','Keyboards','Synthesizer','Cello','Violin','Saxophone','Trumpet','Conductor','Orchestra') THEN 1 ELSE 0 END) AS instruments_performance,
        //     SUM(CASE WHEN ar.role IN ('Artwork','Design','Photography') THEN 1 ELSE 0 END) AS visual
        // FROM artist_release ar
        // WHERE ar.artist_id = ?
        // AND ar.role != 'Main';

        $credits = DB::table('artist_release as ar')

            ->select(
                DB::raw('COUNT(DISTINCT ar.release_id) as total_credits'),
                DB::raw("SUM(CASE WHEN ar.role = 'Featuring' THEN 1 ELSE 0 END) as featuring"),
                DB::raw("SUM(CASE WHEN ar.role IN ('Vocals','Backing Vocals','Choir') THEN 1 ELSE 0 END) as vocals"),
                DB::raw("SUM(CASE WHEN ar.role IN ('Written By','Composed By','Lyrics By','Arranged By') THEN 1 ELSE 0 END) as writing_arrangement"),
                DB::raw("SUM(CASE WHEN ar.role IN ('Producer','Executive Producer','Co-Producer') THEN 1 ELSE 0 END) as production"),
                DB::raw("SUM(CASE WHEN ar.role IN ('Engineer','Recording Engineer','Mixing','Mastered By','Edited By','Programmed By') THEN 1 ELSE 0 END) as technical"),
                DB::raw("SUM(CASE WHEN ar.role IN ('Guitar','Bass','Drums','Percussion','Piano','Keyboards','Synthesizer','Cello','Violin','Saxophone','Trumpet','Conductor','Orchestra') THEN 1 ELSE 0 END) as instruments_performance"),
                DB::raw("SUM(CASE WHEN ar.role IN ('Artwork','Design','Photography') THEN 1 ELSE 0 END) as visual")
            )

            ->where('ar.artist_id', $id)

            ->where('ar.role', '!=', 'Main')

            ->first();


        $filter = $request->get('filter');


        // SELECT 
        //     r.release_id,
        //     r.title,
        //     fd.description AS tag,
        //     GROUP_CONCAT(DISTINCT l.name SEPARATOR ', ') AS labels,
        //     m.year,
        //     i.url AS image,
        //     (
        //         SELECT COUNT(DISTINCT rv.release_id) 
        //         FROM releases rv 
        //         WHERE rv.master_id = r.master_id
        //     ) AS versions_count
        // FROM releases r
        // JOIN artist_release ar 
        //     ON r.release_id = ar.release_id
        // JOIN format_release fr 
        //     ON r.release_id = fr.release_id
        // JOIN format_descriptions fd 
        //     ON fr.id = fd.format_release_id
        // LEFT JOIN master_albums m 
        //     ON r.master_id = m.master_id
        // LEFT JOIN label_release lr 
        //     ON r.release_id = lr.release_id
        // LEFT JOIN labels l 
        //     ON lr.label_id = l.label_id
        // LEFT JOIN images i 
        //     ON r.release_id = i.release_id 
        //    AND i.type = 'primary'
        // WHERE ar.artist_id = ?
        // GROUP BY 
        //     r.release_id,
        //     r.title,
        //     fd.description,
        //     r.master_id,
        //     m.year,
        //     i.url;

        $query = DB::table('releases as r')
            ->join('artist_release as ar', 'r.release_id', '=', 'ar.release_id')
            ->join('format_release as fr', 'r.release_id', '=', 'fr.release_id')
            ->join('format_descriptions as fd', 'fr.id', '=', 'fd.format_release_id')
            ->leftJoin('master_albums as m', 'r.master_id', '=', 'm.master_id')
            ->leftJoin('label_release as lr', 'r.release_id', '=', 'lr.release_id')
            ->leftJoin('labels as l', 'lr.label_id', '=', 'l.label_id')
            ->leftJoin('images as i', function ($join) {
                $join->on('r.release_id', '=', 'i.release_id')
                    ->where('i.type', '=', 'primary');
            })
            // ->leftJoin('releases as rv', 'r.master_id', '=', 'rv.master_id')
            ->where('ar.artist_id', $id)
            ->select(
                'r.release_id',
                'r.title',
                DB::raw("GROUP_CONCAT(DISTINCT fd.description SEPARATOR ', ') as tag"),
                DB::raw('GROUP_CONCAT(DISTINCT l.name SEPARATOR ", ") as labels'),
                'm.year',
                'i.url as image',
                DB::raw('(SELECT COUNT(DISTINCT rv.release_id) 
                            FROM releases rv 
                            WHERE rv.master_id = r.master_id) as versions_count')
                )

            ->groupBy(
                'r.release_id',
                'r.title',
                // 'fd.description',
                'm.year',
                'i.url',
                'r.master_id',
            );
            

        if ($filter === 'albums') {
            $query->where('fd.description', 'Album');
        } elseif ($filter === 'singles') {
            $query->whereIn('fd.description', ['Single', 'EP']);
        } elseif ($filter === 'compilations') {
            $query->where('fd.description', 'Compilation');
        } elseif ($filter === 'misc') {
            $query->where('fd.description', 'Misc');
        }

        // untuk Appearances
        elseif ($filter === 'appear_albums') {
            $query->where('fd.description', 'Album');
        } elseif ($filter === 'appear_singles') {
            $query->whereIn('fd.description', ['Single', 'EP']);
        } elseif ($filter === 'appear_compilations') {
            $query->where('fd.description', 'Compilation');
        } elseif ($filter === 'appear_mixes') {
            $query->where('fd.description', 'Mix');
        } elseif ($filter === 'appear_videos') {
            $query->where('fd.description', 'Video');
        } elseif ($filter === 'appear_misc') {
            $query->where('fd.description', 'Misc');
        }

        // Unofficial
        elseif ($filter === 'unoff_albums') {
            $query->where('fd.description', 'Album')
                ->where('r.notes', 'like', '%Unofficial%');
        } elseif ($filter === 'unoff_singles') {
            $query->whereIn('fd.description', ['Single', 'EP'])
                ->where('r.notes', 'like', '%Unofficial%');
        } elseif ($filter === 'unoff_compilations') {
            $query->where('fd.description', 'Compilation')
                ->where('r.notes', 'like', '%Unofficial%');
        } elseif ($filter === 'unoff_videos') {
            $query->where('fd.description', 'Video')
                ->where('r.notes', 'like', '%Unofficial%');
        } elseif ($filter === 'unoff_misc') {
            $query->where('fd.description', 'Misc')
                ->where('r.notes', 'like', '%Unofficial%');
        }

        // Credits
        elseif ($filter === 'credit_featuring') {
            $query->where('ar.role', 'Featuring');
                // ->where('ar.role', '!=', 'Main');
        } elseif ($filter === 'credit_writing') {
            $query->whereIn('ar.role', ['Written By','Composed By','Lyrics By','Arranged By']);
                // ->where('ar.role', '!=', 'Main');
        } elseif ($filter === 'credit_production') {
            $query->whereIn('ar.role', ['Producer','Executive Producer','Co-Producer']);
                // ->where('ar.role', '!=', 'Main');
        } elseif ($filter === 'credit_vocals') {
            $query->whereIn('ar.role', ['Vocals','Backing Vocals','Choir']);
                // ->where('ar.role', '!=', 'Main');
        } elseif ($filter === 'credit_technical') {
            $query->whereIn('ar.role', ['Engineer','Recording Engineer','Mixing','Mastered By','Edited By','Programmed By']);
                // ->where('ar.role', '!=', 'Main');
        } elseif ($filter === 'credit_instruments') {
            $query->whereIn('ar.role', ['Guitar','Bass','Drums','Percussion','Piano','Keyboards','Synthesizer','Cello','Violin','Saxophone','Trumpet','Conductor','Orchestra']);
                // ->where('ar.role', '!=', 'Main');
        } elseif ($filter === 'credit_visual') {
            $query->whereIn('ar.role', ['Artwork','Design','Photography']);
                // ->where('ar.role', '!=', 'Main');
        }

        if (str_starts_with($filter, 'credit_')) {
            $query->where('ar.role', '!=', 'Main');
        }

        $format = $request->get('format');
        $label = $request->get('label');
        $country = $request->get('country');
        $year = $request->get('year');
        $search = $request->get('search');

        if ($format) {
            $query->where('fd.description', 'like', "%{$format}%");
        }
        if ($label) {
            $query->where('l.name', 'like', "%{$label}%");
        }
        if ($country) {
            $query->where('r.country', 'like', "%{$country}%");
        }
        if ($year) {
            $query->where('m.year', $year);
        }
        if ($search) {
            $query->where('r.title', 'like', "%{$search}%");
        }

        $releases = $query->distinct()->paginate(25);

        //SQL
        // SELECT DISTINCT
        //        v.title,
        //        v.youtube_url,
        //        v.thumbnail,
        //        v.duration
        // FROM videos v
        // LEFT JOIN releases r ON r.release_id = v.release_id
        // LEFT JOIN artist_release arl ON r.release_id = arl.release_id
        // WHERE arl.artist_id = ?

        $videos = DB::table('videos as v')
            ->leftJoin('releases as r', 'r.release_id', '=', 'v.release_id')
            ->leftJoin('artist_release as arl', 'r.release_id', '=', 'arl.release_id')

            ->select(
                'v.title',
                'v.youtube_url',
                'v.thumbnail',
                'v.duration'
            )

            ->where('arl.artist_id', $id)
            ->distinct()
            ->get();

        //SQL
        // SELECT COUNT(DISTINCT v.video_id) AS total_videos
        // FROM videos v
        // LEFT JOIN releases r ON r.release_id = v.release_id
        // LEFT JOIN artist_release arl ON r.release_id = arl.release_id
        // WHERE arl.artist_id = ?

        $totalVideos = DB::table('videos as v')
            ->leftJoin('releases as r', 'r.release_id', '=', 'v.release_id')
            ->leftJoin('artist_release as arl', 'r.release_id', '=', 'arl.release_id')

            ->where('arl.artist_id', $id)

            ->distinct('v.video_id')
            ->count('v.video_id');

        //SQL
        // SELECT DISTINCT l.list_id, 
        //                 l.name,
        //                 u.username,
        //                 l.comments,
        //                 l.description,
        //                 l.created_at,
        // FROM lists l
        // LEFT JOIN list_release lr ON l.list_id = lr.list_id
        // LEFT JOIN releases r ON lr.release_id = r.release_id
        // LEFT JOIN artist_release ar ON r.release_id = ar.release_id
        // LEFT JOIN users ar u l.user_id = l.user_id_id
        // ORDER BY l.created_at desc
        // WHERE ar.artist_id = ?

        $lists = DB::table('lists as l')
            ->leftJoin('list_release as lr', 'l.list_id', '=', 'lr.list_id')
            ->leftJoin('releases as r', 'lr.release_id', '=', 'r.release_id')
            ->leftJoin('artist_release as ar', 'r.release_id', '=', 'ar.release_id')
            ->leftJoin('users as u', 'l.user_id', '=', 'u.user_id')
            ->select('l.list_id', 
                     'l.name',
                     'u.username',
                     'u.user_id',
                     'l.comments',
                     'l.description',
                     'l.created_at'
                     )
            ->where('ar.artist_id', $id)
            ->orderBy('l.created_at', 'desc')
            ->distinct()
            ->get();

            $reviews = DB::table('reviews as re')
            ->join('users as ur', 're.user_id', '=', 'ur.user_id')
            ->leftJoin('user_profiles as urp', 'ur.user_id', '=', 'urp.user_id')
            ->join('products as p', 're.product_id', '=', 'p.product_id')
            ->join('releases as r', 'p.release_id', '=', 'r.release_id')
            ->join('artist_release as ar', 'r.release_id', '=', 'ar.release_id')
            ->where('ar.artist_id', $id)
            ->select(
                're.review_id',
                'urp.image',
                'ur.username',
                're.created_at',
                're.rating',
                're.comment'
            )
            ->latest('re.created_at')
            ->get();

        return view('showArtist', compact(
            'artis',
            'masters',
            'discographys',
            'appearances',
            'unofficial',
            'credits',
            'releases',
            'filter',
            'videos',
            'totalVideos',
            'lists',
            'reviews'
        ));


    }

    public function storeReview(Request $request, string $id)
    {
         $product = DB::table('products as p')
            ->join('releases as r', 'p.release_id', '=', 'r.release_id')
            ->join('artist_release as ar', 'r.release_id', '=', 'ar.release_id')
            ->where('ar.artist_id', $id)
            ->select('p.product_id')
            ->first();

        if (!$product) {
            return redirect()->route('show.artist', $id)
                ->with('error', 'Gagal menambah review. Artis ini belum memiliki rilisan produk komersial di marketplace.');
        }

        // dd(session()->all());
        DB::table('reviews')
        ->insert([
            'user_id' => 1,
            // 'user_id' => session('user.user_id'),
            'product_id' => $product->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'created_at' => now(),
        ]);

       return redirect()->route('show.artist', $id)
                         ->with('success', 'Review submitted!');
    }


     public function addToList(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);

        // Cari release_id milik artis ini
        $release = DB::table('artist_release')
            ->where('artist_id', $id)
            ->value('release_id');

        if ($request->listOption === 'new') {
            // buat list baru dengan user yang sedang login
            $list = ListModel::create([
                'user_id' => auth()->id(),
                'name'    => $request->name,
                'description'=> $request->description,
                'comments'=> $request->comments,
            ]);

            // Masukkan release ke list jika ada
            if ($release) {
                DB::table('list_release')->insert([
                    'list_id'   => $list->list_id,
                    'release_id'=> $release,
                ]);
            }
            
        } else {
            // Menambahkan release ke list yang sudah ada
            $list = ListModel::findOrFail($request->list_id);

            if ($release) {
                DB::table('list_release')->insert([
                    'list_id'   => $list->list_id,
                    'release_id'=> $release,
                ]);
            }
        }

    public function addToList(Request $request, $id)
{
    $artist = Artist::findOrFail($id);

    // 1. PINDAHKAN QUERY INI KE PALING ATAS
    $release = DB::table('artist_release')
        ->where('artist_id', $id)
        ->value('release_id');


    if ($request->listOption === 'new') {
        // buat list baru
        $list = ListModel::create([
            'user_id' => 1,
            // 'user_id' => auth()->id(),
            'name'    => $request->name,
            'description'=> $request->description,
            'comments'=> $request->comments,
        ]);

        DB::table('list_release')->insert([
            'list_id'   => $list->list_id,
            'release_id'=> $release,
            'comments'  => $request->comments, // Tambahkan ini agar komentar tersimpan ke database
        ]);
        
    } else {
        $list = ListModel::findOrFail($request->list_id);

        DB::table('list_release')->insert([
            'list_id'    => $list->list_id,
            'release_id' => $release, // HAPUS '->release_id' karena $release sudah berupa ID langsung
        ]);
    }

    return redirect()->route('show.artist', $artist->artist_id)
                    ->with('success', 'Item berhasil ditambahkan ke list: '.$list->name);
}

}