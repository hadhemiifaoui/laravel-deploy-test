<?php
namespace App\Repositories;



use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    
    public function getAllUsers(){
        return User::all();
    }


     public function getUserById($id){
        return User::find($id);
    }


     public function createUser(array $data){
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }


     public function updateUser($id , array $data){
        $user = User::find($id);
        if(isset($data['password'])){
            $data['password']= Hash::make($data['password']);
        }
        $user->update($data);
        return $user;
    }


     public function deleteUser($id){
       $user = User::find($id);
       return $user->delete();
    }

}