<?php
// подключаемся к базе данных МК
$db = mysqli_connect('localhost', 'root', '', 'MK');
// Проверка подключения
if ($mysqli->connect_error) {
    echo "Ошибка подключения к серверу";
}
//существует ли данный ID
if (isset($_GET['MK_ID'])) {
    //получаем ID карточки, которую хотим удалить
    $MK_ID = $_GET['MK_ID'];
    // предупреждающее сообщение об удалении

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Удаление карточки</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <header>
            <?php include('header.php') ?>
        </header>

        <div class="text-center">

            <?php
            echo "<div class='kat_name'>Вы уверены, что хотите удалить эту карточку товара?</div>";
            //запрашиваем подстверждение
        
            echo "<br><h3><a href='delete_MK.php?confirm=yes&MK_ID=$MK_ID'>Да, удалить</a></h3><br>";
            echo "<h3><a href='katalog.php'>Отмена</a></h3>";
            ?>
        </div>
    </body>

    </html>
    <?php
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        // если пользователь подтвердил, то удаляем товар по MK_ID
        $query = "DELETE FROM Master_class WHERE MK_ID = '$MK_ID'";
        //проверка выполнен ли запрос
        if ($db->query($query) === TRUE) {
            echo "Карточка удалена успешно!";
        } else {
            echo "Ошибка при удалении карточки";
        }
    }
}
?>