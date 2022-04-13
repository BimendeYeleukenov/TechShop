<?php
if (isset($_POST['submit'])) {
    $new_name = $_POST['add_name'];
    $new_img = $_POST['add_img'];
    $new_price = $_POST['add_price'];
    $new_piece = $_POST['add_piece'];

    $sql = "INSERT INTO tech_shop SET
            product_name = '$new_name',
            image_name='$new_img',
            price = '$new_price',
            pieces = '$new_piece'
            ";

    $conn = mysqli_connect('localhost', 'root', '');
    $db_select = mysqli_select_db($conn, 'techshop');
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        header("location:http://test/Work/admin.php");
    }
}
