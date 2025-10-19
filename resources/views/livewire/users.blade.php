<div class="container mt-5">
   <h1 class="mb-3">Users List</h1>  

  @if(session()->has('message'))
     <div class="alert alert-sucess">{{session('message')}}</div>
  @endif

 <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store'}}">
   
    <input type="text" wire:model="name" placeholder='Name' class="form-control mb-2">
    @error('name')<span class="text-danger">{{$message}}</span>@enderror


     <input type="email" wire:model="email" placeholder='Email' class="form-control mb-2">
    @error('email')<span class="text-danger">{{$message}}</span>@enderror

    @if(!$updateMode)
     <input type="password" wire:model="password" placeholder='Password' class="form-control mb-2">
    @error('password')<span class="text-danger">{{$message}}</span>@enderror
 
    @endif

    <button type="submit" class="btn btn-primary">
       {{ $updateMode ? 'Update' : 'Add User'}}
    </button>
 
 </form>

    <hr>

   <table class="table table-bordered mt-3">
     <thead>
       <tr>
         <th>Id</th>
          <th>Name</th>
           <th>Email</th>
            <th>Actions</th>
       </tr>
     </thead>
     <tbody>
         @foreach( $users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>
                  <button wire:click="edit({{$user->id}})" class="btn btn-sm btn-warning">Edit</button>
                  <button wire:click="delete({{$user->id}})" class="btn btn-sm btn-danger">Delete</button>

              </td>   
            </tr>
       
         @endforeach
     </tbody>
   </table>

</div>
