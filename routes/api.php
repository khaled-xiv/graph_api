<?php

use App\Http\Controllers\GraphController;
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

Route::post('graphs', [GraphController::class,'createEmptyGraph']);
Route::patch('graphs/{graph}/edit', [GraphController::class,'updateMetaData']);
Route::delete('graphs/{graph}', [GraphController::class,'delete']);
Route::get('graphs', [GraphController::class,'getGraphs']);
Route::post('graphs/{graph}/nodes', [GraphController::class,'addNodeToGraph']);
Route::post('graphs/{graph}/nodes/{node}/nodes/{child}', [GraphController::class,'addRelationToGraph']);
Route::post('graphs/{graph}/update', [GraphController::class,'updateGraphShape']);
Route::get('graphs/{graph}', [GraphController::class,'show']);
Route::delete('graphs/{graph}/nodes/{node}', [GraphController::class,'deleteNode']);
