<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers;

Route::get('/', 'App\Http\Controllers\ConsumoApiController@index');
