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
    ?>

    <!DOCTYPE html>
    <html lang="ru">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Личный кабинет покупателя</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <header>
            <?php include('header.php') ?>
        </header>

        <div class="section">
            <div class="container">
                <div class="kat_name text-center text-uppercase">
                    личный кабинет покупателя
                </div>

                <div class="privet_organizer">
                    <h2>
                        <?php
                        // SQL-запрос для поиска пользователя по ID
                        $sql = "SELECT client_Fname , client_Iname FROM Client WHERE client_ID='$client_ID'";
                        $stmt = mysqli_query($mysqli, $sql);
                        $row = mysqli_fetch_assoc($stmt);
                        $client_Fname = $row['client_Fname'];
                        $client_Iname = $row['client_Iname'];

                        echo "Здравствуйте, $client_Fname $client_Iname !";
                        ?>
                    </h2>
                    <br>

                    <form method="post" action="">
                        <label for="start_date">Дата начала:</label>
                        <input type="date" name="start_date" id="start_date" required>

                        <label for="end_date">Дата окончания:</label>
                        <input type="date" name="end_date" id="end_date" required>

                        <button type="submit">Применить фильтр</button>
                    </form>


                    <br><br><br>
                    <h5>История покупок мастер-классов</h5>
                    <br>


                    <?php
                    if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                        $start_date = $_POST['start_date'];
                        $end_date = $_POST['end_date'];
                        $client_ID = $_SESSION['client_ID'];
                        $client_ID = 1;

                        // SQL-запрос для выборки покупок в указанном диапазоне дат
                        $sql = "SELECT Date_of_payment.*, Master_class.MK_name
            FROM Date_of_payment
            INNER JOIN Master_class ON Date_of_payment.MK_ID = Master_class.MK_ID
            WHERE Date_of_payment.buydate >= '$start_date'
            AND Date_of_payment.buydate <= '$end_date'
            AND Date_of_payment.client_ID = '$client_ID'";

                        $result = mysqli_query($mysqli, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // Вывод результатов
                            echo "<table class='table'>
                <thead>
                    <tr>
                        <th>Номер бронирования</th>
                        <th>Название мастер-класса</th>
                        <th>Количество бронируемых мест</th>
                        <th>Общая стоимость покупки</th>
                        <th>Дата покупки</th>
                    </tr>
                </thead>
                <tbody>";

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "
            <tr>
                <td>" . $row['buydate_ID'] . "</td>
                <td>" . $row['MK_name'] . "</td>
                <td>" . $row['buydate_count_client'] . "</td>
                <td>" . $row['buydate_summa'] . "руб.</td>
                <td>" . $row['buydate'] . "</td>
            </tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "Нет записей для выбранных дат.";
                        }
                    }
                    ?>
                    <br>
                    <a href="katalog.php">Перейти в каталог для просмотра</a>
                    <br>
                    Если вы хотите стать организатором мероприятий, то используйте 
                    <a href="login_organizer.php">эту форму</a>
                    чтобы войти или создать личный кабинет.

                </div>
            </div>
    </body>

    </html>

    <?php
} else {
    echo "Идентификатор покупателя не передан.";
}
?>