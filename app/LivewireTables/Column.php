<?php

namespace App\LivewireTables;

class Column extends \Kdion4891\LaravelLivewireTables\Column
{
    protected $searchUsing;
    protected $searchRaw;
    protected $sortMultiple;

    // Extended to include array of columns to search through for comparisons
    // Useful for derived views that are a combination of fields, such as address or full name
    public function searchUsing($array)
    {
        $this->searchUsing = $array;

        return $this;
    }
    
    public function searchRaw($string)
    {
        $this->searchRaw = $string;

        return $this;
    }
    
    public function sortMultiple($array)
    {
        $this->sortMultiple = $array;
        
        return $this;
    }
}
