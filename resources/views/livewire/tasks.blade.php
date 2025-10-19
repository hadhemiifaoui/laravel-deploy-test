<div class="container" style="max-width:600px;margin-top:40px;">
    <h2>Task Manager</h2>

    <input type="text" wire:model="title" placeholder="New task">
    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
    <button wire:click="addTask">Add Task</button>

    <ul>
        @foreach($tasks as $task)
            <li>
                {{ $task->title }}
                <button wire:click="deleteTask({{ $task->id }})">Delete</button>
            </li>
        @endforeach
    </ul>
</div>
