<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// If we implement ability to create/modify jobs, can make a full apiResource controller
// Route::apiResource('postings', 'App\Http\Controllers\PostingController');

// Single API endpoint for searching for jobs by matching skills
Route::match(['get','post'], 'postings/search/skills', 'App\Http\Controllers\Api\PostingController@searchSkills');

Route::apiResource('skills', 'App\Http\Controllers\Api\SkillController')->only(['index']);
