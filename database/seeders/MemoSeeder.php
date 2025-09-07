<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Database\Seeder;

class MemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 既存のユーザーを取得
        $users = User::all();

        // ユーザーごとにメモを作成
        $users->each(function ($user) {
            Memo::factory()
                ->count(5) // 各ユーザーに5つのメモを作成
                ->for($user)
                ->create();
        });
    }
}
