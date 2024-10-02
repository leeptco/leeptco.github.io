<?php
// Подключение к базе данных
$mysqli = new mysqli("localhost", "root", "", "MK");

// Проверка подключения
if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

//РЕГИСТРАЦИЯ ПОЛЬЗОВАТЕЛЯ / ПОКУПАТЕЛЯ DONT WORK
if (isset($_POST['registration_client'])) {
// Обработка данных из формы регистрации
$client_Iname = $_POST['client_Iname'];
$client_Fname = $_POST['client_Fname'];
$client_email = $_POST['client_email'];
$client_password = password_hash($_POST['client_password'], PASSWORD_DEFAULT);
$client_phone = $_POST['client_phone'];

// Выбор записи с указанным email
$sql = "SELECT client_email FROM Client WHERE client_email = '$client_email'";

// Выполнение запроса
$result = $mysqli->query($sql);

// Если найдена запись с указанным email
if ($result->num_rows > 0) {
    echo "Пользователь с таким email уже существует. Регистрация невозможна.";
} else {
    // SQL-запрос для вставки данных
$sql = "INSERT INTO Client (client_Iname, client_email, client_password, client_Fname, client_phone) VALUES ('$client_Iname', '$client_email', '$client_password', '$client_Fname', '$client_phone')";

// Выполнение запроса
if ($mysqli->query($sql) === TRUE) {
    echo "Регистрация прошла успешно.";
    include('login_client.php');
} else {
    echo "Произошла ошибка во время регистрации";
}
}
}

//РЕГИСТРАЦИЯ ОРГАНИЗАТОРА
if (isset($_POST['registration_organizer'])) {
    // Обработка данных из формы регистрации
$org_Iname = $_POST['org_Iname'];
$org_email = $_POST['org_email'];
$org_password = password_hash($_POST['org_password'], PASSWORD_DEFAULT);
$org_Fname = $_POST['org_Fname'];
$org_Oname = $_POST['org_Oname'];
$org_phone = $_POST['org_phone'];

// Выбор записи с указанным email
$sql = "SELECT org_email FROM Organizer WHERE org_email = '$client_email'";

// Выполнение запроса
$result = $mysqli->query($sql);

// Если найдена запись с указанным email
if ($result->num_rows > 0) {
    echo "Пользователь с таким email уже существует. Регистрация невозможна.";
} else {
    // SQL-запрос для вставки данных
$sql = "INSERT INTO Organizer (org_Iname, org_Fname, org_Oname, org_phone, org_email, org_password) VALUES ('$org_Iname', '$org_Fname', '$org_Oname', '$org_phone', '$org_email', '$org_password')";

// Выполнение запроса
if ($mysqli->query($sql) === TRUE) {
    echo "Регистрация прошла успешно.";
} else {
    echo "Произошла ошибка во время регистрации";
}
}
}
// Закрытие соединения
$mysqli->close();
?>