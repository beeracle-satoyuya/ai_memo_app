<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

state([
    'memos' => fn() => auth()->user()->memos()->latest()->get(),
]);

?>

<div>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">メモ一覧</h1>
            <button wire:click="$refresh" class="px-4 py-2 bg-gray-800 text-white rounded-md">更新</button>
        </div>
        <!-- デバッグ情報 -->
        @if (auth()->check())
            <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-800 rounded-lg">
                <p>ログインユーザー: {{ auth()->user()->email }}</p>
                <p>メモ件数: {{ $memos->count() }}</p>
            </div>
        @else
            <div class="mt-4 p-4 bg-red-100 dark:bg-red-900 rounded-lg">
                <p>未ログイン状態です</p>
            </div>
        @endif
        <div class="mt-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                @foreach ($memos as $memo)
                    <a href="{{ route('memos.show', $memo) }}"
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{ $memo->title }}
                            </h2>
                            <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($memo->created_at)->format('Y/m/d H:i') }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
