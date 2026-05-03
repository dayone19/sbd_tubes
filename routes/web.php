<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ValuableController;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/selling', function () {
    return view('selling');
});

Route::get('/search/advanced', function () {
    return view('search.advanced');
});

Route::get('/release/add', function () {
    return view('release.add');
});

Route::get('/start', function () {
    return view('start');
});

Route::get('/updates', function () {
    return view('updates');
});

Route::get('/htg', function () {
    return view('htg');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/signup', function () {
    return view('auth.signup');
});

Route::get('/search', function () {
    return view('search');
})->name('search');

Route::get('/resources', function () {
    return view('resources');
});

Route::get('/mywantlist', function () {
    return view('mywantlist');
});

Route::get('/mywants', function () {
    return view('mywants');
})->name('mywants');

Route::prefix('user')->group(function () {

    Route::get('/collection', function () {
        return view('user.collection');
    })->name('user.collection');

    Route::get('/lists', function () {
        return view('user.lists');
    })->name('user.lists');

    Route::get('/drafts', function () {
        return view('user.drafts');
    })->name('user.drafts');
    
});

Route::prefix('sell')->group(function () {

    Route::get('/list', function () {
        return view('sell.list');
    })->name('sell.list');

    Route::get('/cart', function () {
        return view('sell.cart');
    })->name('sell.cart');
    
    Route::get('/purchases', function () {
        return view('sell.purchases');
    })->name('sell.purchases');
});

Route::get('/showArtist', function () {
    return view('showArtist');
});

Route::get('/showAlbum', function () {
    return view('showAlbum');
});

Route::get('/showAlbum/{id}', function ($id) {
    $album = \App\Models\Album::with(['tracks','credits','reviews'])->findOrFail($id);
    return view('showAlbum', compact('album'));
});

//route untuk controller AlbumController.php
Route::get('/', [AlbumController::class, 'index']);

//route untuk controller ValuableController.php
Route::get('/valuables', [ValuableController::class, 'index']);