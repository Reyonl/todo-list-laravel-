<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <h1 class="text-center mb-4">Todo List</h1>
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Form Add Task -->
                <form action="/tasks" method="POST" class="d-flex mb-4">
                    @csrf
                    <input
                        type="text"
                        name="title"
                        class="form-control me-2"
                        placeholder="New Task"
                        required>
                    <input
                        type="text"
                        name="notes"
                        class="form-control me-2"
                        placeholder="Add Notes (Optional)">
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
                <!-- Task List -->
                <ul class="list-group">
                    @foreach($tasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <!-- Checkbox Form -->
                            <form action="/tasks/{{ $task->id }}" method="POST" class="d-flex align-items-center me-3">
                                @csrf
                                @method('PATCH')
                                <input
                                    type="checkbox"
                                    class="form-check-input me-2"
                                    onchange="this.form.submit()"
                                    {{ $task->completed ? 'checked' : '' }}>
                            </form>
                            <!-- Task Title -->
                            <span class="{{ $task->completed ? 'text-decoration-line-through text-muted' : '' }}">
                                {{ $task->title }}
                            </span>
                            <!-- Task Notes -->
                            @if($task->notes)
                                <p class="mb-1 text-muted"><small>{{ $task->notes }}</small></p>
                            @endif
                            <!-- Delete Button -->
                            <form action="/tasks/{{ $task->id }}" method="POST" class="ms-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
