<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pagetype extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pagetypes')->insert
        (

[
    [
        'name'=>'electronics'
    ],
    [
        'name'=>'clothes'
    ],
    [
        'name'=>'mobiles'
    ],
    [
        'name'=>'laptops'
    ],
    [
        'name'=>'food'
    ],
    [
        'name'=>'arts'
    ],
    [
        'name'=>'sports'
    ],
    [
        'name'=>'Literature'
    ],
    [
        'name'=>'general'
    ],
    [
        'name'=>'supports'
    ],

]
);
    }
    }
