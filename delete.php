<?php
include "database.php";

if(isset($_GET['id'])){
    try{
        $product_id = $_GET['id'];
        $delete_product = "DELETE FROM products WHERE id = :id";
        $stmt = $pdo->prepare($delete_product);
        $stmt->execute([':id' =>$product_id ]);
        header("Location: index.php");

    }catch(PDOException $e){
        echo "ERROR ". $e->getMessage();
    }
    unset($stmt);
}
?>