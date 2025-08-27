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

        {{-- Add Task Form (AJAX) --}}
        <form id="taskForm" class="mb-6">
            @csrf
            <input type="text" name="title" placeholder="Task title"
                class="w-full p-2 border rounded mb-2" required>
            <textarea name="description" placeholder="Description (optional)"
                class="w-full p-2 border rounded mb-2"></textarea>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                + Add Task
            </button>
        </form>

        {{-- Task List --}}
        <div id="taskList">
            @forelse($tasks as $task)
                <div class="p-4 mb-2 bg-white shadow rounded flex justify-between items-start" data-id="{{ $task->id }}">
                    <div>
                        <h2 class="font-semibold task-title">{{ $task->title }}</h2>
                        <p class="task-desc">{{ $task->description }}</p>
                        <p class="text-sm text-gray-600">Status: <span class="task-status">{{ $task->status }}</span></p>
                    </div>
                    <div class="flex gap-2">
                        <button class="text-green-600 btn-complete" data-id="{{ $task->id }}">Complete</button>
                        <button class="text-red-600 btn-delete" data-id="{{ $task->id }}">Delete</button>
                    </div>
                </div>
            @empty
                <p>No tasks yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Scripts --}}
    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(function () {
        // Add Task
        $('#taskForm').submit(function(e){
            e.preventDefault();
            $.post("{{ route('tasks.store') }}", $(this).serialize(), function(res){
                if(res.success){
                    $('#taskList').prepend(`
                        <div class="p-4 mb-2 bg-white shadow rounded flex justify-between items-start" data-id="${res.task.id}">
                            <div>
                                <h2 class="font-semibold task-title">${res.task.title}</h2>
                                <p class="task-desc">${res.task.description ?? ''}</p>
                                <p class="text-sm text-gray-600">Status: <span class="task-status">${res.task.status}</span></p>
                            </div>
                            <div class="flex gap-2">
                                <button class="text-green-600 btn-complete" data-id="${res.task.id}">Complete</button>
                                <button class="text-red-600 btn-delete" data-id="${res.task.id}">Delete</button>
                            </div>
                        </div>
                    `);
                    $('#taskForm')[0].reset();
                }
            }).fail(err => alert(err.responseJSON.message));
        });

        // Delete Task
        $(document).on('click', '.btn-delete', function(){
            let id = $(this).data('id');
            $.ajax({
                url: `/tasks/${id}`,
                type: "DELETE",
                data: {_token: "{{ csrf_token() }}"},
                success: function(res){
                    if(res.success) $(`[data-id="${id}"]`).remove();
                }
            });
        });

        // Mark Complete
        $(document).on('click', '.btn-complete', function(){
            let id = $(this).data('id');
            $.ajax({
                url: `/tasks/${id}`,
                type: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    title: $(`[data-id="${id}"] .task-title`).text(),
                    description: $(`[data-id="${id}"] .task-desc`).text(),
                    status: "Completed"
                },
                success: function(res){
                    if(res.success){
                        $(`[data-id="${id}"] .task-status`).text("Completed");
                        $(`[data-id="${id}"] .task-title`).css("text-decoration", "line-through");
                    }
                }
            });
        });
    });
    </script>
    @endsection
</x-app-layout>
