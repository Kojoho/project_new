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
                    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6 flex items-center">
                            <img class="h-40 w-32 object-cover rounded-md"
                                src="{{ asset($history->book->cover_image ?: 'images/default-book-cover.jpg') }}"
                                alt="{{ $history->book->title }}">
                            <div class="ml-6">
                                <div class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors duration-200">{{ $history->book->title }}</div>
                                <div class="text-sm text-gray-500">{{ $history->book->author }}</div>
                                <div class="text-sm text-gray-500">Borrowed: <span class="font-semibold">{{ $history->borrow_date }}</span></div>
                                <div class="text-sm text-gray-500">Returned: <span class="font-semibold">{{ $history->return_date }}</span></div>
                                <div class="mt-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($history->is_returned)
                                            bg-green-100 text-green-800
                                        @else
                                            bg-red-100 text-red-800
                                        @endif">
                                        {{ $history->status}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .bg-white {
            transition: background-color 0.3s ease; /* เปลี่ยนสีพื้นหลัง */
        }
        .bg-white:hover {
            background-color: #f9fafb; /* สีพื้นหลังเมื่อเลื่อนเมาส์ */
        }
        img {
            border-radius: 0.375rem; /* ทำให้มุมของภาพมน */
        }
        .rounded-full {
            transition: background-color 0.3s ease, color 0.3s ease; /* เอฟเฟกต์เมื่อเปลี่ยนสถานะ */
        }
    </style>
</x-app-layout>
