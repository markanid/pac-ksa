<?php

use App\Http\Controllers\Admin\{AboutController, BlogController, CategoryController, ClientController, ContactController, FeatureController, LoginController, MetaDataController, ProjectController, ServiceController, TeamController, TestimonialController,SlidersController};
use App\Http\Controllers\UserPageController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::get('/',[UserPageController::class,'home'])->name('users.home'); 
Route::get('/aboutus',[UserPageController::class,'about'])->name('users.aboutus'); 
Route::get('/services',[UserPageController::class,'service'])->name('users.services'); 
Route::get("/servicedetails/{slug}", [UserPageController::class, 'servicedetails'])->where('slug', '[A-Za-z0-9\-]+')->name('users.servicedetails');
Route::get("/projects", [UserPageController::class, 'projects'])->name('users.projects');
Route::get('contactus',[UserPageController::class,'contact'])->name('users.contactus'); 
Route::post('/send-email', [UserPageController::class, 'sendEmail'])->name('send.email');

Route::prefix('ar')->group(function () {
    
    Route::get('/', [UserPageController::class,'home_ar'])->name('users.home.ar');
    Route::get('/aboutus', [UserPageController::class,'about_ar'])->name('users.aboutus.ar');
    Route::get('/services', [UserPageController::class,'service_ar'])->name('users.services.ar');
    Route::get('/projects', [UserPageController::class,'projects_ar'])->name('users.projects.ar');
    Route::get('/contactus', [UserPageController::class,'contact_ar'])->name('users.contactus.ar');
    Route::get('/servicedetails/{slug}', [UserPageController::class,'servicedetails_ar'])->name('users.servicedetails.ar');
    
    Route::post('/send-email', [UserPageController::class, 'sendEmail'])->name('send.email.ar');
});

Route::group(["prefix"=> "admin"], function () {
// Admin routes
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/', [LoginController::class, 'index'])->name('login');
        Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
        Route::get('/registration', [LoginController::class, 'registration'])->name('registration');
        Route::post('/register-process', [LoginController::class, 'registerProcess'])->name('registerProcess');

    });
// Authenticated routes
    Route::group(['middleware' => 'auth'], function () {
        // Dashboard and Profile routes
        Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
        Route::get('/change-password', [LoginController::class, 'showChangePasswordForm'])->name('changePasswordForm');
        Route::post('/change-password', [LoginController::class, 'changePassword'])->name('changePassword');
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        // Resourceful routes for Admin sections
        $resources = [
            'meta_data'     => MetaDataController::class,
            'about'         => AboutController::class,
            'services'      => ServiceController::class,
            'categories'    => CategoryController::class,
            'projects'      => ProjectController::class,
            'features'      => FeatureController::class,
            'clients'       => ClientController::class,
            'contact'       => ContactController::class,
            'sliders'       => SlidersController::class,
        ];

        foreach ($resources as $resource => $controller) {
            Route::get("$resource", [$controller, 'index'])->name("$resource.index");
            Route::get("$resource/create", [$controller, 'createOrEdit'])->name("$resource.create");
            Route::get("$resource/{id}", [$controller, 'show'])->where('id', '[0-9]+')->name("$resource.show");
            Route::get("$resource/{slug}", [$controller, 'show'])->where('slug', '[A-Za-z0-9\-]+')->name("$resource.show");
            Route::get("$resource/edit/{id}", [$controller, 'createOrEdit'])->name("$resource.edit");
            Route::post("$resource/update", [$controller, 'storeOrUpdate'])->name("$resource.update");
            Route::get("$resource/delete/{id}", [$controller, 'destroy'])->name("$resource.delete");
        }
    });
});