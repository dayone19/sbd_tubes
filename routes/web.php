<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ValuableController;
use App\Http\Controllers\AdvancedSearchController;

use App\Http\Controllers\ShowReleaseController;
use App\Http\Controllers\ShowAlbumController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\NavbarSearchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SubmitReleaseController;



Route::get('/selling', function () {
    return view('selling');
});



// Route untuk menampilkan form advanced search
Route::get('/search/advanced', [AdvancedSearchController::class, 'index'])->name('advanced.search');

// Route untuk memproses hasil pencarian dari form
Route::get('/search/advanced/results', [AdvancedSearchController::class, 'search'])->name('advanced.results');





// Route::get('/search/advanced', function () {
//     return view('search.advanced');
// });

// Route::get('/release/add', function () {
//     return view('release.add');
// });

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
Route::post('/album/{id}/add-to-list', [ShowAlbumController::class, 'addToList'])->name('album.addToList');

//route untuk ShowReleaseController.php
Route::post('/release/{id}/review', [ShowReleaseController::class, 'storeReview'])->name('release.review');
Route::get('/release/{id}', [ShowReleaseController::class, 'show'])->name('show.release');
Route::post('/release/{id}/add-to-list', [ShowReleaseController::class, 'addToList'])->name('release.addToList');

//route untuk ShowAlbumController.php
Route::get('/albums/{master_id}', [ShowAlbumController::class, 'show'])->name('show.album');
Route::post('/album/{master_id}/review', [ShowAlbumController::class, 'storeReview'])->name('album.review');
Route::put('/review/{id}/update', [ShowAlbumController::class, 'updateReview'])->name('review.update');
Route::delete('/review/{id}/delete', [ShowAlbumController::class, 'destroyReview'])->name('review.delete');

//route untuk SearchController.php
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Route::get('/preview', function () {
//     return view('release.preview');
// });

Route::get('/releases/preview/{id}', [SubmitReleaseController::class, 'preview'])
    ->name('releases.preview');

//route untuk ArtistController.php
Route::get('/artists/{id}', [ArtistController::class, 'show'])->name('show.artist');
Route::post('/artists/{id}/review', [ArtistController::class, 'storeReview'])->name('artist.review');
Route::post('/artists/{id}/add-to-list', [ArtistController::class, 'addToList'])->name('artist.addToList');
Route::post('/artist/{id}/review', [ShowReleaseController::class, 'storeReview'])->name('artist.review');


//route untuk ListsController
Route::get('/lists', [ListController::class, 'index'])->name('lists.index');

//route untuk UseListController
Route::get('/user/{user_id}/lists', [UserListController::class, 'showList'])->name('user.lists');
Route::get('/lists/{list_id}/edit', [UserListController::class, 'edit'])->name('lists.edit');
Route::put('/lists/{list_id}', [UserListController::class, 'update'])->name('lists.update');
Route::get('/lists/{list_id}', [UserListController::class, 'show'])->name('lists.show');
Route::put('/lists/{list_id}/release/{release_id}', [UserListController::class, 'updateComment'])->name('lists.updateComment');
Route::delete('/lists/{id}', [UserListController::class, 'destroy'])->name('lists.destroy');
Route::delete('/lists/{list_id}/remove-release/{release_id}', [UserListController::class, 'removeRelease'])->name('lists.removeRelease');

//route untuk NavbarSearchController
Route::get('/api/search', [NavbarSearchController::class, 'search'])->name('api.search');

//route untuk SubmitReleaseController
Route::get('/releases/add', [SubmitReleaseController::class, 'create'])->name('releases.create');
Route::post('/releases/add', [SubmitReleaseController::class, 'store'])->name('releases.store');

