<?php
//запуск механизма сессий 
session_start();
$client_ID = $_SESSION['client_ID'];
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>MASTER-CLASS.RU</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <header>
        <?php include('header.php') ?>
    </header>

    <!-- Main content -->

    <intro>
        <div class="section">
            <div class="container">
                <div class="intro_box ">
                    <div class="row">
                        <div class="intro_inner col-xl-6 col-md-12 col-sm-12">
                            <div class="intro_text">
                                занимайтесь тем,
                                <br> чем нравится!
                            </div>
                            <button type="button" class="btn btn-outline-primary btn_intro">вязание</button>
                            <button type="button" class="btn btn-outline-primary btn_intro">флористика</button>
                            <button type="button" class="btn btn-outline-primary btn_intro">керамика</button>
                            <button type="button" class="btn btn-outline-primary btn_intro">рисование</button>
                            <!-- <br> -->
                            <button type="button" class="btn btn-outline-primary btn_intro">фотография</button>
                            <button type="button" class="btn btn-outline-primary btn_intro">кулинария</button>
                            <button type="button" class="btn btn-outline-primary btn_intro">танцы</button>
                            <button type="button" class="btn btn-outline-primary btn_intro">все мероприятия</button>
                        </div>

                        <div class="intro_img col-xl-6 col-md-12 col-sm-12 ">
                            <img class="" src="img/mk_intro_kitchen.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </intro>

    <a name="katalog"></a>
    <katalog>
        <div class="section">
            <div class="container">
                <div class="col-12">
                    <div class="kat_name text-uppercase text-center">
                        популярные мастер-классы
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5">
                    <div class="col">
                        <div class="card h-100 text-center">
                            <img src="img/cake.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Декор торта</h5>
                                <p class="card-text">Мероприятия расчитано на обучение новым и необычным техникам
                                    декорирования тортов </p>
                                <a href="katalog.php" class="btn btn-primary">Подробнее/Забронировать</a>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 text-center">
                            <img src="img/draw.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Картина маслом</h5>
                                <p class="card-text">Нарисуйте картину своими руками за 2,5 часа! Пройдите путь от
                                    задумки до готового шедевра под присмотром профессионала.</p>
                                <a href="katalog.php" class="btn btn-primary">Подробнее/Забронировать</a>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 text-center">
                            <img src="img/keramika.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Керамика</h5>
                                <p class="card-text">На мастер-классе по гончарному делу Вы сделаете свое собственное
                                    изделие из глины: кружку, вазу, тарелку или подсвечник — мы не ограничиваем в идеях!
                                </p>
                                <a href="katalog.php" class="btn btn-primary">Подробнее/Забронировать</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </katalog>

    <a name="about_us"></a>
    <about_us>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="about_box">
                            <div class="about_name text-center text-uppercase">
                                о нас
                            </div>
                            <div class="about_text">
                                <p></p>
                                      Приветствуем вас на нашей платформе!

Мы специализируемся на поддержке и продвижении малого бизнеса, помогая вам распространять информацию о ваших уникальных мастер-классах. Наша цель — создать пространство, где творческие и увлеченные люди могут легко находить и записываться на интересующие их мероприятия.

Если вы хотите разместить свои мастер-классы на нашей платформе, регистрируйтесь на нашей платформе и выкладывайте свои мастер-классы! Мы с удовольствием поможем вам рассказать о своих навыках и увлечениях широкой аудитории.

Мы любим и ценим творческих людей!                            

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </about_us>

    <footer>
        <div class="section">
            <nav class="navbar navbar-dark bg-dark navbar-expand-md">
                <a href="#" class="navbar-logo">MASTER-CLASS</a>
                <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="navbar-nav footer_ul_li">
                        <li class="nav-item text-uppercase"><a href="index.html#about_us" class="footer-link">о нас</a>
                        </li>
                        <li class="nav-item text-uppercase"><a href="katalog.php" class="footer-link">каталог</a></li>
                        <li class="nav-item text-uppercase"><a href="login_client.php" class="footer-link">личный
                                кабинет покупателя</a></li>
                        <li class="nav-item text-uppercase"><a href="login_organizer.php" class="footer-link">личный
                                кабинет организатора</a></li>
                        <li class="nav-item text-uppercase"><a href="cart.php" class="footer-link">корзина</a></li>
                    </ul>
                </div>
                <div class="pochta">
                    <p class="pochta_text">Остались вопросы? Напишите свою почту</p>
                    <form class="d-flex">
                        <input class="form-control pochta_form" type="search" placeholder="Введите e-mail..."
                            aria-label="Search">
                        <button class="btn btn-outline-success pochta_button" type="submit">Отправить</button>
                    </form>
                </div>
            </nav>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>