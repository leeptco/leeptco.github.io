<!-- подключем файл соединения с сервером -->
<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Создание мастер-класса</title>
</head>

<body>
  <header>
    <?php include('header.php') ?>
  </header>

  <div class="section">
    <div class="container">
      <div class="kat_name text-center text-uppercase">
        Создание карточки мастер-класса
      </div>
      <div class="form_make_MK1">
        <!-- заполняем данные и отправляем на сервер для обработки-->
        <form action="" method="post" enctype="multipart/form-data">
          <?php include('errors.php'); ?>
          <label for="MK_name">Название мастер-класса:</label>
          <input type="text" name="MK_name" placeholder="Введите название МК"
            class="form-control form-control-lg form_make_MK" required><br>
          <label for="MK_opisanie">Описание мастер-класса:</label>
          <input type="text" name="MK_opisanie" placeholder="Введите описание"
            class="form-control form-control-lg form_make_MK" required><br>
          <label for="MK_date">Дата проведения мастер-класса:</label>
          <input type="date" name="MK_date" placeholder="Дата проведения"
            class="form-control form-control-lg form_make_MK" required><br>
          <label for="MK_location">Место проведения мастер-класса (улица, дом и, например, название студии):</label>
          <input type="text" name="MK_location" placeholder="Введите адрес"
            class="form-control form-control-lg form_make_MK" required><br>

          <label for="MK_category">Категория мастер-класса:</label>
          <select name="MK_category" class="form-control form-control-lg form_make_MK mb-4">
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
          <label for="MK_price">Стоимость мастер-класса:</label>
          <input type="number" name="MK_price" placeholder="Введите стоимость мастер-класса"
            class="form-control form-control-lg form_make_MK" required><br>
          <label for="seat_total">Количество мест на мастер-класс:</label>
          <input type="number" name="seat_total" placeholder="Введите максимальное количество мест на мастер-класс"
            class="form-control form-control-lg form_make_MK" required><br>
          Вставьте фотографию в формате JPG
          <input type="file" name="MK_image" class="form-control form-control-lg form_make_MK" required><br>
          <div class="text-center">
            <input type="submit" value="Создать карточку" name="make_MK" class="btn mb-6 button_registration">
          </div>
        </form>
      </div>
    </div>
    <?php echo $status; ?>
  </div>

</body>

</html>