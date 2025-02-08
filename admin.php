<?php
session_start();
include "API/conn.php";

// if (!isset($_SESSION["user_id"])) {
//     header("Location: login.php");
//     exit();
// }

// if (isset($_GET["logout"])) {
//     session_destroy();
//     header("Location: login.php");
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_product"])) {
    $pname = $_POST["pname"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $imageName = "";

    if (!empty($_FILES["product_image"]["name"])) {
        $image = $_FILES["product_image"];
        $imageName = time() . "_" . basename($image["name"]);
        $targetDir = "assets/imgs/";
        $targetFile = $targetDir . $imageName;

        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
            } else {
                $imageName = "";
            }
        } else {
            $imageName = "";
        }
    }

    $stmt = $conn->prepare("INSERT INTO product (pname, price, creation_date, description, image) VALUES (?, ?, NOW(), '', ?)");
    $stmt->execute([$pname, $price, $imageName]);

    $product_id = $conn->lastInsertId();
    $stmt = $conn->prepare("INSERT INTO product_has_category (product_idproduct, category_category_id) VALUES (?, ?)");
    $stmt->execute([$product_id, $category]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_category"])) {
    $category_name = $_POST["category_name"];
    $stmt = $conn->prepare("INSERT INTO category (name) VALUES (?)");
    $stmt->execute([$category_name]);
}

$products = $conn->query("SELECT product.*, category.name AS category FROM product LEFT JOIN product_has_category ON product.idproduct = product_has_category.product_idproduct LEFT JOIN category ON product_has_category.category_category_id = category.category_id")->fetchAll();
$categories = $conn->query("SELECT * FROM category")->fetchAll();
$users = $conn->query("SELECT * FROM user")->fetchAll();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap">
    <style>
        * { font-family: "Cairo"; transition: 0.5s; }
    </style>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center text-gray-800">لوحة التحكم</h1>
        
        <div class="flex justify-between mt-4">
            <a href="?logout" class="bg-red-500 text-white px-4 py-2 rounded-lg">تسجيل الخروج</a>
        </div>

        <h2 class="text-xl font-bold mt-6">إدارة المنتجات</h2>
        <form method="POST" enctype="multipart/form-data" class="mt-4 flex flex-col space-y-2">
            <input type="text" name="pname" placeholder="اسم المنتج" class="border px-4 py-2 rounded-lg w-full" required>
            <input type="number" name="price" placeholder="السعر" class="border px-4 py-2 rounded-lg w-full" required>
            <select name="category" class="border px-4 py-2 rounded-lg w-full" required>
                <?php foreach ($categories as $cat) { echo "<option value='{$cat['category_id']}'>{$cat['name']}</option>"; } ?>
            </select>
            <input type="file" name="product_image" class="border px-4 py-2 rounded-lg w-full">
            <button type="submit" name="add_product" class="bg-blue-500 text-white px-4 py-2 rounded-lg">إضافة</button>
        </form>

        <table class="w-full mt-4 bg-gray-50 border">
            <tr class="bg-gray-200">
                <th class="p-2">الصورة</th>
                <th class="p-2">اسم المنتج</th>
                <th class="p-2">السعر</th>
                <th class="p-2">التصنيف</th>
            </tr>
            <?php foreach ($products as $prod) { ?>
                <tr class="border">
                    <td class="p-2">
                        <?php if ($prod['image']) { ?>
                            <img src="assets/imgs/<?php echo $prod['image']; ?>" class="w-16 h-16 rounded">
                        <?php } else { echo "لا توجد صورة"; } ?>
                    </td>
                    <td class="p-2"><?php echo $prod['pname']; ?></td>
                    <td class="p-2"><?php echo $prod['price']; ?> جنيه</td>
                    <td class="p-2"><?php echo $prod['category']; ?></td>
                </tr>
            <?php } ?>
        </table>

        <h2 class="text-xl font-bold mt-6">إدارة الفئات</h2>
        <form method="POST" class="mt-4 flex space-x-2">
            <input type="text" name="category_name" placeholder="اسم الفئة" class="border px-4 py-2 rounded-lg w-full" required>
            <button type="submit" name="add_category" class="bg-green-500 text-white px-4 py-2 rounded-lg">إضافة</button>
        </form>

        <table class="w-full mt-4 bg-gray-50 border">
            <tr class="bg-gray-200">
                <th class="p-2">اسم الفئة</th>
            </tr>
            <?php foreach ($categories as $cat) { echo "<tr class='border'><td class='p-2'>{$cat['name']}</td></tr>"; } ?>
        </table>
    </div>

</body>
</html>
