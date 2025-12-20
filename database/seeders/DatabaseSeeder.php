<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    \App\Models\User::factory(10)->create();

    // Ensure test user exists (avoid duplicate on re-seed)
    \App\Models\User::firstOrCreate(
      ['email' => 'test@example.com'],
      ['name' => 'Test User', 'password' => bcrypt('password')]
    );

    // Catégories réelles
    $categories = ['Plomberie','Électricité','Nettoyage','Jardinage','Informatique','Design','Marketing','Rénovation'];
    foreach ($categories as $name) {
      \App\Models\Category::firstOrCreate(['name' => $name], ['status' => 1]);
    }

    // Types de services réels
    $types = ['Freelance','Agence','Entreprise','Indépendant','Consultant'];
    foreach ($types as $name) {
      \App\Models\ServiceType::firstOrCreate(['name' => $name], ['status' => 1]);
    }

    // Créer des services test liés aux catégories/types et utilisateurs créés
    $categoryIds = \App\Models\Category::pluck('id')->toArray();
    $typeIds = \App\Models\ServiceType::pluck('id')->toArray();
    $userIds = \App\Models\User::pluck('id')->toArray();

    for ($i = 0; $i < 20; $i++) {
      \App\Models\Service::factory()->create([
        'category_id' => $categoryIds[array_rand($categoryIds)],
        'service_type_id' => $typeIds[array_rand($typeIds)],
        'user_id' => $userIds[array_rand($userIds)],
      ]);
    }
  }
}
