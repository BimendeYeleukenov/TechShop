<?php
if (isset($_POST['submit'])) {
    $new_name = $_POST['add_new_name'];
    $new_img = $_POST['add_new_img'];
    $new_price = $_POST['add_new_price'];
    $new_piece = $_POST['add_new_piece'];
    $id = $_POST['id'];

    $sql = "UPDATE tech_shop SET
            product_name = '$new_name',
            image_name='$new_img',
            price = '$new_price',
            pieces = '$new_piece' 
            WHERE id=$id
            ";

    $conn = mysqli_connect('localhost', 'root', '');
    $db_select = mysqli_select_db($conn, 'techshop');
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        header("location:http://test/Work/admin.php");
    }
}
