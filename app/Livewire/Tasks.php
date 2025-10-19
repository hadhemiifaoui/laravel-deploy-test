<?php

namespace App\Livewire;

use Livewire\Component;
use App\Repositories\TaskRepositoryInterface;

class Tasks extends Component
{
    public $title;
    public $tasks;
    protected TaskRepositoryInterface $tasksRepo;

    public function __construct()
    {
        $this->tasksRepo = app(TaskRepositoryInterface::class);
    }

    public function mount()
    {
        $this->tasks = collect($this->tasksRepo->getAllTasks());
    }

    public function addTask()
    {
        $this->validate([
            'title' => 'required|min:3'
        ]);

        $task = $this->tasksRepo->createTask(['title' => $this->title]);
        $this->tasks->prepend($task); // works now because it’s a Collection
        $this->title = '';
    }

    public function deleteTask($id)
    {
        $this->tasksRepo->deleteTask($id);
        $this->tasks = $this->tasks->reject(fn($task) => $task->id == $id);
    }

    public function render()
    {
        return view('livewire.tasks');
    }
}
