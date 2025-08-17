<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow rounded">
        <h1 class="text-xl font-bold mb-4">Add Task</h1>
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <input type="text" name="title" placeholder="Title" class="w-full border rounded p-2 mb-3" required>
            <textarea name="description" placeholder="Description" class="w-full border rounded p-2 mb-3"></textarea>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
        </form>
    </div>
</x-app-layout>
