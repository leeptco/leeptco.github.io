<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Регистрация покупателя</title>
</head>

<body>
    <header>
        <?php include('header.php') ?>
    </header>

    <registration>
        <div class="section">
            <div class="container registration_container">
                <div class="registration_name text-center text-uppercase">
                    регистрация покупателя
                </div>
                <form action="register.php" method="post">
                    <input type="text" class="form-control form-control-lg registration_form" name="client_Iname"
                        placeholder="Введите имя" required><br>
                    <input type="text" class="form-control form-control-lg registration_form" name="client_Fname"
                        placeholder="Введите фамилию" required><br>
                    <input type="text" class="form-control form-control-lg registration_form" name="client_phone"
                        placeholder="Введите номер телефона" required><br>
                    <input type="email" class="form-control form-control-lg registration_form" name="client_email"
                        placeholder="Введите email" required><br>
                    <input type="password" class="form-control form-control-lg registration_form" name="client_password"
                        placeholder="Введите пароль" required><br>
                    <div class="text-center">
                        <button type="submit" class="btn mb-3 button_registration"
                            style="border: 2px solid var(--color2);"
                            name="registration_client">Зарегистрироваться</button>
                    </div>

                    <div class="text-center">
                        Уже зарегистрированы?
                        <a href="login_client.php">Войдите</a>
                    </div>
                </form>
            </div>
        </div>
    </registration>
</body>

</html>