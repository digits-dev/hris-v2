<?php

namespace App\Livewire\Component\Navigation;
use App\Helpers\CommonHelpers as CM;
use Livewire\Component;

class Sidebar extends Component
{

    public $menus;

    public function mount(){
        
        $this->menus = CM::sidebarMenu();
        
    }
    
    public function render()
    {
        $sidebar = CM::sidebarMenu();
        return view('livewire.component.navigation.sidebar', compact('sidebar'));
    }
}
