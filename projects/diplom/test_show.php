<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестирование для пользователей</title>
</head>
<body>
    <div id="questionsContainer">
        <h2>В какой сфере вы хотели бы развиваться?</h2>
        <ul id="MK_category" name="MK_category">
            <li><input type="radio" name="questionType" value="text" id="text"> Творчество</li>
            <li><input type="radio" name="questionType" value="sport" id="text"> Спорт</li>
            <li><input type="radio" name="questionType" value="business" id="text"> Бизнес</li>
        </ul>
        <button onclick="showNextQuestion()">Далее</button>
    </div>

    <div id="priceContainer" style="display: none;">
        <h2>Укажите ваш бюджет</h2>
        <select id="MK_price">
            <option value="free">Бесплатно</option>
            <option value="1500">До 1,500 руб</option>
            <option value="more">От 1,500 и выше</option>
        </select>
        <button onclick="showNextQuestion()">Далее</button>
    </div>

    <div id="dateContainer" style="display: none;">
        <h2>Когда планируете посетить мастер-класс?</h2>
        <select id="MK_date">
            <option value="weekend">Ближайшие выходные</option>
            <option value="month">Ближайший месяц</option>
            <option value="anytime">В любое время</option>
        </select>
        <button onclick="showResults()">Перейти к результатам!</button>
    </div>

    <div id="resultsContainer" style="display: none;">
        <!-- Здесь будут отображаться результаты -->
    </div>

    <script>
        function showNextQuestion() {
            var currentQuestion = document.querySelector("#questionsContainer, #priceContainer, #dateContainer");
            currentQuestion.style.display = "none";

            var nextQuestion = currentQuestion.nextElementSibling;
            if (nextQuestion) {
                nextQuestion.style.display = "block";
            }
        }

        function showResults() {
            // Получить значения фильтров
            var category = document.querySelector('input[name="questionType"]:checked').value;
            var price = document.getElementById('MK_price').value;
            var date = document.getElementById('MK_date').value;

            // Выполнить запрос и отобразить результаты
            // Ваш код для отправки данных и отображения результатов здесь
        }
    </script>
</body>
</html>
