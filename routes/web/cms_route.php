<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NewsGuestController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubscriberBackEndController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\VideoController;
use Illuminate\Support\Facades\Route;

include_once('appsetting_routes.php');
Route::resource('video', VideoController::class);
// Route::resource('news', NewsController::class);
Route::resource('slider', SliderController::class);
Route::resource('tag', TagController::class);
Route::resource('blog', BlogController::class);
Route::resource('testimonial', TestimonialController::class);
Route::resource('faq', FaqController::class);
Route::resource('information', InformationController::class);
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/content/{slug}', [SliderController::class, 'sliderDetail'])->name('sliderDetail');
Route::get('contact/view/{contact}', [ContactController::class, 'view'])->name('contact.show');
Route::get('menu/original/order', [MenuController::class, 'resetorder'])->name('menu.resetoreder');
