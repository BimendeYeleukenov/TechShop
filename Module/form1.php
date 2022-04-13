<?php
if (isset($_POST['submit'])) {
    $folder = $_POST['folder'];
    $naimenovania_name = $_POST['naimenovania_name'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $url = $_POST['url'];
    $comments = $_POST['comments'];

    $sql = "UPDATE bitrix_base SET
    naimenovania_name = '$naimenovania_name',
    login = '$login',
    password = '$password',
    url = '$url',
    comments = '$comments' 
    WHERE folder_name = '$folder'";

    $conn = mysqli_connect('localhost', 'root', '');
    $db_select = mysqli_select_db($conn, 'bitrix');
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        header("location:http://test/Module/module.php");
    }

    var_dump($conn);
}
