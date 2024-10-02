<?php
session_start();

//инициализируем переменные
$MK_name = "";
$MK_opisanie = "";
$MK_date = "";
$MK_location = "";
$MK_category = "";
$MK_price = "";
$seat_total = "";
$MK_image = "";
$errors = array();
$status = "";

// подключаемся к базе данных МК
$db = mysqli_connect('localhost', 'root', '', 'MK');
// Проверка подключения
if ($mysqli->connect_error) {
  echo "Ошибка подключения к серверу";
}


// СОЗДАНИЕ КАРТОЧКИ ТОВАРА (мастер класса)
//принимаем значение make_MK, которое передалось при отправке формы
if (isset($_POST['make_MK'])) {
  //получаем все входные значения из формы
  $MK_name = $_POST['MK_name'];
  $MK_opisanie = $_POST['MK_opisanie'];
  $MK_date = $_POST['MK_date'];
  $MK_location = $_POST['MK_location'];
  $MK_category = $_POST['MK_category'];
  $MK_price = $_POST['MK_price'];
  $seat_total = $_POST['seat_total'];
  $MK_image = $_POST['MK_image'];
  $org_ID = 2;


  //определяем папку для загрузки картинок
  $upload_dir = 'images_bd/';
  //генерируем уникальное имя для файла
  $unique_filename = uniqid();
  //формируем полный путь, который сохраним в БД
  $MK_image = $upload_dir . $unique_filename;

  //проверка загрузки изображения 
//move_uploaded_file - перемещен ли файл в указанное место (временный файл/имя, место куда надо перместить)
//$_FILES - суперглобальный массив ['MK_image - имя поля input']['tmp_name - временное имя файла на сервере']
  if (move_uploaded_file($_FILES['MK_image']['tmp_name'], $MK_image)) {
    //если успешно загружен, то сохраняем все данные карточки в БД 
    $query = "INSERT INTO Master_class (MK_name, MK_opisanie, MK_date, MK_location, MK_category, MK_price, seat_total, MK_image, org_ID) VALUES ('$MK_name', '$MK_opisanie', '$MK_date', '$MK_location', '$MK_category', '$MK_price', '$seat_total', '$MK_image', '$org_ID')";
    //проверка создана ли новая запись
    if ($db->query($query) === TRUE) {
      // echo "Карточка создана успешно!";
      $status = "<div class='box1'>Карточка создана успешно</div>";

    } else {
      $status = "<div class='box1' style='color:red;'>Ошибка во время создания карточки, попробуйте снова.</div>";
    }

  } else {
    $status = "<div class='box1' style='color:red;'>Ошибка загрузки изображения. Карточка не создана.</div>";
  }
}


//ИЗМЕНЕНИЕ ДАННЫХ В КАРТОЧКЕ ТОВАРА
//принимаем значение edit_card, которое передалось при отправке формы
if (isset($_POST['edit_card'])) {
  // получаем обновленные данные из формы
  $MK_name = $_POST['MK_name'];
  $MK_opisanie = $_POST['MK_opisanie'];
  $MK_date = $_POST['MK_date'];
  $MK_location = $_POST['MK_location'];
  $MK_category = $_POST['MK_category'];
  $MK_price = $_POST['MK_price'];
  $seat_total = $_POST['seat_total'];
  $MK_image = $_POST['MK_image'];
  echo "Что находится в MK_image:";
  echo $MK_image;



  //проверка загрузки изображения 
  //move_uploaded_file - перемещен ли файл в указанное место (временный файл/имя, место куда надо перместить)
  //$_FILES - суперглобальный массив ['MK_image - имя поля input']['tmp_name - временное имя файла на сервере']


  if (!empty($_FILES['MK_image']['name'])) {
    // Проверка, загружено ли новое изображение
    $upload_dir = 'images_bd/';
    $unique_filename = uniqid();
    $new_image_path = $upload_dir . $unique_filename;

    if (move_uploaded_file($_FILES['MK_image']['tmp_name'], $new_image_path)) {
      // Если успешно загружено новое изображение, обновляем путь к изображению
      $query = "UPDATE Master_class SET MK_name = '$MK_name', MK_opisanie = '$MK_opisanie', MK_date = '$MK_date', MK_location = '$MK_location', MK_category = '$MK_category', MK_price = '$MK_price', seat_total = '$seat_total', MK_image = '$new_image_path' WHERE MK_ID = '$MK_ID'";

      if ($db->query($query) === TRUE) {
        $status = "<div class='box1'>Данные успешно обновлены, включая изображение!</div>";
      } else {
        $status = "<div class='box1' style='color:red;'>Ошибка во время обновления данных и изображения.</div>";
      }
    } else {
      $status = "<div class='box1' style='color:red;'>Ошибка во время загрузки нового изображения.</div>";
    }
  } else {
    // Если изображение не было изменено, обновляем только текстовые данные
    $query = "UPDATE Master_class SET MK_name = '$MK_name', MK_opisanie = '$MK_opisanie', MK_date = '$MK_date', MK_location = '$MK_location', MK_category = '$MK_category', MK_price = '$MK_price', seat_total = '$seat_total' WHERE MK_ID = '$MK_ID'";

    if ($db->query($query) === TRUE) {
      $status = "<div class='box1'>Данные успешно обновлены, без изменений в изображении.</div>";
    } else {
      $status = "<div class='box1' style='color:red;'>Ошибка во время обновления данных без изменений в изображении.</div>";
    }
  }

}

?>