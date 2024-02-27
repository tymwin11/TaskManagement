<?php

namespace App\LivewireTables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Kdion4891\LaravelLivewireTables\TableComponent;
use DB;

class LivewireTables extends TableComponent
{

    // Extended to include searchUsing
    public function models()
    {
        $models = $this->query();

        if ($this->search) {
            $models->where(function (Builder $query) {
                foreach ($this->columns() as $column) {
                    if ($column->searchable) {
                        if (Str::contains($column->attribute, '.')) {
                            $relationship = $this->relationship($column->attribute);

                            $query->orWhereHas($relationship->name, function (Builder $query) use ($relationship) {
                                $query->where($relationship->attribute, 'like', '%'.$this->search.'%');
                            });
                        } else {
                            if (Str::endsWith($column->attribute, '_count')) {
                                // No clean way of using having() with pagination aggregation, do not search counts for now.
                                // If you read this and have a good solution, feel free to submit a PR :P
                            } else {
                                if ($column->searchUsing) {
                                    // An array of columns to search through. Created for derived views that are a combination of fields
                                    // For example, a Name which is first_name + last_name
                                    foreach ($column->searchUsing as $item) {

                                        if (Str::contains($item, '.')) {
                                            $relationship = $this->relationship($item);

                                            $query->orWhereHas($relationship->name, function (Builder $query) use (
                                                $relationship
                                            ) {
                                                $query->where($relationship->attribute, 'like', '%'.$this->search.'%');
                                            });
                                        } else {
                                            $query->orWhere($item, 'like', '%'.$this->search.'%');
                                        }
                                    }
                                } else if($column->searchRaw){
                                    $query->orWhere(DB::raw($column->searchRaw), 'like', '%'.$this->search.'%');
                                } else {
                                    $query->orWhere($query->getModel()->getTable().'.'.$column->attribute, 'like', '%'.$this->search.'%');
                                }
                            }
                        }
                    }
                }
            });
        }

        if (Str::contains($this->sort_attribute, '.')) {
            $relationship   = $this->relationship($this->sort_attribute);
            $sort_attribute = $this->attribute($models, $relationship->name, $relationship->attribute);
        } else {
            $sort_attribute = $this->sort_attribute;
        }

        if (($column = $this->getColumnByAttribute($this->sort_attribute)) !== null && is_callable($column->sortCallback)) {
            return app()->call($column->sortCallback, ['models'         => $models,
                                                       'sort_attribute' => $sort_attribute,
                                                       'sort_direction' => $this->sort_direction,
            ]);
        }
        $column = $this->getColumnByAttribute($this->sort_attribute);
        
        if($column != null){
            if($column->sortMultiple != null){
                foreach($column->sortMultiple as $item){
                    $models->orderBy($item, $this->sort_direction);
                }
                return $models;
            }
        }

        return $models->orderBy($sort_attribute, $this->sort_direction);
    }
}
