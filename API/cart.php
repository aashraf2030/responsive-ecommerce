<?php

    function getUserCart($user, $conn)
    {
        $q = "SELECT MAX(idCart) FROM cart WHERE user_id = ?";
        $stmt = $conn->prepare($q);
        $stmt->execute([$user]);
        $cart = $stmt->fetch();

        if ($cart)
        {
            if (isCartResolved($cart, $conn))
            {
                createUserCart($user, $conn);
                
                $q = "SELECT MAX(idCart) FROM cart WHERE user_id = ?";
                $stmt = $conn->prepare($q);
                $stmt->execute([$user]);
                $cart = $stmt->fetch();
            }

            return $cart;
        }
        
        createUserCart($user, $conn);
        
        $q = "SELECT MAX(idCart) FROM cart WHERE user_id = ?";
        $stmt = $conn->prepare($q);
        $stmt->execute([$user]);
        $cart = $stmt->fetch();
        
        return $cart;
    }

    function isCartResolved($cart, $conn)
    {
        $q = "SELECT is_resolved FROM cart WHERE idCart = ?";
        $stmt = $conn->prepare($q);
        $stmt->execute([$cart]);
        $isResolved = $stmt->fetch();

        return $isResolved;
    }

    function createUserCart($user, $conn)
    {
        $q = "INSERT INTO cart (user_id, creation_date) VALUES (?, ?)";
        $stmt = $conn->prepare($q);
        $stmt->execute([$user, date("c")]);
    }

    function isProductInCart($product, $cart, $user, $conn)
    {
        $q = "SELECT 1 FROM cart_has_product WHERE cart_idCart = ? and cart_user_id = ? and product_idproduct = ?";
        $stmt = $conn->prepare($q);
        $stmt->execute([$cart, $user, $product]);
        $found = $stmt->fetch();


        if ($found)
            return true;
        
        return false;
    }

    function addToCart($user, $product, $conn)
    {
        $cart = getUserCart($user, $conn);

        $q = "INSERT INTO cart_has_product (cart_idCart, cart_user_id, product_idproduct) VALUES (?, ?, ?)";

        if (isProductInCart($product, $cart, $user, $conn))
        {
            $q = "UPDATE cart_has_product SET quantity = quantity + 1 
            WHERE cart_idCart = ? and cart_user_id = ? and product_idproduct = ?";
        }
        
        $stmt = $conn->prepare($q);
        $stmt->execute([$cart, $user, $product]);
    }

?>