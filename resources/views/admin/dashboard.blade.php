<x-app-layout>
    <div class="container" id="welcome-screen">
        <div class="card">
            <h1>Welcome to the Admin Dashboard</h1>
            <p>Manage your site with ease and efficiency from here.</p>
        </div>
    </div>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #333;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #666;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                document.getElementById("welcome-screen").style.display = "none";
                window.location.href = "{{ route('admin.user.logs') }}"; // เปลี่ยน URL ไปยังหน้า log ของแอดมินที่คุณต้องการ
            }, 5000); // 5000 มิลลิวินาที = 5 วินาที
        });
    </script>
</x-app-layout>
