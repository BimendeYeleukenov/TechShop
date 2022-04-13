<?php
$connect = mysqli_connect("localhost", "root", "", "bitrix");
$sql = "SELECT * FROM bitrix_base";
$result =  mysqli_query($connect, $sql);
$folders = mysqli_fetch_all($result, MYSQLI_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="content_btn me-5">
        <button type="button" class="btn btn-outline-primary btn btn-lg me-5 w-10" data-bs-toggle="modal" data-bs-target="#createFolder">Создать папку</button>
        <button type="button" class="btn btn-outline-success btn btn-lg w-10" data-bs-toggle="modal" data-bs-target="#myModal">Создать пароль</button>
    </div>

    <div class="tables">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Логин</th>
                    <th scope="col">Пароль</th>
                    <th scope="col">URL</th>
                    <th scope="col">Комментарий</th>
                </tr>
            </thead>
            <?php foreach ($folders as $folder) : ?>
                <tbody>
                    <tr>
                        <th scope="row"> <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-folder2" viewBox="0 0 16 16">
                                    <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v7a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 12.5v-9zM2.5 3a.5.5 0 0 0-.5.5V6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5zM14 7H2v5.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5V7z" />
                                </svg>
                                <span class="ms-2"><?= $folder["folder_name"]; ?></span>
                            </a>
                        </th>
                        <td><?= $folder["login"]; ?></td>
                        <td><?= $folder["password"]; ?></td>
                        <td><?= $folder["URL"]; ?></td>
                        <td><?= $folder["comments"]; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
        </table>
    </div>



    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header backcolor">
                    <h4 class="modal-title">Создать пароль</h4>
                </div>
                <form action="form1.php" method="POST">
                    <!-- Modal body -->
                    <div class="modal-body">


                        <div class="input-group mb-3">
                            <select class="form-select" id="country" name="folder">
                                <option value="">Выберите папку...</option>
                                <?php foreach ($folders as $folder) : ?>
                                    <option><?= $folder["folder_name"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-floating">
                            <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Наименование" name="naimenovania_name">
                            <label for="floatingInput">Наименование</label>
                        </div>
                        <div class="form-floating">
                            <input type="email" class="form-control mb-3" id="floatingInput" placeholder="name@example.com" name="login">
                            <label for="floatingInput">Логин</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control mb-3" id="floatingPassword" placeholder="Пароль" name="password">
                            <label for="floatingPassword">Пароль</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control mb-3" id="floatingInput" placeholder="URL" name="url">
                            <label for="floatingInput">URL</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Наименование" name="comments">
                            <label for="floatingInput">Комментарий</label>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-lg btn-primary button-close">Сохранить</button>
                        <button type="button" class="btn btn-lg btn-danger button-close" data-bs-dismiss="modal">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal" id="createFolder">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header backcolor">
                    <h4 class="modal-title">Создать папку</h4>
                </div>
                <form action="form2.php" method="POST">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="text" class="form-control mb-3" id="floatingInput" name="name_folder" placeholder="Напишите имя файла">
                            <label for="floatingInput">Имя файла</label>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-lg btn-primary button-close">Сохранить</button>
                        <button type="button" class="btn btn-lg btn-danger button-close" data-bs-dismiss="modal">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>