<?php
    include "API/conn.php";

?>

<!DOCTYPE html>
<html lang="ar" dir=rtl>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Cairo";
            transition: 0.5s;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const loginTab = document.getElementById('login-tab');
            const registerTab = document.getElementById('register-tab');
            
            if (loginForm && registerForm && loginTab && registerTab) {
                function toggleForm(formType) {
                    loginForm.classList.toggle('hidden', formType !== 'login');
                    registerForm.classList.toggle('hidden', formType !== 'register');
                    loginTab.classList.toggle('bg-yellow-500', formType === 'login');
                    loginTab.classList.toggle('text-white', formType === 'login');
                    registerTab.classList.toggle('bg-yellow-500', formType === 'register');
                    registerTab.classList.toggle('text-white', formType === 'register');
                }
                
                loginTab.addEventListener("click", () => toggleForm('login'));
                registerTab.addEventListener("click", () => toggleForm('register'));
            }
        });
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md transition-all">
        <div class="flex mb-6">
            <button id="login-tab" class="flex-1 py-2 bg-yellow-500 text-white text-center rounded-l-lg">تسجيل الدخول</button>
            <button id="register-tab" class="flex-1 py-2 bg-gray-200 text-gray-700 text-center rounded-r-lg">تسجيل مستخدم جديد</button>
        </div>
        
        <div id="login-form">
            <h2 class="text-2xl font-bold text-center mb-6">تسجيل الدخول</h2>
            <form action=<?php echo "'".$api_base."login.php'"?> method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700" for="username">اسم المستخدم</label>
                    <input type="text" id="username" name="username" class="w-full border border-gray-300 py-2 px-4 rounded-lg focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="password">كلمة المرور</label>
                    <input type="password" id="password" name="password" class="w-full border border-gray-300 py-2 px-4 rounded-lg focus:outline-none" required>
                </div>
                <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 transition">تسجيل الدخول</button>
            </form>
        </div>
        
        <div id="register-form" class="hidden">
            <h2 class="text-2xl font-bold text-center mb-6">تسجيل مستخدم جديد</h2>
            <form action="register.php" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700" for="fullname">الاسم الكامل</label>
                    <input type="text" id="fullname" name="fullname" class="w-full border border-gray-300 py-2 px-4 rounded-lg focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 py-2 px-4 rounded-lg focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="phone">رقم الهاتف</label>
                    <input type="text" id="phone" name="phone" class="w-full border border-gray-300 py-2 px-4 rounded-lg focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="new-username">اسم المستخدم</label>
                    <input type="text" id="new-username" name="new-username" class="w-full border border-gray-300 py-2 px-4 rounded-lg focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="new-password">كلمة المرور</label>
                    <input type="password" id="new-password" name="new-password" class="w-full border border-gray-300 py-2 px-4 rounded-lg focus:outline-none" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="confirm-password">تأكيد كلمة المرور</label>
                    <input type="password" id="confirm-password" name="confirm-password" class="w-full border border-gray-300 py-2 px-4 rounded-lg focus:outline-none" required>
                </div>
                <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 transition">إنشاء حساب</button>
            </form>
        </div>
    </div>
</body>
</html>
