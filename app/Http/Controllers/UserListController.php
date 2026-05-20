<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('show', 25);
        $page = $request->input('page', 1);

        // SQL:
        // SELECT u.username, l.name, l.created_at, up.image, l.description, l.user_id
        // FROM lists AS l
        // LEFT JOIN users AS u ON l.user_id = u.user_id
        // LEFT JOIN user_profiles AS up ON u.user_id = up.user_id
        // ORDER BY l.created_at DESC
        // LIMIT {perPage} OFFSET {(page-1)*perPage};
        $lists = DB::table('lists as l')
            ->leftJoin('users as u', 'l.user_id', '=', 'u.user_id')
            ->leftJoin('user_profiles as up', 'u.user_id', '=', 'up.user_id')
            ->select('u.username','l.name','l.created_at','up.image','l.description','l.user_id')
            ->orderBy('l.created_at', 'desc')
            ->distinct()
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        // SQL:
        // SELECT COUNT(*) AS total FROM lists;
        $total = DB::table('lists')->count();

        return view('lists.no_list', compact('lists', 'total', 'perPage', 'page'));
    }

<<<<<<< HEAD
=======

>>>>>>> 0678d6a92efb6babe72d2a4bace47963018883e0
    public function create() { /* kosong */ }
    public function store(Request $request) { /* kosong */ }

<<<<<<< HEAD
=======
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $userId = auth()->id();

        // SQL: INSERT INTO lists (user_id, name, description, created_at) VALUES (...);
        $listId = DB::table('lists')->insertGetId([
            'user_id' => $userId,
            'name' => $request->input('name'),
            'description' => $request->input('description', ''),
        ]);

        return redirect()->route('lists.show', $listId)->with('success', 'List berhasil dibuat!');
    }



>>>>>>> 0678d6a92efb6babe72d2a4bace47963018883e0
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // SQL:
        // SELECT l.list_id, l.name, l.description, l.comments, l.created_at, u.username, up.image, l.user_id
        // FROM lists AS l
        // LEFT JOIN users AS u ON l.user_id = u.user_id
        // LEFT JOIN user_profiles AS up ON u.user_id = up.user_id
        // WHERE l.list_id = {id} LIMIT 1;
        $list = DB::table('lists as l')
            ->leftJoin('users as u', 'l.user_id', '=', 'u.user_id')
            ->leftJoin('user_profiles as up', 'u.user_id', '=', 'up.user_id')
            ->select('l.list_id','l.name','l.description','l.comments','l.created_at','u.username','up.image','l.user_id')
            ->where('l.list_id', $id)
            ->first();

        if (!$list) { abort(404); }

        $itemComments = $list->comments ? json_decode($list->comments, true) : [];

        // SQL:
        // SELECT r.release_id, r.title,
        // GROUP_CONCAT(DISTINCT a.name SEPARATOR ', ') AS artist,
        // i.url AS image_url,
        // l.comments,
        // lr.list_item_id
        // FROM list_release AS lr
        // JOIN lists AS l ON lr.list_id = l.list_id
        // JOIN releases AS r ON lr.release_id = r.release_id
        // LEFT JOIN artist_release AS ar ON r.release_id = ar.release_id
        // LEFT JOIN artists AS a ON ar.artist_id = a.artist_id
        // LEFT JOIN images AS i ON r.release_id = i.release_id AND i.type = 'primary'
        // WHERE ar.role = 'Main'
        // AND lr.list_id = {id}
        // GROUP BY r.release_id, r.title, i.url, l.comments, lr.list_item_id
        // ORDER BY lr.list_item_id;
        $items = DB::table('list_release as lr')
            ->join('lists as l', 'lr.list_id', '=', 'l.list_id')
            ->join('releases as r', 'lr.release_id', '=', 'r.release_id')
            ->leftJoin('artist_release as ar', 'r.release_id', '=', 'ar.release_id')
            ->leftJoin('artists as a', 'ar.artist_id', '=', 'a.artist_id')
            ->leftJoin('images as i', function($join) {
                $join->on('r.release_id', '=', 'i.release_id')
                    ->where('i.type', '=', 'primary');
            })
            ->select('r.release_id','r.title',DB::raw('GROUP_CONCAT(DISTINCT a.name SEPARATOR ", ") as artist'),
                     'i.url as image_url','lr.list_item_id')
            ->where('ar.role', '=', 'Main')
            ->where('lr.list_id', $id)
            ->groupBy('r.release_id','r.title','i.url','lr.list_item_id')
            ->distinct()
            ->orderBy('lr.list_item_id')
            ->get();

        return view('lists.no_list', compact('list','items','itemComments'));
    }

    public function showList(Request $request, string $user_id)
    {
        $perPage = $request->input('show', 25);

        // SQL:
        // SELECT u.username, l.name, l.created_at, up.image, l.description, l.user_id, l.list_id
        // FROM lists AS l
        // LEFT JOIN users AS u ON l.user_id = u.user_id
        // LEFT JOIN user_profiles AS up ON u.user_id = up.user_id
        // LEFT JOIN list_release AS lr ON l.list_id = lr.list_id
        // WHERE l.user_id = 1
        // ORDER BY l.created_at DESC
        // LIMIT {perPage};
        $lists = DB::table('lists as l')
            ->leftJoin('users as u', 'l.user_id', '=', 'u.user_id')
            ->leftJoin('user_profiles as up', 'u.user_id', '=', 'up.user_id')
            ->leftJoin('list_release as lr', 'l.list_id', '=', 'lr.list_id')
            ->select('u.username','l.name','l.created_at','up.image','l.description','l.user_id','l.list_id')
            ->orderBy('l.created_at', 'desc')
            ->where('l.user_id', $user_id)
            ->distinct()
            ->limit($perPage)
            ->get();

        $total = DB::table('lists')
            ->where('user_id', $user_id)
            ->count();

        return view('user.lists', compact('lists', 'user_id', 'total', 'perPage'));
    }

    public function edit(string $id)
    {
        // SQL:
        // SELECT * FROM lists WHERE list_id = {id} LIMIT 1;
        $list = DB::table('lists')->where('list_id', $id)->first();

        if (!$list) { abort(404); }

        return view('lists.no_list', compact('list'));
    }

    public function update(Request $request, string $id)
    {
        $data = [];
        if ($request->has('description')) {
            $data['description'] = $request->input('description');
        }

        // SQL:
        // UPDATE lists SET description = {description} WHERE list_id = {id};
        if (!empty($data)) {
            DB::table('lists')->where('list_id', $id)->update($data);
        }

        return redirect()->route('lists.show', $id)->with('success', 'List updated successfully!');
    }

    public function updateComment(Request $request, string $list_id, string $release_id)
    {
        $newComment = $request->input('comments');

        // SQL:
        // SELECT * FROM lists WHERE list_id = {list_id} LIMIT 1;
        $list = DB::table('lists')->where('list_id', $list_id)->first();

        $comments = [];
        if (!empty($list->comments)) {
            $decoded = json_decode($list->comments, true);
            if (is_array($decoded)) {
                $comments = $decoded;
            }
        }

        // Update hanya untuk release_id tertentu
        $comments[$release_id] = $newComment;

        // SQL:
        // UPDATE lists SET comments = {json_comments} WHERE list_id = {list_id};
        DB::table('lists')->where('list_id', $list_id)->update([
            'comments' => json_encode($comments),
        ]);

        return redirect()->route('lists.show', $list_id)->with('success', 'Comment updated for release '.$release_id);
    }

    public function destroy(string $id)
    {
        // SQL:
        // DELETE FROM list_release WHERE list_id = {id};
        DB::table('list_release')->where('list_id', $id)->delete();

        // SQL:
        // DELETE FROM lists WHERE list_id = {id};
        DB::table('lists')->where('list_id', $id)->delete();

        return redirect()->route('lists.index')->with('success', 'List deleted successfully!');
    }

    public function removeRelease(string $list_id, string $release_id)
    {
        DB::table('list_release')
            ->where('list_id', $list_id)
            ->where('release_id', $release_id)
            ->delete();

        // INI UNTUK TRIGGER:
        // Trigger BEFORE INSERT ON list_release
        // digunakan untuk mencegah duplikasi release dalam satu list (list_id + release_id)
        // sehingga 1 release tidak bisa masuk 2x ke list yang sama

        return redirect()->route('lists.show', $list_id)->with('success', 'Item berhasil dihapus dari list!');
    }
}