<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">My Tasks</h1>
            <form method="POST" action="{{ route('theme.toggle') }}">
                @csrf
                <button class="px-3 py-1 rounded bg-gray-700 text-white">
                    Toggle Theme ({{ $theme }})
                </button>
            </form>
        </div>

        <a href="{{ route('tasks.create') }}" class="block mb-4 text-blue-600">+ Add Task</a>

        @forelse($tasks as $task)
            <div class="p-4 mb-2 bg-white shadow rounded">
                <h2 class="font-semibold">{{ $task['title'] }}</h2>
                <p>{{ $task['description'] }}</p>
                <p>Status: {{ $task['status'] }}</p>
                <div class="flex gap-2 mt-2">
                    <a href="{{ route('tasks.edit', $task['id']) }}" class="text-green-600">Edit</a>
                    <form method="POST" action="{{ route('tasks.destroy', $task['id']) }}">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p>No tasks yet.</p>
        @endforelse
    </div>
</x-app-layout>
