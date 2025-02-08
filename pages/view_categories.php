<?php
include '../API/config.php';
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض التصنيفات</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: "Cairo", sans-serif; transition: 0.3s; }
        .container { max-width: 800px; margin: auto; padding: 20px; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container">
        <h2 class="text-xl font-bold mb-4">التصنيفات المتاحة</h2>
        <table class="w-full bg-white shadow-md rounded-lg">
            <tr class="bg-gray-200">
                <th class="p-2">اسم التصنيف</th>
                <th class="p-2">الإجراءات</th>
            </tr>
            <?php
            $stmt = $pdo->query("SELECT * FROM categories");
            while ($row = $stmt->fetch()) {
                echo "<tr>
                        <td class='p-2'>{$row['name']}</td>
                        <td class='p-2'>
                            <a href='../actions/edit_category.php?id={$row['id']}' class='text-blue-500'>تعديل</a> |
                            <a href='../actions/delete_category.php?id={$row['id']}' class='text-red-500'>حذف</a>
                        </td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
