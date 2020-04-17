<?php

use Illuminate\Database\Seeder;
use App\Todolist;

class TodolistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Todolist::truncate(); // 移除資料表所有資料列，並將自動遞增 ID 重設為零
        Todolist::unguard(); // 暫時取消批量赋值的安全保護
        factory(Todolist::class, 50)->create();
        Todolist::reguard(); // 恢復批量赋值的安全保護
    }
}
