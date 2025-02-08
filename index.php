<?php
    include "API/conn.php";
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-white text-gray-900">
    <div id="overlay"></div>
    
    <nav class="flex items-center justify-between p-4 shadow-md bg-white fixed w-full z-50 top-0">
        <button id="menu-toggle" class="text-2xl"><i class="fas fa-bars"></i> القائمة</button>
        <img src="https://placehold.co/60x32" alt="Logo" class="h-10">
        <div class="flex space-x-4 rtl:space-x-reverse">
            <button><i class="fas fa-search"></i></button>
            <button><i class="fas fa-user"></i></button>
            <button><i class="fas fa-globe"></i></button>
            <button><i class="fas fa-shopping-cart"></i></button>
        </div>
    </nav>
    
    <aside id="sidebar" class="fixed top-0 right-0 w-64 h-full bg-white shadow-lg transform translate-x-full transition-transform z-50 p-4">
        <ul class="space-y-4">
            <li><a href="#"><i class="fas fa-percent"></i> تخفيضات</a></li>
            <li><a href="#"><i class="fas fa-paint-brush"></i> لوحات كانفس</a></li>
            <li><a href="#"><i class="fas fa-layer-group"></i> لوحات - جبسية</a></li>
            <li><a href="#"><i class="fas fa-th-large"></i> مجموعات جدارية</a></li>
            <li><a href="#"><i class="fas fa-couch"></i> طاولات جانبية</a></li>
            <li><a href="#"><i class="fas fa-gem"></i> تحف واكسسوارات ديكور</a></li>
            <li><a href="#"><i class="fas fa-clock"></i> ساعات حائط اكريليك 3D</a></li>
            <li><a href="#"><i class="fas fa-link"></i> روابط تهمك</a></li>
            <li><a href="#"><i class="fas fa-headset"></i> خدمة العملاء</a></li>
        </ul>
    </aside>
    
    <section class="w-full mt-16 overflow-hidden home-slider">
        <div class="slider-wrapper" id="slider">
            <div class="slide">
                <img src="https://placehold.co/1200x400" class="w-full h-[400px] object-cover" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="https://placehold.co/1200x400" class="w-full h-[400px] object-cover" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="https://placehold.co/1200x400" class="w-full h-[400px] object-cover" alt="Slide 3">
            </div>
        </div>
    </section>
    
    <section class="p-6">
        <h2 class="text-xl font-bold mb-4">أحدث المنتجات</h2>
        <div class="products-container">
            <div class="products-wrapper" id="productSlider">
                
                <?php
                
                    $q = "SELECT pname, price, image FROM product ORDER BY creation_date Limit 10 ";
                    $stmt = $conn->query($q);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<div class='product'>
                                <img src=images/".$row["image"]. "alt='".$row["pname"]."'>
                                <p class='mt-2'>".$row["pname"]."</p>
                                <p class='font-bold'>".$row["price"]." رس</p>
                                <div class='product-actions'>
                                    <button class='add-to-cart'><i class='fas fa-shopping-cart'></i> أضف للسلة</button>
                                    <i class='fas fa-heart wishlist'></i>
                                </div>
                            </div>";
                    }
                ?>
    </section>
    <section class="p-6">
        <h2 class="text-xl font-bold mb-4">الاكثر مبيعاً</h2>
        <div class="products-container">
            <div class="products-wrapper" id="productSlider">
            <?php
                
                $q = "SELECT pname, price, image FROM product, product_has_category WHERE idproduct in 
                (SELECT product_idproduct FROM `cart_has_product` ORDER BY COUNT(product_idproduct))
                 ORDER BY creation_date Limit 10 ";
                $stmt = $conn->query($q);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<div class='product'>
                            <img src=images/".$row["image"]. "alt='".$row["pname"]."'>
                            <p class='mt-2'>".$row["pname"]."</p>
                            <p class='font-bold'>".$row["price"]." رس</p>
                            <div class='product-actions'>
                                <button class='add-to-cart'><i class='fas fa-shopping-cart'></i> أضف للسلة</button>
                                <i class='fas fa-heart wishlist'></i>
                            </div>
                        </div>";
                }
            ?>
    </section>
    <section class="p-6">
        <h2 class="text-xl font-bold mb-4">لوحات لتغطية طبلون وعداد الكهرباء</h2>
        <div class="products-container">
            <div class="products-wrapper" id="productSlider">
            <?php
                
                $q = "SELECT pname, price, image FROM product, product_has_category WHERE idproduct = product_idproduct
                 and category_category_id = (SELECT category_id FROM category WHERE name = N'لوحات لتغطية طبلون وعداد الكهرباء') ORDER BY creation_date Limit 10 ";
                $stmt = $conn->query($q);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<div class='product'>
                            <img src=images/".$row["image"]. "alt='".$row["pname"]."'>
                            <p class='mt-2'>".$row["pname"]."</p>
                            <p class='font-bold'>".$row["price"]." رس</p>
                            <div class='product-actions'>
                                <button class='add-to-cart'><i class='fas fa-shopping-cart'></i> أضف للسلة</button>
                                <i class='fas fa-heart wishlist'></i>
                            </div>
                        </div>";
                }
            ?>
    </section>
    <section class="p-6">
        <h2 class="text-xl font-bold mb-4">مجموعة جدارية</h2>
        <div class="products-container">
            <div class="products-wrapper" id="productSlider">
            <?php
                
                $q = "SELECT pname, price, image FROM product, product_has_category WHERE idproduct = product_idproduct
                 and category_category_id = (SELECT category_id FROM category WHERE name = N'مجموعة جدارية') ORDER BY creation_date Limit 10 ";
                $stmt = $conn->query($q);
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<div class='product'>
                            <img src=images/".$row["image"]. "alt='".$row["pname"]."'>
                            <p class='mt-2'>".$row["pname"]."</p>
                            <p class='font-bold'>".$row["price"]." رس</p>
                            <div class='product-actions'>
                                <button class='add-to-cart'><i class='fas fa-shopping-cart'></i> أضف للسلة</button>
                                <i class='fas fa-heart wishlist'></i>
                            </div>
                        </div>";
                }
            ?>
    </section>
    
    
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('translate-x-full');
            overlay.style.display = sidebar.classList.contains('translate-x-full') ? 'none' : 'block';
        });
        
        overlay.addEventListener('click', function() {
            sidebar.classList.add('translate-x-full');
            overlay.style.display = 'none';
        });
    </script>
</body>
</html>
