<?php

namespace GrassFeria\StarterkidWiki\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WikiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \GrassFeria\StarterkidWiki\Models\Wiki::create([
            'id'                                        => 1,
            
        ]);
    }
}