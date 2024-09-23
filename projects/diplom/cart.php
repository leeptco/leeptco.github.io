<?php
session_start();
$client_ID = $_SESSION['client_ID'];
$status = "";

if ($_POST['action'] == "remove") {
	if (!empty($_SESSION["shopping_cart"])) {
		foreach ($_SESSION["shopping_cart"] as $key => $value) {
			if ($_POST["MK_ID"] == $key) {
				unset($_SESSION["shopping_cart"][$key]);
				$status = "<div class='box' style='color:red;'>
		Продукт удален из корзины!</div>";
			}
			if (empty($_SESSION["shopping_cart"]))
				unset($_SESSION["shopping_cart"]);
		}
	}
}

if (isset($_POST['action']) && $_POST['action'] == "change") {
	foreach ($_SESSION["shopping_cart"] as &$value) {
		if ($value['MK_ID'] === $_POST["MK_ID"]) {
			$value['quantity'] = $_POST["quantity"];
			break; // Stop the loop after we've found the product
		}
	}

}
?>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<title>Корзина</title>
	<link rel='stylesheet' href='css/style.css'>
</head>

<body>
	<header>
		<?php include('header.php') ?>
	</header>
	<div class="section">
		<div class="container">

			<!-- <h2>Корзина</h2> -->
			<div class="kat_name text-center text-uppercase">
				Корзина
			</div>
			<div class="cart">

				<?php
				if (isset($_SESSION["shopping_cart"])) {
					$total_price = 0;
					?>
					<table class="table">
						<tbody>
							<tr>
								<td></td>
								<td>Название мастер-класса</td>
								<td>Количество бронируемых мест</td>
								<td>Цена бронирования, шт.</td>
								<td>Общая стоимость</td>
							</tr>
							<?php
							foreach ($_SESSION["shopping_cart"] as $product) {
								?>
								<tr>
									<td><img src='<?php echo $product["MK_image"]; ?>' width="50" height="50" /></td>
									<td>
										<?php echo $product["MK_name"]; ?><br />
										<form method='post' action=''>
											<input type='hidden' name='MK_ID' value="<?php echo $product["MK_ID"]; ?>" />
											<input type='hidden' name='action' value="remove" />
											<button type='submit' class='remove' style='color: red;'>Удалить из корзины</button>
										</form>
									</td>
									<td>
										<form method='post' action=''>
											<input type='hidden' name='MK_ID' value="<?php echo $product["MK_ID"]; ?>" />
											<input type='hidden' name='action' value="change" />
											<select name='quantity' class='quantity' onchange="this.form.submit()">
												<option <?php if ($product["quantity"] == 1)
													echo "selected"; ?> value="1">1
												</option>
												<option <?php if ($product["quantity"] == 2)
													echo "selected"; ?> value="2">2
												</option>
												<option <?php if ($product["quantity"] == 3)
													echo "selected"; ?> value="3">3
												</option>
												<option <?php if ($product["quantity"] == 4)
													echo "selected"; ?> value="4">4
												</option>
												<option <?php if ($product["quantity"] == 5)
													echo "selected"; ?> value="5">5
												</option>
											</select>
										</form>
									</td>
									<td>
										<?php echo $product["MK_price"] . " руб."; ?>
									</td>
									<td>
										<?php echo $product["MK_price"] * $product["quantity"] . " руб."; ?>
									</td>
								</tr>
								<?php
								$total_price += ($product["MK_price"] * $product["quantity"]);
							}
							?>
							<tr>
								<td colspan="5" align="right">
									<strong>ИТОГО:
										<?php echo $total_price . " руб."; ?>
									</strong>
								</td>
							</tr>
						</tbody>
					</table>


					<form method="post" action="checkout.php">
						<input type="hidden" name="action" value="buy_MK">
						<input type="hidden" name="MK_ID" value="<?php echo $product['MK_ID']; ?>">
						<input type="hidden" name="quantity" value="<?php echo $product['quantity']; ?>">
						<input type="hidden" name="MK_price" value="<?php echo $product['MK_price']; ?>">
						<input type="hidden" name="total_price"
							value="<?php echo $product['MK_price'] * $product['quantity']; ?>">
						<input type="submit" name="buy_MK" class="btn btn-primary" value="Купить">
					</form>



					<?php
				} else {
					echo "<h3>Упс! Ваша корзина пустая</h3>";
				}
				?>
			</div>

			<div style="clear:both;"></div>

			<div>
				<?php echo $status; ?>
			</div>
			<p></p>
			<?php
				if (empty($client_ID)) {
					?> 
					<a href="katalog.php">Вернуться в каталог</a>
					<?php
				}
				else {
					?> 
					<a href="katalog.php?client_ID=<?php echo $client_ID; ?>">Вернуться в каталог</a>
					<?php
				}
			?>
			
		</div>
	</div>
</body>

</html>

<?php
// Проверка, была ли нажата кнопка "Купить"
if (isset($_POST['buy_MK'])) {
	// Убедимся, что корзина не пуста
	if (!empty($_SESSION["shopping_cart"])) {
		// Открываем подключение к базе данных
		$mysqli = new mysqli("localhost", "root", "", "MK");

		// Проверка подключения
		if ($mysqli->connect_error) {
			die("Ошибка подключения: " . $mysqli->connect_error);
		}

		// Получение идентификаторов покупателя и организатора (здесь нужно заменить 'client_ID' и 'org_ID' на реальные значения)
		$org_ID = 2;     // Здесь нужно указать реальный идентификатор организатора

		// Создаем SQL-запрос для вставки данных о покупке в таблицу Date_of_payment
		$sql = "INSERT INTO Date_of_payment (buydate, buydate_count_client, buydate_summa, buydate_status, client_ID, org_ID, MK_ID) VALUES (NOW(), ?, ?, ?, ?, ?, ?)";

		// Подготавливаем запрос
		$stmt = $mysqli->prepare($sql);

		// Перебираем товары в корзине и добавляем их в таблицу Date_of_payment
		foreach ($_SESSION["shopping_cart"] as $product) {
			$buydate = date("Y-m-d H:i:s");  // Текущая дата и время
			$count_client = $product["quantity"];
			$summa = $product["MK_price"] * $count_client;
			$status = "Оплачено"; // Здесь можно уточнить статус платежа

			// Биндим параметры к подготовленному запросу
			$stmt->bind_param("sddsiis", $buydate, $count_client, $summa, $status, $client_ID, $org_ID, $product["MK_ID"]);

			// Выполняем запрос
			$stmt->execute();
		}

		// Закрываем подготовленное выражение и соединение с базой данных
		$stmt->close();
		$mysqli->close();

		// Очищаем корзину
		unset($_SESSION["shopping_cart"]);

		// Редирект на личный кабинет с сообщением об успешной покупке
		header("Location: lk_customer.php?success=1");
		exit;
	} else {
		// Если корзина пуста, вы можете вывести сообщение об этом
		// или выполнить другие действия в соответствии с вашими требованиями
		header("Location: lk_customer.php?empty_cart=1");
		exit;
	}
}
?>