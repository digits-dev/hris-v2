<?php

namespace App\Livewire\Component\ModuleContents\EmployeeAccounts;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Helpers\CommonHelpers;

class EmployeeAccountsContent extends Component
{
    use WithPagination;

    #[Url(history:true, as:'sort')]
    public $sortBy = "created_at";

    #[Url(history:true, as:'dir')]
    public $sortDir = 'DESC';

    #[Url(history:true)]
    public $search = ''; 

    #[Url(as:'per-page')]
    public $perPage = 5;

    public $userIds = [];

    public $selectedAll = false;

    public $isModalOpen = false;

    public $setTo = '';

    public $statusFnc = '';

    
    public function index(){
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(CommonHelpers::adminPath(), trans("ad_default.denied_access"));
        }
        return view('modules.employee-accounts.employee-accounts-module', ['routeName' => 'index']);
    }

  
    public function setToActive(){

        User::whereIn('id', $this->userIds)->update(['status' => 1]);
        $this->isModalOpen = false;
        $this->selectedAll = false;
        $this->userIds = [];

        // dd($this->userIds);
        
    }
    public function setToInactive(){
        User::whereIn('id', $this->userIds)->update(['status' => 0]);
        $this->isModalOpen = false;
        $this->selectedAll = false;
        $this->userIds = [];

        // dd($this->userIds);

    }


    public function openModal($status)
    {
        if($status == 'active'){
            $this->setTo = 'active';
            $this->statusFnc = 'setToActive';
        } else {
            $this->setTo = 'inactive';    
            $this->statusFnc = 'setToInactive';

        }

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    
    public function setSortBy($fieldName){
        if($this->sortBy === $fieldName) {
            $this->sortDir = ($this->sortDir == "ASC") ? "DESC" : "ASC";
            return;
        }

        $this->sortBy = $fieldName;
        $this->sortDir = "DESC";
    }

    public function updatedSelectedAll()
    {
        if ($this->selectedAll) {
            $this->userIds = User::search($this->search)
                ->orderBy($this->sortBy, $this->sortDir)
                ->pluck('id')
                ->take($this->perPage)
                ->toArray(); // Select all user IDs
        } else {
            $this->userIds = []; // Deselect all user IDs
        }
    }

    public function updatedPage()
    {
        // Reset $selectedAll when navigating to a new page
        $this->selectedAll = false;
        $this->userIds = [];
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function resetUserIds($users)
    {
        $this->userIds = [];
    }

  
    public function render()
    {

     $users = User::search($this->search)->orderBy($this->sortBy, $this->sortDir)->paginate($this->perPage);
   
        if ($this->selectedAll) {
            $this->userIds = $users->pluck('id')->toArray();
     
        }

        return view('livewire.component.module-contents.employee-accounts.employee-accounts-content', ['users' => $users]);
    }

}
