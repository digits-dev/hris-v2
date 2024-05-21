<?php
        namespace App\Livewire\Component\ModuleContents\LivewireContent;
        use Livewire\Component;
        use App\Helpers\CommonHelpers;
        
        class LivewireContentContent extends Component{
            public function index(){}
            public function render(){
                return view("livewire.component.module-contents.employee-accounts.employee-accounts-content");
            }
        } ?>