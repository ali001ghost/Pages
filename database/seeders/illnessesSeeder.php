<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class illnessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('illnesses')->insert
        (

[
    [
        'name'=>'الاكتئاب'
    ],
    [
        'name'=>'اضطراب ما بعد الصدمة'
    ],
    [
        'name'=>'اضطراب الحزن المعقد'
    ],
    [
        'name'=>'اضطراب القلق (فوبيا ما بعد الكارثة)'
    ],
    [
        'name'=>'اضطراب عدم القدرة على التكيف'
    ],
    ]);
    }
}
