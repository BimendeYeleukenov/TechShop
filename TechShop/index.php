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
                        <button type="button" class="w-100 btn btn-lg btn-outline-primary button" data-bs-toggle="modal" data-bs-target="#myModal" data-id="<?php echo $product['id']; ?>" id="#button" data-price_usd="<?= $price_usd; ?>" data-price_eur="<?= $price_eur; ?>"> КУПИТЬ</button>
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
                            <button type="button" class="btn btn-lg btn-outline-primary button-close" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>