<?php

//запуск механизма сессий 
session_start();
$client_ID = $_SESSION['client_ID'];

//устанавливаем соединение с БД
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "MK");

// Проверка подключения
if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}
include('server.php');
//переменная для информации о статусе (добавлен/уже в корзине)
$status = "";


//проверка конкретного ID, к-ый пользователь добавляет в корзину
if (isset($_POST['MK_ID']) && $_POST['MK_ID'] != "") {
    $MK_ID = $_POST['MK_ID'];
    //выборка из БД по ID
    $result = mysqli_query($db, "SELECT * FROM `Master_class` WHERE `MK_ID`='$MK_ID'");
    //извлечение и сохранение данных в ассоциативный массив $row
    $row = mysqli_fetch_assoc($result);
    $MK_name = $row['MK_name'];
    $MK_ID = $row['MK_ID'];
    $MK_opisanie = $row['MK_opisanie'];
    $MK_date = $row['MK_date'];
    $MK_price = $row['MK_price'];
    $MK_image = $row['MK_image'];

    //массив для товара, к-ый хотим добавить в корзину
    $cartArray = array(
        $MK_ID => array(
            //ключ массива
            'MK_name' => $MK_name,
            //ключ - значение
            'MK_ID' => $MK_ID,
            'MK_opisanie' => $MK_opisanie,
            'MK_date' => $MK_date,
            'MK_price' => $MK_price,
            'quantity' => 1,
            //начальное количество товара в корзине
            'MK_image' => $MK_image
        )
    );

    //проверка, если ли у пользователя товар в корзине или она пуста
    if (empty($_SESSION["shopping_cart"])) {
        //присваиваем корзине массив (информацию о товаре)
        $_SESSION["shopping_cart"] = $cartArray;
        $status = "<div class='box'>Мастер-класс добавлен в корзину!</div>";
    } else {
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if (in_array($MK_ID, $array_keys)) {
            $status = "<div class='box' style='color:red;'>
		Мастер-класс уже находится в вашей корзине!</div>";
        } else {
            $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
            $status = "<div class='box'>Мастер-класс ОПЯТЬ добавлен в корзину!</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <?php include('header.php') ?>
    </header>

    <div class="section">
        <div class="container">

            <div class="kat_name text-uppercase text-center">
                Персонализированный каталог 
                <br>
                <h6>пройдите тест и запишитесь на мастер-классы, которые подойдут именно Вам!</h6>
                <br>
            </div>
            <h3>1. В какой сфере вы хотели бы развиваться?</h3>
            <form id="filterForm">

                <ul id="MK_category" name="MK_category">
                    <li> <input type="radio" name="MK_category" value="knit" id="knit"> Творчество</li>
                    <li> <input type="radio" name="MK_category" value="sport" id="sport"> Спорт</li>
                    <li> <input type="radio" name="MK_category" value="business" id="business"> Бизнес</li>
                </ul>
                <br>


                <h3>2. Укажите ваш бюджет:</h3>
                <ul id="MK_price" name="MK_price">
                    <li> <input type="radio" name="MK_price" value="0" id="0"> Бесплатно</li>
                    <li> <input type="radio" name="MK_price" value="0-1500" id="0-1500"> До 1,500 руб.</li>
                    <li> <input type="radio" name="MK_price" value="1500-100000" id="1500-100000"> От 1,500 руб. и выше</li>
                </ul>
                <br>

                <h3>3. Когда планируете посетить мастер-класс?</h3>
                <ul id="MK_date" name="MK_date">
                    <li> <input type="radio" name="MK_date" value="weekend" id="weekend"> Ближайшие выходные</li>
                    <li> <input type="radio" name="MK_date" value="month" id="month"> Ближайший месяц</li>
                    <li> <input type="radio" name="MK_date" value="anytime" id="anytime"> В любое время</li>
                </ul>
                <br>

                <input type="button" value="Смотреть!" onclick="applyFilter()" class="button_filter">
            </form>
            <br> <br>

            <div class='row row-cols-1 row-cols-md-3 g-4' id="productsContainer"></div>

            
            <div id="noResultsMessage" style="display: none; color: red;">По вашим запросам не найдено мероприятий</div>

<script>
    function applyFilter() { 
        // Получить значение выбранной категории
        var category = document.querySelector('input[name="MK_category"]:checked').value; 
        var price = document.querySelector('input[name="MK_price"]:checked').value; 

        // Выполнить асинхронный запрос
        var xhr = new XMLHttpRequest(); 
        xhr.onreadystatechange = function () { 
            if (xhr.readyState === 4) { 
                if (xhr.status === 200) { 
                    // Обработать полученные данные и отобразить на странице 
                    document.getElementById('productsContainer').innerHTML = xhr.responseText; 
                    // Проверить, содержит ли ответ данные, если нет - отобразить сообщение
                    if (xhr.responseText.trim() === "") {
                        document.getElementById('noResultsMessage').style.display = 'block';
                    } else {
                        document.getElementById('noResultsMessage').style.display = 'none';
                    }
                } else {
                    // В случае ошибки или отсутствия данных отобразаем сообщение
                    document.getElementById('productsContainer').innerHTML = "Произошла ошибка при загрузке данных";
                    document.getElementById('noResultsMessage').style.display = 'block';
                }
            }
        }; 

        // Подготовить данные для отправки 
        var data = 'MK_category=' + category + '&MK_price=' + price; 

        // Отправить запрос методом POST на ваш серверный скрипт 
        xhr.open('POST', 'filter.php', true); 
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
        xhr.send(data); 
    }
</script>
        </div>

        <div>
            <?php echo $status; ?>
        </div>

        <br><br><br><br><br>
    </div>
    </div>
</body>

</html>