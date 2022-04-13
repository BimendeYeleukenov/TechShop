<?php
$connect = mysqli_connect("localhost", "root", "", "techshop");
$sql = "SELECT * FROM tech_shop";
$result =  mysqli_query($connect, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

define("LINK", "https://www.cbr-xml-daily.ru/latest.js");
$data = file_get_contents(LINK);
$courses = json_decode($data, true);


$KZT = $courses["rates"]["KZT"];
$USD = $courses["rates"]["USD"];
$EUR = $courses["rates"]["EUR"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechShop</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <style>
        .backcolor {
            background-color: #ced4da;
        }
    </style>
</head>

<body>
    <!-- with bootstrap -->
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3  me-md-auto text-dark text-decoration-none ms-5">
            <img src="img/logo.png" alt="logo">
        </a>

        <ul class="nav nav-pills me-5">
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link">About</a></li>
        </ul>
    </header>

    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center ms-3 me-3">
        <?php foreach ($products as $product) : ?>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal"><?php echo $product['product_name'] ?></h4>
                    </div>
                    <div class="card-body">
                        <img src="img/<?php echo $product['image_name'] ?>" alt="" height="200px" width="180px">
                        <h3 class="card-title pricing-card-title">
                            <?php echo $product['price'];
                            $price = $product['price'];
                            $price_usd = (int)round(($USD * $price) / $KZT);
                            $price_eur = (int)round(($EUR * $price) / $KZT);
                            ?> ₸
                        </h3>
                        <div class="row">
                            <div class="col-6 mt-1">
                                <span class="pieces">Pieces:</span>

                                <?php if ($product['pieces'] == 0) : ?>
                                    <span class="pieces1"> <?= "  " . $product['pieces']; ?></span>
                                <?php else : ?>
                                    <span class="pieces2"> <?= "  " . $product['pieces']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-6">
                                <?php if ($product['pieces'] == 0) : ?>
                                    <button type="button" class="w-100 btn btn-lg btn-outline-primary button" data-bs-toggle="modal" data-bs-target="#myModal" data-id="<?php echo $product['id']; ?>" id="#button" data-price_usd="<?= $price_usd; ?>" data-price_eur="<?= $price_eur; ?>" disabled> КУПИТЬ</button>
                                <?php else : ?>
                                    <button type="button" class="w-100 btn btn-lg btn-outline-primary button" data-bs-toggle="modal" data-bs-target="#myModal" data-id="<?php echo $product['id']; ?>" id="#button" data-price_usd="<?= $price_usd; ?>" data-price_eur="<?= $price_eur; ?>"> КУПИТЬ</button>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header backcolor">
                            <h4 class="modal-title">Price in USD/EUR</h4>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <h4>Price in USD:</h4>
                            <div class="summ_price_usd"></div>
                            <h4> Price in EUR </h4>
                            <div class="summ_price_eur"></div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-outline-primary button-close" id="#button" data-bs-dismiss="modal">Close
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal" id="myAdd">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header backcolor">
                            <h4 class="modal-title">Add new product</h4>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                        </div>

                        <form action="add_product.php" method="POST">
                            <!-- Modal body -->
                            <div class="modal-body">
                                <label for="add_name">Add name of product:</label><br>
                                <input type="text" id="add_name" name="add_name"><br><br>
                                <label for="add_img">Add name of image:</label><br>
                                <input type="text" id="add_img" name="add_img"><br><br>
                                <label for="add_price">Add price:</label><br>
                                <input type="number" id="add_price" name="add_price"><br><br>
                                <label for="add_piece">Add piece:</label><br>
                                <input type="number" id="add_piece" name="add_piece"><br><br>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-lg btn-outline-primary button-close" id="#button" data-bs-dismiss="modal">Add product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal" id="update">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header backcolor">
                            <h4 class="modal-title">Update product</h4>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                        </div>

                        <form action="#" method="GET">
                            <!-- Modal body -->
                            <div class="modal-body">
                                <label for="add_name">Add new name of product:</label><br>
                                <input type="text" id="add_new_name" name="add_new_name"><br><br>
                                <label for="add_img">Add new name of image:</label><br>
                                <input type="text" id="add_new_img" name="add_new_img"><br><br>
                                <label for="add_price">Add new price:</label><br>
                                <input type="number" id="add_new_price" name="add_new_price"><br><br>
                                <label for="add_piece">Add new piece:</label><br>
                                <input type="number" id="add_new_piece" name="add_new_piece"><br><br>
                                <label for="add_piece">ID of product:</label><br>
                                <input type="number" id="id" name="id"><br><br>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-lg btn-outline-primary button-close" id="#button" data-bs-dismiss="modal">Update product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
    <hr>
    <h4 class="mt-4 d-flex justify-content-center"> ADMIN PAGE</h4>


    <div class="mt-4 ms-5 me-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">PIECE</th>
                    <th scope="col">UPDATE</th>
                    <th scope="col">DELETE</th>
                </tr>

            </thead>
            <tbody>
                <?php
                foreach ($products as $product) : ?>
                    <tr>
                        <th scope="row"><?= $product['id']; ?></th>
                        <td><?= $product['product_name'] ?></td>
                        <td> <img src="img/<?php echo $product['image_name'] ?>" alt="" height="60px" width="60px"></td>
                        <td><?= $product['price'] ?></td>
                        <td><?= $product['pieces'] ?></td>
                        <td><a href="http://test/Work/update.php?id=<?= $product['id']; ?>" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#update">UPDATE</a></td>
                        <td> <a href="http://test/Work/delete.php?id=<?= $product['id']; ?>" class="btn btn-danger mt-2">DELETE</a> </td>
                    </tr>
                <?php
                endforeach; ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-lg btn-outline-primary button mb-5 " data-bs-toggle="modal" data-bs-target="#myAdd"> ADD</button>
    </div>

</body>

</html>