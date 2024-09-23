<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Регистрация организатора</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<header>
    <?php include ('header.php')?>
</header>

    <registration>
        <div class="section">
            <div class="container registration_container">
                <div class="registration_name text-center text-uppercase">
                    регистрация организатора
                </div>
                <form action="register.php" method="post" class="text-center">
                  
                        <input type="text" class="form-control form-control-lg registration_form"
                             name="org_Iname" placeholder="Введите имя" required><br>
                             <input type="text" class="form-control form-control-lg registration_form"
                             name="org_Fname" placeholder="Введите фамилию" required><br>
                             <input type="text" class="form-control form-control-lg registration_form"
                             name="org_Oname" placeholder="Введите отчество" required><br>
                             <input type="text" class="form-control form-control-lg registration_form"
                             name="org_phone" placeholder="Введите номер телефона" required><br>
                        <input type="email" class="form-control form-control-lg registration_form"
                             name="org_email" placeholder="Введите email" required><br>
                  
                        <input type="password" class="form-control form-control-lg registration_form"
                        name="org_password" placeholder="Введите пароль" required><br>
            
                        <button type="submit" class="btn mb-3 button_registration" name="registration_organizer" style="border: 2px solid var(--color2);">Зарегистрироваться</button>
                    

                    <div class="text-center">
                        Уже зарегистрированы в качестве организатора? 
                        <a href="login_organizer.php">Войдите</a>
                    </div>
                </form>
            </div>
        </div>
    </registration>
</body>
</html>
