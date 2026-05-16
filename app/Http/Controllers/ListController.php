<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    //     SELECT DISTINCT 
    //     u.username,
    //     l.name,
    //     l.created_at,
    //     up.image,
    //     l.description,
    //     l.user_id
    // FROM lists AS l
    // LEFT JOIN users AS u ON l.user_id = u.user_id
    // LEFT JOIN user_profiles AS up ON u.user_id = up.user_id
    // ORDER BY l.created_at DESC
    // LIMIT 25 OFFSET 0;

        $perPage = $request->input('show', 25);
        $page = $request->input('page', 1);

        $lists = DB::table('lists as l')
            ->leftJoin('users as u', 'l.user_id', '=', 'u.user_id')
            ->leftJoin('user_profiles as up', 'u.user_id', '=', 'up.user_id')

            ->select('u.username',
                     'l.name',
                     'l.created_at',
                     'up.image',
                     'l.description',
                     'l.user_id',
            )
            ->orderBy('l.created_at', 'desc')
            ->limit($perPage)
            ->distinct()
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

            $total = DB::table('lists')->count();

             return view('lists', compact('lists', 'total', 'perPage', 'page'));
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
