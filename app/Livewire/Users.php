<?php

namespace App\Livewire;

use Livewire\Component;
use App\Repositories\UserRepositoryInterface;

class Users extends Component
{

    protected UserRepositoryInterface $usersRepo;
    public $users;
    public $name,$email, $password;
    public $user_id;
    public $updateMode = false;

    public function __construct(){
      $this->usersRepo = app(UserRepositoryInterface::class) ;
    }
  
    public function render()
    {
        $this->users = $this->usersRepo->getAllUsers();
        return view('livewire.users');
    }

    public function resetInputFields(){
       $this->name='' ;  
       $this->email='' ;      
       $this->password='' ;  
    }


    public function store(){
      
        $this->validate([
           'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'    
        ]);

        $this->usersRepo->createUser([
          'name'=> $this->name,
          'email' => $this->email,
          'password'=>$this->password
        ]);


        session()->flash('message', 'User Created Successfully');
        $this->resetInputFields();

    }


    public function edit($id){
       $user = $this->usersRepo->getUserById($id);
       $this->user_id = $id;
       $this->name = $user->name;
       $this->email = $user->email;
       $this->updateMode = true;
    }

    public function update(){
        $this->validate([
          'name'=>'required|min:3',
          'email'=>'required|email'
        ]);
        
        $this->usersRepo->updateUser($this->user_id, [
           'name'=> $this->name,
          'email'=> $this->email 
        ]);

        $this->updateMode = false;

        session()->flash('message','User Updated Successfully');
        $this->resetInputFields();

    } 


    public function delete($id){
        $this->usersRepo->deleteUser($id);
        session()->flash('message', 'User Removed');
    }
}
