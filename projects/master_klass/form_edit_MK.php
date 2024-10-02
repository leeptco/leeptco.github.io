<?php
// получаем ID карточки, которую хотим редактировать
$MK_ID = $_GET['MK_ID'];
// Подключаем файл с соединением к БД
include('server.php');
// Получаем данные карточки из БД
//выбираем все поля записи, находим по ID
$result = mysqli_query($db, "SELECT * FROM Master_class WHERE MK_ID = '$MK_ID'");
//если есть хоть одна запись
if (mysqli_num_rows($result) > 0) {
    //извлечение и сохранение данных в ассоциативный массив $row
    $row = mysqli_fetch_assoc($result); ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Редактирование карточки</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <header>
            <?php include('header.php') ?>
        </header>

        <div class="section">
            <div class="container">
                <div class="kat_name text-center text-uppercase">
                    Редактирование карточки
                </div>

                <div class="">
                    <!-- организатор заполняет форму для редактирования и данные отправляются на сервер -->
                    <form method="post" action="" enctype="multipart/form-data">
                        <!-- Поля для редактирования данных -->
                        Название:
                        <input type="text" name="MK_name" class="form-control form-control-lg form_make_MK"
                            value="<?php echo $row['MK_name']; ?>"><br>
                        Описание мастер-класса:
                        <input type="text" name="MK_opisanie" class="form-control form-control-lg form_make_MK"
                            value="<?php echo $row['MK_opisanie']; ?>"><br>
                        Дата проведения:
                        <input type="date" name="MK_date" class="form-control form-control-lg form_make_MK"
                            value="<?php echo $row['MK_date']; ?>"><br>
                        Место проведения:
                        <input type="text" name="MK_location" class="form-control form-control-lg form_make_MK"
                            value="<?php echo $row['MK_location']; ?>"><br>
                        Категория мастер-класса:
                        <input type="text" name="MK_category" class="form-control form-control-lg form_make_MK"
                            value="<?php echo $row['MK_category']; ?>"><br>

                     
          <select name="MK_category" class="form-control form-control-lg form_make_MK">
            <option value="knit">Вязание</option>
            <option value="flower">Флористика</option>
            <option value="ceramic">Керамика</option>
            <option value="draw">Рисование</option>
            <option value="photo">Фотография</option>
            <option value="cook">Кулинария</option>
            <option value="dance">Танцы</option>
            <option value="sport">Спорт</option>
            <option value="business">Бизнес</option>
            <option value="another">Другое</option>
          </select>


                        Стоимость участия в мастер-классе:
                        <input type="number" name="MK_price" class="form-control form-control-lg form_make_MK"
                            value="<?php echo $row['MK_price']; ?>"><br>
                        Максимальное количетсво мест:
                        <input type="number" name="seat_total" class="form-control form-control-lg form_make_MK"
                            value="<?php echo $row['seat_total']; ?>"><br>
                        <div class="image"><img src="<?php echo $row['MK_image'] ?>" /></div>
                        Вставьте новую фотографию, если вы хотите ее изменить
                        <input type="file" name="MK_image" class="form-control form-control-lg form_make_MK"
                            value="<?php echo $row['MK_image']; ?>"><br>
                        <input type="submit" name="edit_card" class="button_registration" style="margin-left: 38%;"
                            value="Сохранить">
                    </form>
                </div>
            </div>
            <?php echo $status; ?>

        </div>
    </body>

    </html>
    <?php
} else {
    // если карточка с указанным ID не найдена
    echo "Карточка не найдена";
}
?>