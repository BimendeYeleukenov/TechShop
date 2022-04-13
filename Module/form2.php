<?php
if (isset($_POST['submit'])) {
    $folder_name = $_POST['name_folder'];
    $sql = "INSERT INTO bitrix_base SET
    folder_name = '$folder_name'";
    $conn = mysqli_connect('localhost', 'root', '');
    $db_select = mysqli_select_db($conn, 'bitrix');
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        header("location:http://test/work3/module.php");
    }
}
