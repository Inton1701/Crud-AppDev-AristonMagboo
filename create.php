<?php
include "database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <label for="name">Name: </label>
        <input type="text" name="name" required><br>
        <label for="description">Description: </label>
        <input type="text" name="description" required><br>
        <label for="price">Price: </label>
        <input type="text" name="price" required ><br>
        <label for="quantity">Quantity: </label>
        <input type="text" name="quantity" required><br>
    
        <input type="submit" name="add">

    </form>
    <a href="index.php">Back</a><br>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    try {
        $create = "INSERT INTO products (`name`, `description`, `price`, `quantity`) VALUES (:name, :description, :price, :quantity)";
        $stmt = $pdo->prepare($create);
        $stmt->execute([
            'name' => $name,
            'description' => $desc,
            'price' => $price,
            'quantity' => $quantity
        ]);
        echo "Product added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    unset($stmt);
    
}
