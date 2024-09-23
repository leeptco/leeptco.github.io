<?php
//переменная для информации о статусе (добавлен/уже в корзине)
$status = "";
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "MK");

// Проверка подключения
if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Вход в личный кабинет</title>
</head>

<body>
    <header>
        <?php include('header.php') ?>
    </header>


    <vhod>
        <div class="section">
            <div class="container">
                <div class="registration_name text-center text-uppercase">
                    Вход в личный кабинет покупателя
                </div>
                <form action="" method="post" class="text-center">

                    <input type="email" class="form-control form-control-lg registration_form" name="client_email"
                        placeholder="Введите email" required><br>
                    <input type="password" class="form-control form-control-lg registration_form" name="client_password"
                        placeholder="Введите пароль" required><br>
                    <button type="submit" class="btn mb-3 button_registration"
                        style="border: 2px solid var(--color2);">Войти</button>

                    <p></p>

                    <div class="text-center">
                        Нет профиля?
                        <a href="registration.php">Зарегистрируйтесь</a>
                    </div>
                </form>
            </div>
        </div>
    </vhod>
    <?php


    // Обработка данных из формы входа
    $client_email = $_POST['client_email'];
    $client_password = $_POST['client_password'];

    // SQL-запрос для поиска пользователя по электронной почте
    $sql = "SELECT * FROM Client WHERE client_email='$client_email'";

    $result = $mysqli->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Проверка пароля
        if (password_verify($_POST['client_password'], $row['client_password'])) {
            header("Location:lk_client.php?client_ID=" . urlencode($row['client_ID']));
            exit;
        } else {
            $status = "<div class='box text-center' style='color: red'>Неверный пароль</div>";
        }
    } else
        $status = "";

    if ((isset($_POST['client_email'])) && ($_POST['client_email'] != $row['client_email'])) {
        $status = "<div class='box text-center' style='color: red'>Пользователь с указанной электронной почтой не найден.</div>";
    }
    ?>

    <div>
        <?php echo $status;
        $status = "";
        ?>
    </div>

</body>

</html>