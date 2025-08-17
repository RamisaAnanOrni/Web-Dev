<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ThemeController;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::post('/theme/toggle', [ThemeController::class, 'toggle'])->name('theme.toggle');
});

require __DIR__.'/auth.php';
