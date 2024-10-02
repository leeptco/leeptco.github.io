<?php

//запуск механизма сессий 
session_start();
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

?>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Работа с карточками товаров</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<header>
		<?php include('header.php') ?>
	</header>

	<div class="section">
		<div class="container">

			<div class="kat_name text-uppercase text-center">
				Ваши мастер-классы
			</div>
			<div class='row row-cols-1 row-cols-md-3 g-4'>
				<?php
				$result = mysqli_query($db, "SELECT * FROM `Master_class`");
				while ($row = mysqli_fetch_assoc($result)) {
					echo " 
			<div class='col'> 
			<div class='card text-center h-100' >
			
			  <form method='post' action=''>
			  <input type='hidden' name='MK_ID' value=" . $row['MK_ID'] . " />
			  
			  <div class='image'><img class='card-img-top' style='width:250px;' src='" . $row['MK_image'] . "' /></div>

			  <div class='card-title'>" . $row['MK_name'] . "</div>
			  <div class='card-text'>" . $row['MK_opisanie'] . "</div>
			  <div class='date'>Дата проведения: " . $row['MK_date'] . "</div>
		   	  <div class='price'>" . $row['MK_price'] . " руб.</div>
			  <div class='ssilka'>
			  <a href='form_edit_MK.php?MK_ID=" . $row['MK_ID'] . "'>Редактировать</a>
			  <br>
			  <a class='work_with_card_delete' href='delete_MK.php?MK_ID=" . $row['MK_ID'] . "'>Удалить</a>
			  </div>

			  </form>
		   	  </div>
			  </div>";
				}
				mysqli_close($db);
				?>
			</div>
			<br><br><br><br>
		</div>
	</div>
</body>

</html>