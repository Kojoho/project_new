<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrow History') }}
        </h2>
    </x-slot>

    <style>
        /* สไตล์ CSS สำหรับการแสดงผล */
        .book-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .book-cover {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .book-info {
            padding: 1rem;
        }

        .book-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .book-status {
            font-size: 0.875rem;
            color: #4a5568;
        }

        .book-date {
            font-size: 0.875rem;
            color: #4a5568;
            margin-top: 0.25rem;
        }

        .late {
            color: #e53e3e;
            font-weight: 600;
        }

        .on-time {
            color: #38a169;
            font-weight: 600;
        }

        .return-button {
            background-color: #4c51bf;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            transition: background-color 0.3s;
        }

        .return-button:hover {
            background-color: #4338ca;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($borrowHistory as $history)
                    <div class="book-card bg-white overflow-hidden shadow-lg sm:rounded-lg">
                        <img class="book-cover" src="{{ asset($history->book->cover_image ?: 'images/default-book-cover.jpg') }}"
                            alt="{{ $history->book->title }}">
                        <div class="book-info">
                            <div class="book-title">{{ $history->book->title }}</div>
                            <div class="book-status">{{ $history->return_date ? 'Returned' : 'Borrowed' }}</div>
                            <div class="book-date">
                                @if ($history->return_date)
                                    Returned: {{ $history->return_date }}
                                @else
                                    Borrowed: {{ $history->borrow_date }}
                                    <br>
                                    Due Date:
                                    {{ \Carbon\Carbon::parse($history->borrow_date)->addDays(30)->toDateString() }}
                                @endif
                            </div>
                            <div class="@if (!$history->return_date && \Carbon\Carbon::parse($history->borrow_date)->addDays(30) < now()) late @else on-time @endif">
                                @if (!$history->return_date && \Carbon\Carbon::parse($history->borrow_date)->addDays(30) < now())
                                    Late
                                @else
                                    On Time
                                @endif
                            </div>
                            <div class="mt-2">
                                @if (!$history->return_date)
                                    <form action="{{ route('borrow.return', $history->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="return-button">Return</button>
                                    </form>
                                @else
                                    <span class="text-green-500">Returned</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
