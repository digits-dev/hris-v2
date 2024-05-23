<?php

namespace App\Livewire\Component\Reusable;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dropdown extends Component
{

    public $title;
    public $list;
    public $column;

    public function mount($title, $table, $column){
        $this->title = $title;
        $this->list = DB::table($table)->select('id', "$column as name")->get();
    }

    public function render()
    {
        $data = [];
        $data['db_data'] = $this->list;

        return view('livewire.component.reusable.dropdown', $data);
    }
}
