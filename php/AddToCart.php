<?php
        $id = $_POST['id_product'];
        session_start();
        if (!isset($_SESSION['cart'])) {
            $count = 0;
            $temp[$id] = 1;
            $count = $count + 1;
        } else {
            $temp = $_SESSION['cart'];
            if (!array_key_exists($id, $temp)) {
                $temp[$id] = 1; 
                $count = $count + 1;
            } else {
                $temp[$id] = $temp[$id] + 1; 
                $count = $count + 1;
            }
        }
        $_SESSION['cart'] = $temp; 
        echo $count; 
?>