<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ShowReleaseController;
use App\Http\Controllers\ShowAlbumController;

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

Route::get('/lists', function () {
    return view('lists');
});

Route::get('/submissions', function () {
    return view('submissions');
});

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

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('user.profile');
    
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

Route::prefix('settings')->group(function () {

    Route::get('/user', function () {
        return view('settings.user');
    })->name('settings.user');

    Route::get('/buyer', function () {
        return view('settings.buyer');
    })->name('settings.buyer');
    
});

Route::get('/showArtist', function () {
    return view('showArtist');
});

// Route::get('/showAlbum', function () {
//     return view('showAlbum');
// });

// Route::get('/showAlbum/{id}', function ($id) {
//     $album = \App\Models\Album::with(['tracks','credits','reviews'])->findOrFail($id);
//     return view('showAlbum', compact('album'));
// });

// Route::get('/showRelease', function () {
//     return view('showRelease', [
//         'album' => (object)[]
//     ]);
// });

Route::get('/showLabel', function () {
    return view('showLabel');
});

//route untuk controller AlbumController.php
Route::get('/', [AlbumController::class, 'index']);

Route::get('/album/{master_id}/versions', [ShowAlbumController::class, 'versions'])->name('album.versions');

//route untuk ShowReleaseController.php
Route::get('/release/{id}', [ShowReleaseController::class, 'show'])->name('show.release');

//route untuk ShowAlbumController.php
Route::get('/albums/{master_id}', [ShowAlbumController::class, 'show'])->name('show.album');


