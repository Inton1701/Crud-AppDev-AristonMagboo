<?php
include "database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <h1>Edit Products</h1>
    <?php
        if(isset($_GET['id'])){
          $product_id = $_GET['id'];
          try{
            $get_product = "SELECT id, name, description, price, quantity, created_at, updated_at FROM products WHERE id = :id";
            $stmt = $pdo->prepare($get_product);
            $stmt->execute([':id' => $product_id ]);
            while($product = $stmt->fetch()){
                ?> 
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <label for="">ID: <?php echo $product['id'];?></label>
                    <input type="hidden" name="id" value="<?php echo $product['id'];?>">
                    <label for="name">Name: </label>
                    <input type="text" name="name" value="<?php echo  $product['name'];?>"><br>
                    <label for="description">description: </label>
                    <input type="text" name="description" value="<?php echo $product['description'];?>"><br>
                    <label for="price">price: </label>
                    <input type="text" name="price" value="<?php echo $product['price'];?>"><br>
                    <label for="quantity">quantity: </label>
                    <input type="text" name="quantity" value="<?php echo $product['quantity'];?>"><br>
                    <label for="">Created: <?php echo $product['created_at']; ?></label><br>
                    <label for="">Updated <?php echo is_null($product['updated_at'])? "no update yet":$product['updated_at']; ?></label><br><br>
                    <input type="submit" name="edit">

                </form>

                <?php   
            }
          }catch(PDOException $e){
            echo "Error " . $e->getMessage();
          }
          unset($stmt);

        }
    ?>
    <a href="index.php">back</a>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])){
    $product_id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $curr_date = date('Y-m-d H:i:s');
    try{
        $update_product = "UPDATE products SET name = :name , description = :description, price = :price, quantity = :quantity, updated_at = :updated_at WHERE id = :id";
        $stmt = $pdo->prepare($update_product);
        $stmt->execute([':name' => $name,':description' => $description, ':price' => $price, ':quantity' => $quantity, ':updated_at' => $curr_date, ':id' => $product_id]);
        header("Location: update.php?id=".$product_id);

    }catch(PDOException $e){
        echo "ERROR ". $e->getMessage();
    }
   

}