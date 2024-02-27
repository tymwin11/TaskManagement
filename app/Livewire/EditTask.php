<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class EditTask extends Component
{
    public $pageTitle = 'Edit Task';
    public $task;
    public $title;
    public $priority;
    
    protected $rules = [
        'title'    => 'required|min:4',
        'priority' => 'required',
    ];
    
    public function submit()
    {
        $this->validate();
        
        //create task
        $this->task->title    = $this->title;
        $this->task->priority = $this->priority;
        $this->task->save();
        
        return redirect()->to('/');
    }
    
    public function cancel()
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
