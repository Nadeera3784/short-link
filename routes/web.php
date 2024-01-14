<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\HomeController;
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


//Route::get('{any?}', fn () => view('app'))->where('any', '.*');

// Route::get('{shortUrl?}', function ($shortUrl = null) {
//     if ($shortUrl) {
//         // Handle the short URL, for example, redirect to the original URL
//         // You can implement your logic here
//         // $originalUrl = // Logic to retrieve the original URL based on $shortUrl
//         // return redirect($originalUrl);
//         return "Handling short URL: $shortUrl"; // Example response
//     } else {
//         // No short URL provided, show the default app view
//         return view('app');
//     }
// })->where('shortUrl', '.*');

Route::get('{shortUrl?}', [HomeController::class, 'index'])->where('shortUrl', '.*');