<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ShowReleaseController;
use App\Http\Controllers\ShowAlbumController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\UserListController;


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


Route::get('/resources', function () {
    return view('resources');
});

Route::get('/mywantlist', function () {
    return view('mywantlist');
});

Route::get('/mywants', function () {
    return view('mywants');
})->name('mywants');

// Route::get('/lists', function () {
//     return view('lists');
// });

Route::get('/submissions', function () {
    return view('submissions');
});

Route::prefix('user')->group(function () {

    Route::get('/collection', function () {
        return view('user.collection');
    })->name('user.collection');

    // Route::get('/lists', function () {
    //     return view('user.lists');
    // })->name('user.lists');

    Route::get('/drafts', function () {
        return view('user.drafts');
    })->name('user.drafts');

    Route::get('/profile', function () {
        return view('user.profile');
    })->name('user.profile');
    
});

Route::get('no_list', function () {
    return view('lists.no_list');
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


Route::get('/showLabel/{id}', [SearchController::class, 'showLabel'])->name('show.label');

//route untuk controller AlbumController.php
Route::get('/', [AlbumController::class, 'index']);
Route::get('/album/{master_id}/versions', [ShowAlbumController::class, 'versions'])->name('album.versions');

//route untuk ShowReleaseController.php
Route::post('/release/{id}/review', [ShowReleaseController::class, 'storeReview'])->name('release.review');
Route::get('/release/{id}', [ShowReleaseController::class, 'show'])->name('show.release');

//route untuk ShowAlbumController.php
Route::get('/albums/{master_id}', [ShowAlbumController::class, 'show'])->name('show.album');
Route::post('/release/{master_id}/review', [ShowAlbumController::class, 'storeReview'])
    ->name('release.review');
Route::put('/review/{id}/update', [ShowAlbumController::class, 'updateReview'])->name('review.update');
Route::delete('/review/{id}/delete', [ShowAlbumController::class, 'destroyReview'])->name('review.delete');

//route untuk SearchController.php
Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/preview', function () {
    return view('release.preview');
});

//route untuk ArtistController.php
Route::get('/artists/{id}', [ArtistController::class, 'show'])->name('show.artist');
Route::post('/artists/{id}/review', [ArtistController::class, 'storeReview'])->name('artist.review');
Route::post('/artists/{id}/add-to-list', [ArtistController::class, 'addToList'])->name('artist.addToList');

//route untuk ListsController
Route::get('/lists', [ListController::class, 'index'])->name('lists.index');

//route untuk UseListController
Route::get('/user/{user_id}/lists', [UserListController::class, 'showList'])->name('user.lists');
Route::get('/lists/{list_id}/edit', [UserListController::class, 'edit'])->name('lists.edit');
Route::put('/lists/{list_id}', [UserListController::class, 'update'])->name('lists.update');
Route::get('/lists/{list_id}', [UserListController::class, 'show'])->name('lists.show');
Route::put('/lists/{list_id}/release/{release_id}', [UserListController::class, 'updateComment'])->name('lists.updateComment');
Route::delete('/lists/{id}', [UserListController::class, 'destroy'])->name('lists.destroy');



