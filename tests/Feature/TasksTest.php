<?php

// namespace Tests\Feature;

// use App\Livewire\Tasks;
// use App\Repositories\TaskRepositoryInterface;
// use Livewire\Livewire;
// use Mockery;
// use Tests\TestCase;

// class TasksTest extends TestCase
// {
//     public function tearDown(): void
//     {
//         Mockery::close();
//         parent::tearDown();
//     }

//     public function test_it_shows_tasks_without_hitting_database()
//     {
//        
//         $mockRepo = Mockery::mock(TaskRepositoryInterface::class);

//         $mockRepo->shouldReceive('getAllTasks')
//             ->once()
//             ->andReturn([
//                 (object)['id' => 1, 'title' => 'Mocked Task']
//             ]);

//         $mockRepo->shouldReceive('createTask')
//             ->once()
//             ->with(['title' => 'New Mocked Task'])
//             ->andReturn((object)['id' => 2, 'title' => 'New Mocked Task']);

//         $this->app->instance(TaskRepositoryInterface::class, $mockRepo);

//         Livewire::test(Tasks::class)
//             ->set('title', 'New Mocked Task')
//             ->call('addTask')
//             ->assertSee('Mocked Task')
//             ->assertSee('New Mocked Task');
//     }
// }
