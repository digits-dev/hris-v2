<?php

namespace App\Livewire\Component\Reusable;

use Livewire\Component;

class DonutChartComponent extends Component
{
    public $data = [1,2,3,4,5];
    public function render()
    {
        return view('livewire.component.reusable.donut-chart-component');
    }
}
