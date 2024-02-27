<?php

namespace App\Livewire;

use App\Models\Task;
use App\LivewireTables\Column;
use App\LivewireTables\LivewireTables;

class TaskTable extends LivewireTables
{
    protected $paginationTheme = 'bootstrap';
    public    $checkbox        = false;
    
    //delete task
    public function delete(Task $task)
    {
        $task->delete();
        
        $this->query();
    }

    //retrive tasks 
    public function query()
    {
        return Task::with('user')->orderByRaw('FIELD(priority, "High", "Medium", "Low") ASC');
    }

    //build table
    public function columns()
    {
        return [
            Column::make('Title')->searchable()->sortable(),
            Column::make('Priority')->searchable()->sortable(),
            Column::make('Created By', 'user.name')->searchable()->sortable(),
            Column::make('Created At')->searchable()->sortable(),
            Column::make('Updated At')->searchable()->sortable(),
            Column::make('Actions')->view('partials.table-views.task-table-actions')
        ];
    }
}
