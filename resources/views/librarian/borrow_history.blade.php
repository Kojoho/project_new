<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ประวัติการยืมคืนของผู้ใช้') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($borrowHistories as $history)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 flex items-center">
                            <img class="h-40 w-32 object-cover"
                                src="{{ asset($history->book->cover_image ?: 'images/default-book-cover.jpg') }}"
                                alt="{{ $history->book->title }}">
                            <div class="ml-6">
                                <div class="text-xl font-bold">{{ $history->book->title }}</div>
                                <div class="text-sm text-gray-500">{{ $history->book->author }}</div>
                                <div class="text-sm text-gray-500">Borrowed: {{ $history->borrow_date }}</div>
                                <div class="text-sm text-gray-500">Returned: {{ $history->return_date }}</div>
                                <div class="mt-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($history->is_returned)
                                            bg-green-100 text-green-800
                                        @else
                                            bg-red-100 text-red-800
                                        @endif">
                                        {{ $history->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
