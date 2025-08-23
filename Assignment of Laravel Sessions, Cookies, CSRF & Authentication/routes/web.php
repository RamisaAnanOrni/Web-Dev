use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return redirect()->route('tasks.index');
});


Route::middleware(['auth'])->group(function() {
    Route::resource('tasks', TaskController::class);

    // optionally: theme route if you want to set cookie server-side
    Route::post('/theme', function(\Illuminate\Http\Request $request) {
    $theme = $request->input('theme','light');
    return back()->cookie('theme', $theme, 60*24*365); // 1 year
    })->name('theme.set');
});


require __DIR__.'/auth.php'; // Breeze
