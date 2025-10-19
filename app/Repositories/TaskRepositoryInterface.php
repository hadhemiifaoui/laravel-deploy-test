<?php

  namespace App\Repositories;
  
  interface TaskRepositoryInterface {
       public function getAllTasks();
       public function findTaskById($id);
       public function createTask(array $data);
       public function updateTask($id, array $data);
       public function deleteTask($id); 
  }

