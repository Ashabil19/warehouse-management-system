<!-- resources/views/errors/403.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Unauthorized</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"> <!-- Sesuaikan dengan file CSS kamu -->
</head>
<body class="flex flex-col items-center justify-center h-screen bg-gray-100">
    <h1 class="text-4xl font-bold">403 | UNAUTHORIZED</h1>
    <p class="mt-4">Anda tidak memiliki akses untuk halaman ini.</p>
    <button onclick="goBack()" class="mt-6 px-4 py-2 bg-blue-500 text-white rounded">
        Kembali
    </button>

    <script>    
        function goBack() {
            window.history.back(); // Mengarahkan pengguna ke halaman sebelumnya
        }
    </script>
</body>
</html>
