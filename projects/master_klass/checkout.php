<?php
session_start();
// Подключение к базе данных
    $mysqli = new mysqli("localhost", "root", "", "MK");
    // Проверка подключения
    if ($mysqli->connect_error) {
        echo "Ошибка подключения к БД";
    }

//принимаем значение buy_MK, которое передалось при отправке формы
if (isset($_POST['buy_MK'])) {
    
    //получаем все входные значения из формы
    $MK_ID = $_POST['MK_ID'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    $MK_price = $_POST['MK_price'];
    $buydate = date('Y-m-d');
    $client_ID = 1;
//выбираем поле org_ID, находим по db.php MK_ID
    $result = mysqli_query($mysqli, "SELECT org_ID FROM `Master_class` WHERE `MK_ID` = '$MK_ID'");
    // проверка, если org_ID был найден, сохраняем в переменной $org_ID.
    if ($row = mysqli_fetch_row($result)) {
        $org_ID = $row[0];
    } else {
        echo "Мастер-класс с таким идентификатором не найден.";
    }

    //добавляем данные о бронировании БД 
    $sql = "INSERT INTO Date_of_payment (buydate, buydate_count_client, buydate_summa, buydate_status, client_ID, org_ID, MK_ID)
    VALUES ('$buydate', '$quantity', '$total_price', 'оплачено', '$client_ID', '$org_ID', '$MK_ID')";

    //проверка создана ли новая запись
    if ($mysqli->query($sql) === TRUE) {
        echo "<br>Оплата прошла успешно";
        echo "<a href='katalog.php'>Вернуться в каталог</a>";
    } else {
        echo "Произошла ошибка во время оплаты";
        echo "<a href='katalog.php'>Вернуться в каталог</a>";
    }
}
?>