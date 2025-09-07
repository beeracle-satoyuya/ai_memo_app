<?php

namespace Database\Seeders;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // サンプルユーザーを作成
        $user = User::factory()->create();

        // サンプルメモを作成
        Memo::create([
            'user_id' => $user->id,
            'title' => 'PHP',
            'content' => 'PHPは、Hypertext Preprocessorの略です。',
        ]);

        Memo::create([
            'user_id' => $user->id,
            'title' => 'HTML',
            'content' => 'HTMLは、Hypertext Markup Languageの略です。',
        ]);

        Memo::create([
            'user_id' => $user->id,
            'title' => 'CSS',
            'content' => "CSSは、\nCascading Style Sheets\nの略です。",
        ]);

        Memo::create([
            'user_id' => $user->id,
            'title' => '混在',
            'content' => "Test123 てすとアイウエオｱｲｳｴｵ\n漢字！ＡＢＣ ａｂｃ １２３   😊✨",
        ]);

        // ランダムなメモを追加で作成
        Memo::factory()->count(10)->create();
    }
}
