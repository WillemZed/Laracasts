<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    DB::listen(function ($query) {
        logger($query->sql, $query->bindings);
    });

    return view('posts', [
        "posts" => Post::all()
    ]);
});


Route::get('posts/{post:slug}', function (Post $post) {
    // Find a post by slug and pass it to view "post"

    return view("post", [
        "post" => $post
    ]);
});

Route::get('categories/{category:slug}', function(Category $category) {
    return view('posts', [
        "posts" => $category->posts
    ]);
});


