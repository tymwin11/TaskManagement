<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CreateTask extends Component
{
    public $pageTitle = 'Create Task';
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
        $task           = new Task;
        $task->user_id  = auth()->user()->id;
        $task->title    = $this->title;
        $task->priority = $this->priority;
        $task->save();
        
        //after task is created, email the user that the task was created
        Mail::to(auth()->user()->email)->queue(new \App\Mail\TaskCreated(auth()->user(), $task));
        
        return redirect()->to('/');
    }
    
    public function cancel()
    {
        return redirect()->to('/');
    }

    public function mount()
    {
       //
    }
    
    public function render()
    {
        return view('livewire.modify-task')
                ->layout('layouts.app');
    }
}
