<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ShowReleaseController;
use App\Http\Controllers\ShowAlbumController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ShopController;


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

Route::get('no_list', function () {
    return view('lists.no_list');
});

Route::prefix('sell')->group(function () {

    // Route::get('/list', function () {
    //     return view('sell.list');
    // })->name('sell.list');

    Route::get('/list', [ShopController::class, 'index'])->name('sell.list');

    Route::get('/release/{id}', [\App\Http\Controllers\ShowReleaseController::class, 'show'])->name('release.show');

    // Route::get('/cart', function () {
    //     return view('sell.cart');
    // })->name('sell.cart');
        
        Route::get('/cart', [CartController::class, 'index'])->name('sell.cart');
        Route::delete('/cart/item/{id}',         [CartController::class, 'removeItem'])->name('cart.removeItem');
        Route::delete('/cart/seller/{sellerId}', [CartController::class, 'removeSeller'])->name('cart.removeSeller');
        Route::post('/cart/add-back', [CartController::class, 'addBack'])->name('cart.addBack');
        Route::post('/cart/place-order',         [CartController::class, 'placeOrder'])->name('cart.placeOrder');

         Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

    
    // Route::get('/purchases', function () {
    //     return view('sell.purchases');
    // })->name('sell.purchases');
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('sell.purchases');
    Route::get('/purchases/{id}', [PurchaseController::class, 'show'])->name('sell.purchases.show');
});

Route::prefix('settings')->group(function () {

    Route::get('/user', function () {
        return view('settings.user');
    })->name('settings.user');

    Route::get('/buyer', function () {
        return view('settings.buyer');
    })->name('settings.buyer');
    
});

//route untuk ShowLabelController.php
Route::get('/showLabel/{id}', [SearchController::class, 'showLabel'])->name('show.label');

//route untuk review label
Route::post('/showLabel/{id}/review', [SearchController::class, 'storeReview'])->name('label.review.store');

//route untuk controller AlbumController.php
Route::get('/', [AlbumController::class, 'index']);
Route::get('/album/{master_id}/versions', [ShowAlbumController::class, 'versions'])->name('album.versions');

//route untuk ShowReleaseController.php
Route::get('/release/{id}', [ShowReleaseController::class, 'show'])->name('show.release');

//route untuk ShowAlbumController.php
Route::get('/albums/{master_id}', [ShowAlbumController::class, 'show'])->name('show.album');

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