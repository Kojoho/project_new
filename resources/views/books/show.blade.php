<!-- resources/views/books/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $book->title }}
        </h2>
    </x-slot>
    <style>
        body {
            background-color: #f8f9fa; /* พื้นหลังเบาๆ */
        }
        .container {
            max-width: 1200px; /* กำหนดความกว้างสูงสุด */
        }
        button {
            background-color: #000000; /* สีพื้นหลังของปุ่ม */
            color: rgb(0, 225, 255); /* สีตัวอักษร */
            padding: 10px 20px;
            border: none;
            border-radius: 5px; /* มุมโค้งของปุ่ม */
            cursor: pointer;
            transition: background-color 0.3s ease; /* เอฟเฟกต์เมื่อมีการเลื่อนเมาส์ */    
        }
        button:hover {
            background-color: #000000; /* เปลี่ยนสีเมื่อเลื่อนเมาส์ */
        }
        .book-cover {
            border-radius: 10px; /* มุมโค้งของภาพปก */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* เงาใต้ภาพ */
        }
        .book-details {
            border-left: 2px solid #000; /* เส้นข้างซ้าย */
            padding-left: 20px; /* เว้นระยะ */
        }
    </style>
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col md:flex-row">
            <div class="md:w-full flex justify-center items-center mb-6 md:mb-0">
                <img src="{{ asset($book->cover_image) }}" alt="Book Cover" class="book-cover" style="max-width: 300px;">
            </div>
            <div class="p-6 md:w-2/3 md:pl-6 book-details">
                <h3 class="text-2xl font-bold mb-4">{{ $book->title }}</h3>
                <p class="text-gray-600 mb-2"><strong>ผู้แต่ง:</strong> {{ $book->author }}</p>
                <p class="text-gray-700 mb-4"><strong>ประเภท:</strong> {{ $book->category }}</p>
                <p class="text-gray-700 mb-4"><strong>เนื้อหาโดยสังเขป:</strong></p>
                <div class="mt-4">
                    <p class="text-gray-700">
                        @if (in_array($book->id, [1, 2, 3]))
                            @if ($book->id == 1)
                                เนื้อหาของหนังสือที่หนึ่ง...
                            @elseif ($book->id == 2)
                                เนื้อหาของหนังสือที่สอง...
                            @elseif ($book->id == 3)
                                เนื้อหาของหนังสือที่สาม...
                            @endif
                        @elseif (in_array($book->id, [4, 5, 6, 7, 8]))
                            ญี่ปุ่นหนึ่งในประเทศที่มีอันตราการปรากฏตัวของไคจูสูงที่สุดในโลกในประเทศแห่งนี้
                            ไคจูได้กลายมาเป็นส่วนหนึ่งของชีวิตผู้คนอย่างสมบูรณ์ "ฮิบิโนะ คาฟก้า"
                            เคยใฝ่ฝันจะเป็นสมาชิกกองกำลังป้องกันในอดีต
                            แต่ปัจจุบันกลับต้องมาทำงานในบริษัททำความสะอาดที่รับงานเก็บกวาดซากไคจูโดยเฉพาะ
                            อยู่มาวันหนึ่ง ร่างกายของคาฟก้าถูกเปลี่ยนสภาพเป็นไคจู ด้วยฝีมือของสิ่งมีชีวิตปริศนา
                            ทำให้เขากลายเป็นอสุรกายที่ได้รับโค้ดเนม "ไคจูหมายเลข 8"
                            จากกองกำลังปราบไคจูของญี่ปุ่นไปในที่สุด
                        @else
                            {{ $book->additional_content }}
                        @endif
                    </p>
                </div>
                <!-- ฟอร์มสำหรับเวลายืมและเวลาคืน -->
                <form action="{{ route('borrow') }}" method="POST" class="mt-6">
                    @csrf
                    <div class="mb-4">
                        <label for="borrow_date" class="block text-gray-700 font-bold mb-2">วันที่ยืม:</label>
                        <input type="date" id="borrow_date" name="borrow_date"
                            class="border border-gray-300 p-2 w-full rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="return_date" class="block text-gray-700 font-bold mb-2">วันที่คืน:</label>
                        <input type="date" id="return_date" name="return_date"
                            class="border border-gray-300 p-2 w-full rounded-md">
                    </div>
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button type="submit" class="font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        ยืนยันการยืม
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
