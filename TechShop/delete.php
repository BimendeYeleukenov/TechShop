<?php
$id = $_GET['id'];

$sql = "DELETE FROM tech_shop WHERE id=$id";
$conn = mysqli_connect('localhost', 'root', '');
$db_select = mysqli_select_db($conn, 'techshop');
$res = mysqli_query($conn, $sql);

if ($res == TRUE) {
    header("location:http://test/Work/admin.php");
}
