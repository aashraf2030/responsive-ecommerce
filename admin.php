
<!DOCTYPE html>
<html lang="ar" dir=rtl>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/YOUR_KIT_ID.js" crossorigin="anonymous"></script>
    <style>
        * {
            font-family: "Cairo", sans-serif;
            transition: 0.3s;
        }
        .sidebar {
            width: 250px;
            background: #2d3748;
            color: white;
            height: 100vh;
            position: fixed;
            padding: 20px;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="sidebar">
        <h2 class="text-xl font-bold mb-4">لوحة التحكم</h2>
        <ul>
            <li class="mb-2"><a href="?page=add_category" class="hover:text-yellow-500">إضافة تصنيف</a></li>
            <li class="mb-2"><a href="?page=view_categories" class="hover:text-yellow-500">عرض التصنيفات</a></li>
            <li class="mb-2"><a href="?page=product_count" class="hover:text-yellow-500">إحصائيات المنتجات</a></li>
            <li class="mb-2"><a href="?page=add_product" class="hover:text-yellow-500">إضافة منتج</a></li>
            <li class="mb-2"><a href="?page=view_products" class="hover:text-yellow-500">عرض المنتجات</a></li>
        </ul>
    </div>

<<<<<<< HEAD
    <div class="content container">
        <?php
        include "/xampp/htdocs/pop/API/conn.php";
=======
    <div class="content">
        <?php
>>>>>>> 13a924945ddf46b3b0ab44e558885fd63e51ccc5
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'add_category':
                    include 'pages/add_category.php';
                    break;
                case 'view_categories':
                    include 'pages/view_categories.php';
                    break;
                case 'product_count':
                    include 'pages/product_count.php';
                    break;
                case 'add_product':
                    include 'pages/add_product.php';
                    break;
                case 'view_products':
                    include 'pages/view_products.php';
                    break;
                default:
                    echo '<h2 class="text-xl font-bold">مرحبًا بك في لوحة التحكم</h2>';
            }
        } else {
            echo '<h2 class="text-xl font-bold">مرحبًا بك في لوحة التحكم</h2>';
        }
        ?>
    </div>
</body>
</html>