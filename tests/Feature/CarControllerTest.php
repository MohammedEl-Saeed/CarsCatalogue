<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use RefreshDatabase; // Refresh the database for each test

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_create_a_car()
    {
        $user = User::factory()->create(); // Create a user

        $response = $this->actingAs($user) // Simulate the authenticated user
            ->postJson('/api/cars', [
                'make' => 'Toyota',
                'model' => 'Corolla',
                'year' => 2020,
                'price' => 20000,
                'description' => 'A reliable car',
                'image' => null,
            ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'make', 'model', 'year', 'price', 'description']);

        $this->assertDatabaseHas('cars', [
            'make' => 'Toyota',
            'model' => 'Corolla',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_fetch_all_cars()
    {
        $user = User::factory()->create(); // Create a user
        $this->actingAs($user); // Simulate the authenticated user

        Car::factory()->count(3)->create(['user_id' => $user->id]); // Associate cars with the user

        $response = $this->getJson('/api/cars');

        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_fetch_a_single_car()
    {
        $user = User::factory()->create(); // Create a user
        $this->actingAs($user); // Simulate the authenticated user

        $car = Car::factory()->create(['user_id' => $user->id]); // Associate the car with the user

        $response = $this->getJson('/api/cars/' . $car->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $car->id]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_update_a_car()
    {
        $user = User::factory()->create(); // Create a user
        $this->actingAs($user); // Simulate the authenticated user

        $car = Car::factory()->create(['user_id' => $user->id]); // Associate the car with the user

        $response = $this->putJson('/api/cars/' . $car->id, [
            'make' => 'Honda',
            'model' => 'Civic',
            'year' => 2021,
            'price' => 22000,
            'description' => 'An updated reliable car',
            'image' => null,
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['make' => 'Honda', 'model' => 'Civic']);

        $this->assertDatabaseHas('cars', [
            'id' => $car->id,
            'make' => 'Honda',
            'model' => 'Civic',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_can_delete_a_car()
    {
        $user = User::factory()->create(); // Create a user
        $this->actingAs($user); // Simulate the authenticated user

        $car = Car::factory()->create(['user_id' => $user->id]); // Associate the car with the user

        $response = $this->deleteJson('/api/cars/' . $car->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('cars', ['id' => $car->id]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_validates_required_fields_when_creating_a_car()
    {
        $user = User::factory()->create(); // Create a user
        $this->actingAs($user); // Simulate the authenticated user

        $response = $this->postJson('/api/cars', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['make', 'model', 'year', 'price']);
    }
}
