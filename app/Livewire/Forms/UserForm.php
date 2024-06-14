<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

class UserForm extends Form
{
    public ?User $user;

    #[Validate('required')]
    public $first_name;

    #[Validate('required')]
    public $middle_name;

    #[Validate('required')]
    public $last_name;

    #[Validate('nullable|image', as: 'profile picture')]
    public $profileImage;

    public $image;

    #[Validate('required')]
    public $employee_id;

    #[Validate('required', as: 'location')]
    public $hire_location_id;

    #[Validate('required|email')]
    public $email;

    #[Validate('required', as: 'company')]
    public $company_id;

    #[Validate('required', as: 'department')]
    public $department_id;

    #[Validate('required')]
    public $position;

    #[Validate('required', as: 'system privilege')]
    public $id_ad_privileges;

    #[Validate('required|date')]
    public $hire_date;

    public $status;

    public function setForm(User $user)
    {
        $this->user = $user;

        $this->first_name       = $user->first_name;
        $this->last_name        = $user->last_name;
        $this->employee_id      = $user->employee_id;
        $this->hire_location_id = $user->hire_location_id;
        $this->email            = $user->email;
        $this->company_id       = $user->company_id;
        $this->department_id    = $user->department_id;
        $this->position         = $user->position;
        $this->id_ad_privileges = $user->id_ad_privileges;
        $this->hire_date        = date('Y-m-d', strtotime($user->hire_date));
        $this->status           = $user->status;
        $this->image            = $user->image;

        if($user->middle_name == ''){
            $this->middle_name = 'N/A';
        } else {
            $this->middle_name = $user->middle_name;
        }
     
    }

    public function store()
    {

        $this->validate();

        $userData = $this->except([ 'user', 'profileImage', 'status', 'middle_name' ]);

        if(trim(strtolower($this->middle_name)) == 'n/a'){
            $userData['middle_name'] = '';
        } else {
            $userData['middle_name'] = $this->middle_name;
        }

        if ($this->profileImage) {
            $photo             = $this->profileImage->store('photos', 'public');
            $userData['image'] = $photo;
        }

        $userData['password'] = 'qwerty';

        User::create($userData);
    }



    public function update()
    {

        $this->validate();

        $userData = $this->except([ 'user', 'image', 'profileImage', 'password' ]);

        if ($this->profileImage) {

            if ($this->user->image) {
                Storage::delete($this->user->image);
            }

            $userData['image'] = $this->profileImage->store('photos', 'public');
        }

        $this->user->update($userData);

    }

}
