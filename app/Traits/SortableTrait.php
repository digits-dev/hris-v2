<?php

namespace App\Traits;

use Livewire\Attributes\Url;

trait SortableTrait
{
    #[Url(history: true, as: 'sort')]
    public $sortBy = "created_at";

    #[Url(history: true, as: 'dir')]
    public $sortDir = 'DESC';

    #[Url(history: true)]
    public $search = null;

    #[Url(as: 'per-page')]
    public $perPage = 10;


    public function setSortByField($value)
    {
        $this->sortBy = $value;
    }


    public function setSortBy($fieldName)
    {
        if ($this->sortBy === $fieldName) {
            $this->sortDir = ($this->sortDir == "ASC") ? "DESC" : "ASC";
            return;
        }

        $this->sortBy  = $fieldName;
        $this->sortDir = "DESC";
    }
}
