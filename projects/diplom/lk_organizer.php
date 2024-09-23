<?php
session_start();
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "MK");

// Проверка подключения
if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

//существует ли данный ID

    
    if (isset($_GET['org_ID'])) { 
    $org_ID = $_GET['org_ID'];
    // сохраняем ID организатора в сессии
    $_SESSION['org_ID'] = $org_ID;
    echo "org ID = $org_ID";
    ?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет организатора</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
		<?php include ('header.php') ?>
	</header>

    <div class="section">
        <div class="container">
            <div class="kat_name text-center text-uppercase">
            личный кабинет организатора
            </div>

            <div class="privet_organizer">
               <h2><?php
               // SQL-запрос для поиска пользователя по ID
               $sql = "SELECT org_Fname , org_Iname org_Oname FROM Organizer WHERE org_ID='$org_ID'";
               $stmt = mysqli_query($mysqli, $sql);
               $row = mysqli_fetch_assoc($stmt);
               $org_Fname = $row['org_Fname'];
               $org_Iname = $row['org_Iname'];
               $org_Oname = $row['org_Oname'];

               echo "Здравствуйте, $org_Fname $org_Iname $org_Oname!";
               ?>
               </h2>
            
            <br><br><br>
            <h5>Работа с карточками товаров</h5>
            <br>
            <p><a href="form_make_MK.php">Создать карточку мастер-класса</a></p>
            <p><a href="work_with_card.php">Редактировать карточку мастер-класса</a></p>
            <p><a href="work_with_card.php">Удалить карточку мастер-класса</a></p>
            </div>
            <p><a href="form_make_MK.php">Изменить статус мастер-класса</a></p>
            <div class="kat_name text-center text-uppercase">
            Прибыль за определенный период:
            </div>
            <form method="post" action="">
    <label for="start_date">Дата начала:</label>
    <input type="date" name="start_date" id="start_date" required>

    <label for="end_date">Дата окончания:</label>
    <input type="date" name="end_date" id="end_date" required>

    <button type="submit">Применить фильтр</button>
</form>

<?php
// Определение прибыли
if (isset($_GET['org_ID'])) {
    $org_ID = $_GET['org_ID'];

    //проверка заданы ли начальная конечная даты
    if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
        //инициализируем переменные
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
    
        //выбираем сумму (SUM) прибыли, фильтруем результаты по org_ID и дате покупки, ограничивая ее начальной и конечной датами
    $sql = "SELECT SUM(buydate_summa) AS total_profit
            FROM Date_of_payment
            WHERE org_ID = '$org_ID'
            AND buydate >= '$start_date'
            AND buydate <= '$end_date'";
// сохраняем в переменной $result прибыль организатора за указанный период
    $result = mysqli_query($mysqli, $sql);
    // проверка успешно ли выполнен запрос. извлекаем следующую строку результата запроса и возвращаем ее в виде ассоциативного массива
    if ($row = mysqli_fetch_assoc($result)) {
        $total_profit = $row['total_profit'];
        echo "<br>Прибыль организатора за указанный период: $total_profit руб.";
    } else {
        echo "Прибыль не найдена.";
    }
}}


// Определение рейтинга товаров
 
?> 
<div class='kat_name text-center text-uppercase'>
    Топ 3 товаров с наибольшей прибылью:
        </div>

        <form method="post" action="">
<label for="start_date_2">Дата начала:</label>
<input type="date" name="start_date_2" id="start_date_2" required>

<label for="end_date_2">Дата окончания:</label>
<input type="date" name="end_date_2" id="end_date_2" required>

<button type="submit">Применить фильтр</button>
</form>
<?php
     //проверка заданы ли начальная конечная даты
     if (isset($_POST['start_date_2']) && isset($_POST['end_date_2'])) {
        $org_ID = $_GET['org_ID'];
        //инициализируем переменные
        $start_date_2 = $_POST['start_date_2'];
        $end_date_2 = $_POST['end_date_2'];

    // $start_date = '2023-01-01';
    // $end_date = '2023-12-31';
//выбираем название МК, и суммируем поля buydate_summa сохраняем как total_profit
    $sql = "SELECT Master_class.MK_name, SUM(Date_of_payment.buydate_summa) AS total_profit
            FROM Date_of_payment
            -- //объединяем таблицы на основе совпадения идентификаторов МК 
            INNER JOIN Master_class ON Date_of_payment.MK_ID = Master_class.MK_ID
            -- //условия по ID организатора и датам
            WHERE Date_of_payment.org_ID = '$org_ID'
            AND Date_of_payment.buydate >= '$start_date_2'
            AND Date_of_payment.buydate <= '$end_date_2'
            -- //группировка по каждому уникальному мастер-классу.
            GROUP BY Date_of_payment.MK_ID, Master_class.MK_name
            -- //Сортировка результатов в убывающем порядке (DESC) по полю total_profit, 
            ORDER BY total_profit DESC
            LIMIT 3";
// сохраняем в переменной $result приносящие прибыль товары за указанный период
    $result = mysqli_query($mysqli, $sql);

    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<br>{$row['MK_name']} (Прибыль: {$row['total_profit']} руб.)";
        }
    } else {
        echo "Данные о прибыли не найдены.";
    }
}



}
else {
echo "Идентификатор организатора не передан.";
}
?>
<br><br><br><br><br><br>
  </div>
    </div>
</body>
</html>