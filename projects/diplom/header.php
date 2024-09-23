<?php
session_start();
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "MK");



// Проверка подключения
if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

//существует ли данный ID
if (isset($_GET['client_ID'])) {
    $client_ID = $_GET['client_ID'];
    // сохраняем ID клиента в сессии
    $_SESSION['client_ID'] = $client_ID;
}

if (isset($_GET['org_ID'])) {
    $org_ID = $_GET['org_ID'];
    // сохраняем ID организатора в сессии
    $_SESSION['org_ID'] = $org_ID;
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php
    if ((isset($client_ID)) || (isset($org_ID)))
    {
        echo "идентифкатора покупателя или организатора найден";
        ?>
         <nav class="navbar navbar-dark bg-dark navbar-expand-md sticky-top">
            <a href="#" class="navbar-logo">MASTER-CLASS</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item text-uppercase"><a href="index.php#about_us?client_ID=<?php echo $client_ID; ?>"
                            class="nav-link">о нас</a></li>
                    <li class="nav-item text-uppercase"><a href="katalog.php?client_ID=<?php echo $client_ID; ?>"
                            class="nav-link">каталог</a> </li>
                    <li class="nav-item text-uppercase"><a href="lk_client.php?client_ID=<?php echo $client_ID; ?>"
                            class="nav-link">личный кабинет</a>
                    </li>
                    <li class="nav-item text-uppercase">
                        <a href="cart.php?client_ID=<?php echo $client_ID; ?>" class="nav-link">корзина</a>

                        <?php
                        if (!empty($_SESSION["shopping_cart"])) {
                            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                            ?>

                        <li>
                            <span style="font-size: 11px;
                                            line-height: 9px;
                                            background: #3e1ef6;
                                            padding: 2px;
                                            border: 2px solid #fff;
                                            border-radius: 50%;
                                            position: absolute;
                                            top: 12px;
                                            left: 950px;
                                            color: #fff;
                                            width: 16px;
                                            height: 16px;
                                            text-align: center;">
                                <?php echo $cart_count; ?>
                            </span></a>
                        </li>
                    <?php }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
    }
        
    else {
        echo "идентификатор покупателя НЕ найден";
        ?>
        <nav class="navbar navbar-dark bg-dark navbar-expand-md sticky-top">
            <a href="#" class="navbar-logo">MASTER-CLASS</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item text-uppercase"><a href="index.php#about_us" class="nav-link">о нас</a></li>
                    <li class="nav-item text-uppercase"><a href="katalog.php" class="nav-link">каталог</a> </li>
                    <li class="nav-item text-uppercase"><a href="login_client.php" class="nav-link">вход</a>
                    </li>
                    <li class="nav-item text-uppercase">
                        <a href="cart.php" class="nav-link">корзина</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
    }

    ?>



</body>

</html>