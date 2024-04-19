<?php

include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM sneaker WHERE `id`='$id'";
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        .top{
            top: 0;
	        left: 0;
            width: 100%;
	        display: flex;
            justify-content: space-between;
            margin-top: -15px;
            margin-bottom: -15px;
            padding-right: 30px;
            padding-left: 30px;
            align-items: center;
        }
    </style>
</head>
<body>

    <div class="top">

        <h1>Nike </h1>
        <button class="btn my-5"><a href="add.php" class="text-dark"> Add Product</a></button>

    </div>

    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body" id="modal-body">
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Stock Number</th>
                <th scope="col">Product Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT * FROM sneaker";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['name'];
                    $stock = $row['stock'];
                    $price = $row['price'];
                    // Fetch the image BLOB type in the database
                    $imageData = base64_encode($row['prod_img']);
                    $imageSrc = 'data:image/jpeg;base64,'.$imageData;
                    echo '<tr>
                            <th scope="row">'.$name.'</th>
                            <td>'.$stock.'</td>
                            <td>'.$price.'</td>
                            <td>
                                <button class="btn btn-primary view-btn" data-toggle="modal" data-target="#productModal" 
                                data-name="'.$name.'" data-stock="'.$stock.'" data-price="'.$price.'" data-image="'.$imageSrc.'">View</button>
                                
                                <button class="btn"><a href="update.php?updateid='.$row['id'].'".>Update</a></button>
                                
                                <button class="btn btn-danger" style="text-decoration: none;"><a href="delete.php?deleteid='.$row['id'].'">Delete</a></button>
                            </td>
                        </tr>';
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Bootstrap and jQuery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.view-btn').click(function() {
            var name = $(this).data('name');
            var stock = $(this).data('stock');
            var price = $(this).data('price');
            var image = $(this).data('image');
            
            $('#productModalLabel').text(name);
            $('#modal-body').html('<img src="' + image + '" alt="Shoe Image" id="img-prod" class="img-fluid"><p>Stock: ' + stock + '</p><p>Price: ' + price + '</p>');
        });
    });
    </script>
    
</body>
</html>