<?php
        namespace App\Livewire\Component\ModuleContents\ApprovalModule;
        use Livewire\Component;
        use App\Helpers\CommonHelpers;
        
        class ApprovalModuleContent extends Component{
            public function index(){
                return view("modules.approval-module.approval-module");
            }

            public function render(){
                return view("livewire.component.module-contents.approval-module.approval-module-content");
            }
        } ?>