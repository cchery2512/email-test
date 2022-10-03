<?php

use App\Jobs\SendEmailJob;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('send', function(){
    $data['para'] = 'cchery1225@gmail.com';
    $data['copia'] = ['cchery2512@gmail.com', 'carmelo@ifudis.com'];
    $data['title'] = 'Test Title';
    $data['title2'] = 'Test Title For PDF';
    SendEmailJob::dispatch($data);
    return collect($data);
});
