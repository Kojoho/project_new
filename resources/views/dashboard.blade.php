<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('รายการหนังสือ') }}
        </h2>
    </x-slot>

    <style>
        /* สไตล์ CSS สำหรับธีม Kaiju Number 8 */
        .book-card {
            background-color: #1a202c;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-cover {
            height: auto;
            width: 100%;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .book-info {
            padding: 1rem;
            color: #cbd5e0;
            text-align: center;
        }

        .book-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .book-author {
            font-size: 0.875rem;
            color: #a0aec0;
        }

        .hover-bg {
            background-color: rgba(255, 255, 255, 0.05);
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($books as $book)
                    <a href="{{ route('book.show', $book->id) }}" class="block overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center transition duration-300 book-card">
                        <img src="{{ asset($book->cover_image) }}" alt="Book Cover" class="book-cover">
                        <div class="book-info">
                            <div class="book-title">{{ $book->title }}</div>
                            <div class="book-author">ผู้แต่ง: {{ $book->author }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
