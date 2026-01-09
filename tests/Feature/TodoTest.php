<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_show_the_todo_list_page()
    {
        $response = $this->get('/todos');
        $response->assertStatus(200);
        $response->assertSee('Todos');
    }

    /** @test */
    public function it_can_create_a_todo()
    {
        $response = $this->post('/todos', [
            'title' => 'Buy milk',
        ]);

        $response->assertRedirect('/todos');
        $this->assertDatabaseHas('todos', ['title' => 'Buy milk']);
    }

    /** @test */
    public function it_can_update_a_todo()
    {
        $todo = Todo::create(['title' => 'Old title']);

        $response = $this->put("/todos/{$todo->id}", [
            'title' => 'New title',
        ]);

        $response->assertRedirect('/todos');
        $this->assertDatabaseHas('todos', ['title' => 'New title']);
    }

    /** @test */
    public function it_can_delete_a_todo()
    {
        $todo = Todo::create(['title' => 'Delete me']);

        $response = $this->delete("/todos/{$todo->id}");

        $response->assertRedirect('/todos');
        $this->assertDatabaseMissing('todos', ['title' => 'Delete me']);
    }
}
