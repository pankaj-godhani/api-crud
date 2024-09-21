<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\OrganizerController;
use App\Http\Controllers\API\ProjectFileController;
use App\Http\Controllers\API\DonationController;
use App\Http\Controllers\API\UpdateController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('tags', TagController::class);
Route::get('organizers', OrganizerController::class);
Route::apiResource('projects', ProjectController::class);
Route::apiResource('project-files', ProjectFileController::class)->only('destroy');
Route::apiResource('projects/{project}/donations', DonationController::class)->only('store');
Route::apiResource('projects/{project}/updates', UpdateController::class)->only('store');
