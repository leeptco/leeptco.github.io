<?php

//запуск механизма сессий 
session_start();
$client_ID = $_SESSION['client_ID'];

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


//проверка конкретного ID, к-ый пользователь добавляет в корзину
if (isset($_POST['MK_ID']) && $_POST['MK_ID'] != "") {
	$MK_ID = $_POST['MK_ID'];
	//выборка из БД по ID
	$result = mysqli_query($db, "SELECT * FROM `Master_class` WHERE `MK_ID`='$MK_ID'");
	//извлечение и сохранение данных в ассоциативный массив $row
	$row = mysqli_fetch_assoc($result);
	$MK_name = $row['MK_name'];
	$MK_ID = $row['MK_ID'];
	$MK_opisanie = $row['MK_opisanie'];
	$MK_date = $row['MK_date'];
	$MK_price = $row['MK_price'];
	$MK_image = $row['MK_image'];

	//массив для товара, к-ый хотим добавить в корзину
	$cartArray = array(
		$MK_ID => array(
			//ключ массива
			'MK_name' => $MK_name,
			//ключ - значение
			'MK_ID' => $MK_ID,
			'MK_opisanie' => $MK_opisanie,
			'MK_date' => $MK_date,
			'MK_price' => $MK_price,
			'quantity' => 1,
			//начальное количество товара в корзине
			'MK_image' => $MK_image
		)
	);

	//проверка, если ли у пользователя товар в корзине или она пуста
	if (empty($_SESSION["shopping_cart"])) {
		//присваиваем корзине массив (информацию о товаре)
		$_SESSION["shopping_cart"] = $cartArray;
		$status = "<div class='box'>Мастер-класс добавлен в корзину!</div>";
	} else {
		$array_keys = array_keys($_SESSION["shopping_cart"]);
		if (in_array($MK_ID, $array_keys)) {
			$status = "<div class='box' style='color:red;'>
		Мастер-класс уже находится в вашей корзине!</div>";
		} else {
			$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
			$status = "<div class='box'>Мастер-класс ОПЯТЬ добавлен в корзину!</div>";
		}
	}
}
?>


<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<title>Каталог товаров</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<header>
		<?php include('header.php') ?>
	</header>

	<div class="section">
		<div class="container">

			<div class="kat_name text-uppercase text-center">
				Каталог мастер-классов
			</div>

			<form id="filterForm">
				<select id="MK_category" name="MK_category">
					<option value="all">Все</option>
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
				<select id="MK_price" name="MK_price">
					<option value="all">Все</option>
					<option value="0-1000">0 - 1000 руб.</option>
					<option value="1000-2000">1000 руб. - 2000 руб.</option>
					<option value="2000-5000">2000 руб. - 5000 руб.</option>
					<option value="5000-100000">от 5000 руб.</option>
				</select>
				<select id="MK_date" name="MK_date">
					<option value="any">Любая дата</option>
					<option value="weekend">Ближайшие выходные</option>
					<option value="month">Ближайший месяц</option>
				</select>
				<input type="button" value="Filter" onclick="applyFilter()" class="button_filter">
			</form>
			<br> <br>

			<div class='row row-cols-1 row-cols-md-3 g-4' id="productsContainer"></div>

			<script>
				// Загрузка карточек при загрузке страницы
				window.onload = function () {
					applyFilter();
				};

				function applyFilter() {
					// Получить значения фильтров 
					var category = document.getElementById('MK_category').value;
					var price = document.getElementById('MK_price').value;
					var date = document.getElementById('MK_date').value;

					// Получить текущую дату
					var today = new Date();
					var year = today.getFullYear();
					var month = today.getMonth() + 1; // Добавляем 1, так как месяцы в JavaScript нумеруются с 0
					var day = today.getDate();
					// Преобразуем дату в формат "yyyy-mm-dd"
					var currentDate = year + '-' + month + '-' + day;

					// Выполнить асинхронный запрос 
					var xhr = new XMLHttpRequest();
					xhr.onreadystatechange = function () {
						if (xhr.readyState === 4 && xhr.status === 200) {
							// Обработать полученные данные и отобразить на странице 
							document.getElementById('productsContainer').innerHTML = xhr.responseText;
						}
					};

					// Подготовить данные для отправки 
					var data = 'MK_category=' + category + '&MK_price=' + price + '&MK_date=' + date + '&currentDate=' + currentDate;

					// Отправить запрос методом POST на ваш серверный скрипт 
					xhr.open('POST', 'filter.php', true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhr.send(data);
				} 
			</script>
		</div>

		<div>
			<?php echo $status; ?>
		</div>

		<br><br><br><br><br>
	</div>
	</div>
</body>

</html>