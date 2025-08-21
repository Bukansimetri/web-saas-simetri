<?php

use App\Livewire\Simetri\SearchResult;
use App\Livewire\SuperDuper\BlogDetails;
use App\Livewire\SuperDuper\BlogList;
use App\Livewire\SuperDuper\Pages\AboutUs;
use App\Livewire\SuperDuper\Pages\ContactUs;
use App\Livewire\SuperDuper\Pages\Faq;
use App\Livewire\SuperDuper\Pages\Products;
use Illuminate\Support\Facades\Route;
use Lab404\Impersonate\Services\ImpersonateManager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/** Homa Page */
Route::get('/', function () {
    return view('components.superduper.pages.home');
})->name('home');

/** Search Page */
Route::get('/search/{q?}', SearchResult::class)->name('search.results');

/** Custom Page */
Route::get('/about-us', AboutUs::class)->name('about-us');
Route::get('/tnc', Faq::class)->name('tnc');
Route::get('/contact-us', ContactUs::class)->name('contact-us');

/** Blog Page */
Route::get('/blog', BlogList::class)->name('blog');
Route::get('/blog/{slug}', BlogDetails::class)->name('blog.show');

/** Product Page */
Route::get('/products', Products::class)->name('products.index');
Route::get('/category/{productCategory}', Products::class)->name('products.category');
Route::get('/tag/{tag}', Products::class)->name('products.tag');

/** Unmanagable Page */
Route::get('/privacy-policy', function () {
    return view('components.superduper.pages.coming-soon', ['page_type' => 'privacy']);
})->name('privacy-policy');
Route::get('/terms-conditions', function () {
    return view('components.superduper.pages.coming-soon', ['page_type' => 'privacy']);
})->name('terms-conditions');
Route::get('/coming-soon', function () {
    return view('components.superduper.pages.coming-soon', ['page_type' => 'generic']);
})->name('coming-soon');
Route::get('/errorpage', function () {
    return view('404');
})->name('errorpage');

/** Get in touch Function */
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])
    ->name('contact.submit');

/** Admin Panel Custom Page */
Route::post('/blog-preview', function () {
    // Implementation pending
})->name('blog.preview');

Route::get('impersonate/leave', function () {
    if (! app(ImpersonateManager::class)->isImpersonating()) {
        return redirect('/');
    }

    app(ImpersonateManager::class)->leave();

    return redirect(
        session()->pull('impersonate.back_to')
    );
})->name('impersonate.leave')->middleware('web');
