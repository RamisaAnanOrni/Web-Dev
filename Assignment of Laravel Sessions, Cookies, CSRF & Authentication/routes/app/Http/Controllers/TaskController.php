<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = $request->session()->get('tasks', []);
        $theme = $request->cookie('theme', 'light');

        return view('tasks.index', compact('tasks', 'theme'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'description' => 'nullable|max:255',
        ]);

        $tasks = $request->session()->get('tasks', []);
        $id = count($tasks) + 1;

        $tasks[$id] = [
            'id' => $id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'status' => 'pending',
        ];

        $request->session()->put('tasks', $tasks);

        return redirect()->route('tasks.index');
    }

    public function edit(Request $request, $id)
    {
        $tasks = $request->session()->get('tasks', []);
        if (!isset($tasks[$id])) abort(404);

        return view('tasks.edit', ['task' => $tasks[$id]]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'description' => 'nullable|max:255',
            'status' => 'required|in:pending,done',
        ]);

        $tasks = $request->session()->get('tasks', []);
        if (!isset($tasks[$id])) abort(404);

        $tasks[$id] = [
            'id' => $id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'status' => $validated['status'],
        ];

        $request->session()->put('tasks', $tasks);

        return redirect()->route('tasks.index');
    }

    public function destroy(Request $request, $id)
    {
        $tasks = $request->session()->get('tasks', []);
        unset($tasks[$id]);
        $request->session()->put('tasks', $tasks);

        return redirect()->route('tasks.index');
    }
}
