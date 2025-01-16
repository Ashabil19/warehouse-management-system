<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Unauthorized</title>
</head>
<body style="height: 100vh; margin: 0; background-color: #292929; display: flex; justify-content: center; align-items: center;">
    <div style="background-color: #ffffff; border-radius: 10px; padding: 20px 40px; text-align: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h1 style="font-size: 2.5rem; font-weight: bold; color: #333333; margin-bottom: 10px;">403 | UNAUTHORIZED</h1>
        <p style="font-size: 1.2rem; color: #555555; margin-bottom: 20px;">Anda tidak memiliki akses untuk halaman ini.</p>
        <button onclick="goBack()" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; transition: background-color 0.3s;">
            Kembali
        </button>
    </div>

    <script>
        function goBack() {
            window.history.back(); // Mengarahkan pengguna ke halaman sebelumnya
        }
    </script>
</body>
</html>
