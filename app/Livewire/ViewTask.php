<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class ViewTask extends Component
{
    public $pageTitle = 'View Task';
    public $task;
    public $title;
    public $priority;
    
    public function back()
    {
        return redirect()->to('/');
    }

    public function mount(Task $task)
    {
       $this->task      = $task;
       $this->title     = $task->title;
       $this->priority  = $task->priority;
    }
    
    public function render()
    {
        return view('livewire.modify-task')
                ->layout('layouts.app');
    }
}
