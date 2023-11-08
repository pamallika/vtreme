<?php

namespace Database\Seeders;

use App\Models\Group;
use Database\Factories\GroupFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $count): void
    {
        for ($i = 1; $i <= $count; $i++) {
            Group::factory()->create([
                'name' => 'Группа' . $i,
                'expire_hours' => $i
            ]);
        }
    }
}
