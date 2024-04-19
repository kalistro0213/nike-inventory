<?php

include 'connect.php';

$id=$_GET['updateid'];

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    $image_name = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];

    if(!empty($image_name)) {
        $image_data = file_get_contents($image_temp);
        $image_data = mysqli_real_escape_string($conn, $image_data);
    } else {
        // Default image data or handle error as per your requirement
        $image_data = ''; 
    }

    $sql = "Update sneaker set name='$name', stock='$stock', price='$price', prod_img='$image_data' WHERE id='$id'";

    $result = mysqli_query($conn, $sql);

    if($result){
        header('location:index.php');

    } else {
        die(mysqli_error($conn));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
        <h2>Update Product</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">     
                <label>Product Name</label><br>
                <input type="text" class="form-control" name="name" placeholder="Product Name" autocomplete="off"> 
           </div>

            <div class="form-group">      
                <label>Stock</label><br>
                <input type="number" class="form-control" name="stock" placeholder="50" autocomplete="off"> 
            </div>
        
            <div class="form-group">      
                <label>Price</label><br>
                <input type="number" class="form-control" name="price" placeholder="5000.00" autocomplete="off"> 
            </div>

            <div class="form-group">      
                <label>Upload Image</label><br>
                <input type="file" class="form-control-file" name="image">
            </div>
            
            <br>
            
            <button type="submit" class="btn btn-primary" name="submit" style="border:1px gray solid; padding: 5px; padding-left:9px; padding-right: 9px; border-radius:10px;">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</body>
</html>