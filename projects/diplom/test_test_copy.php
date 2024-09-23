<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестирование для пользователей</title>
</head>
<body>
    <form id="questionsForm">
        <div id="questionsContainer">
            <h2>В какой сфере вы хотели бы развиваться?</h2>
            <ul id="MK_category" name="MK_category">
                <li><input type="radio" name="MK_category" value="text" id="text"> Творчество</li>
                <li><input type="radio" name="MK_category" value="sport" id="sport"> Спорт</li>
                <li><input type="radio" name="MK_category" value="business" id="business"> Бизнес</li>
            </ul>
            <button onclick="showNextQuestion()">Далее</button>
        </div>

        <div id="priceContainer" style="display: none;">
            <h2>Укажите ваш бюджет</h2>
            <ul id="MK_price" name="MK_price">
                <li><input type="radio" name="MK_price" value="0" id="0"> Бесплатно</li>
                <li><input type="radio" name="MK_price" value="0-1500" id="0-1500"> До 1,500 руб</li>
                <li><input type="radio" name="MK_price" value="1500-100000" id="1500-100000"> От 1,500 и выше</li>
            </ul>
            <button onclick="showNextQuestion()">Далее</button>
        </div>

        <div id="dateContainer" style="display: none;">
            <h2>Когда планируете посетить мастер-класс?</h2>
            <select id="MK_date" name="MK_date">
                <option value="weekend">Ближайшие выходные</option>
                <option value="month">Ближайший месяц</option>
                <option value="anytime">В любое время</option>
            </select>
            <button onclick="showResults()">Перейти к результатам!</button>
        </div>
    </form>

    <div id="resultsContainer" style="display: none;">
        <!-- Здесь будут отображаться результаты -->
    </div>

    <div id="noResultsMessage" style="display: none; color: red;">По вашим запросам не найдено мероприятий</div>

    <script>
        function showNextQuestion(event) {
            
            var currentQuestion = document.querySelector("#questionsContainer, #priceContainer, #dateContainer");
            currentQuestion.style.display = "none";

            var nextQuestion = currentQuestion.nextElementSibling;
            if (nextQuestion) {
                nextQuestion.style.display = "block";
            }
        }

        document.getElementById('questionsForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Предотвращаем отправку формы
            showResults(); // Отображаем результаты
        });

        function showResults() {
            var formData = new FormData(document.getElementById('questionsForm'));
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('resultsContainer').innerHTML = xhr.responseText;
                }
            };
            xhr.open('POST', 'filter.php', true);
            xhr.send(formData);
        }
    </script>
</body>
</html>
