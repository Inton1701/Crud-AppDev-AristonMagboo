<?php
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>List of Products</h1>
    <a href="create.php">Add Products</a><br>
    <table border="1">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>description</th>
            <th>price</th>
            <th>quantity</th>
            <th>actions</th> 
        </tr>

        <?php
        try{
            $sql = "SELECT id, name, description, price, quantity from products";
            $stmt = $pdo->prepare($sql);

            $stmt->execute();
            $number_of_rows = $stmt->rowCount();
            if($number_of_rows > 0){
                while($products = $stmt->fetch()){
                    echo   "<tr>
                                <td>".$products['id']."</td>
                                <td>".$products['name']."</td>
                                <td>".$products['description']."</td>
                                <td>".$products['price']."</td>
                                <td>".$products['quantity']."</td>
                                <td>";
                               echo '<a href="update.php?id='. $products['id'].'">Edit</a> ';
                                echo '<a href="delete.php?id='.$products['id'].'">Delete</a>';
                            
                                "</td></tr>";
                            
                }
            }
        }catch(PDOexception $e){
            echo 'Error ' . $e->getMessage();
        }
        unset($stmt);

        ?>

    </table>
</body>
</html>