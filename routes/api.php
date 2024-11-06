<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;

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

// Rotas de autenticação
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Rota para obter informações do usuário autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotas de notícias
Route::middleware('auth:sanctum')->apiResource('news', NewsController::class);

// Rotas de comentários
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/news/{newsId}/comments', [CommentController::class, 'store']);
    Route::get('/news/{newsId}/comments', [CommentController::class, 'index']);
    Route::put('/comments/{commentId}', [CommentController::class, 'update']);
    Route::delete('/comments/{commentId}', [CommentController::class, 'destroy']);
});
