<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
                'name' => 'Teknologi',
            ],
            [
                'name' => 'PNS',
            ],
            [
                'name' => 'swasta',
            ]
        ];

        foreach ($kategori as $key => $value) {
            Kategori::create($value);
        }
    }
}
