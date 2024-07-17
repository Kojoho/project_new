<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('เพิ่มข้อมูลหนังสือ') }}
        </h2>
    </x-slot>

    <style>
        form {
            width: 500px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>

    <div class="py-12">
        <form id="bookForm" action="{{ route('store.book') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="title">ชื่อหนังสือ:</label>
            <input type="text" id="title" name="title" required>

            <label for="author">ผู้แต่ง:</label>
            <input type="text" id="author" name="author" required>

            <label for="category">หมวดหมู่:</label>
            <select id="category" name="category" required>
                <option value="">เลือกหมวดหมู่</option>
                <option value="การ์ตูน">การ์ตูน</option>
                <option value="นวนิยาย">นวนิยาย</option>
                <option value="สารคดี">สารคดี</option>
                <option value="วรรณกรรม">วรรณกรรม</option>
                <option value="จิตวิทยา">จิตวิทยา</option>
                <option value="แม่และเด็ก">แม่และเด็ก</option>
                <option value="บริหารธุรกิจ">บริหารธุรกิจ</option>
                <option value="อื่นๆ">อื่นๆ</option>    
            </select>

            <label for="coverImage">รูปปกหนังสือ:</label>
            <input type="file" id="coverImage" name="coverImage" accept="image/*" required>

            <button type="submit">เพิ่มข้อมูล</button>
        </form>
    </div>

    <script>
        const bookForm = document.getElementById('bookForm');

        bookForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const title = document.getElementById('title').value;
            const author = document.getElementById('author').value;
            const category = document.getElementById('category').value;
            const coverImage = document.getElementById('coverImage').files[0];

            // Client-side validation
            if (title === '' || author === '' || category === '' || !coverImage) {
                alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }

            // Prepare FormData to send file and other form data
            const formData = new FormData();
            formData.append('title', title);
            formData.append('author', author);
            formData.append('category', category);
            formData.append('coverImage', coverImage);

            // Submit the form data using Fetch API
            fetch('{{ route('store.book') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                alert('เพิ่มข้อมูลหนังสือสำเร็จ');
                bookForm.reset(); // Reset the form after successful submission
            })
            .catch(error => {
                alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');
                console.error('Error:', error);
            });
        });
    </script>
</x-app-layout>
