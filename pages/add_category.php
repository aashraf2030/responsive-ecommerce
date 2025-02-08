<?php
include '../API/config.php';
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة تصنيف</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: "Cairo", sans-serif; transition: 0.3s; }
        .container { max-width: 600px; margin: auto; padding: 20px; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container">
        <h2 class="text-xl font-bold mb-4">إضافة تصنيف جديد</h2>
        <form action="../actions/add_category.php" method="POST">
            <label class="block mb-2">اسم التصنيف</label>
            <input type="text" name="category_name" class="w-full border border-gray-300 p-2 rounded-md mb-4" required>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">إضافة</button>
        </form>
    </div>
</body>
</html>
