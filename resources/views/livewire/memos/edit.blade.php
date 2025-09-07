<?php

use function Livewire\Volt\{state, rules, mount};
use App\Models\Memo;

state([
    'memo' => null,
    'title' => '',
    'content' => '',
]);

rules([
    'title' => ['required', 'max:50'],
    'content' => ['required', 'max:2000'],
]);

mount(function (Memo $memo) {
    $this->memo = $memo;
    $this->title = $memo->title;
    $this->content = $memo->content;
});

$update = function () {
    $validated = $this->validate();

    $this->memo->update([
        'title' => $validated['title'],
        'content' => $validated['content'],
    ]);

    session()->flash('status', 'メモを更新しました。');
    $this->redirect(route('memos.show', $this->memo));
};

?>

<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">メモの編集</h1>
    </div>
    <form wire:submit="update" class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">
                タイトル
            </label>
            <input type="text" wire:model="title" id="title"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="タイトルを入力してください">
            @error('title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">
                本文
            </label>
            <textarea wire:model="content" id="content" rows="6"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="本文を入力してください"></textarea>
            @error('content')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('memos.show', $memo) }}"
                class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                キャンセル
            </a>
            <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                更新
            </button>
        </div>
    </form>
</div>
