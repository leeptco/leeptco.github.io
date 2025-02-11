function stealBalls(balls, bagCapacity) {
    const totalBalls = balls.reduce((sum, count) => sum + count, 0);
    const numColors = balls.length;

    // Если вместимость мешка больше или равна количеству всех шариков - он крадет все шарики
    if (bagCapacity >= totalBalls) {
        return [...balls]; // Вор забирает все шары
    }

    // Ели вместимость мешка больше количества цветов, то выдает как минимум 1 шарик каждого цвета
    //пример теста: вместимость: 4. Массив из шариков: 20 10 30 15. Программа выдаст 1 1 1 1
    let stolen = new Array(numColors).fill(0);
    let remainingCapacity = bagCapacity;

    if (bagCapacity >= numColors) {
        stolen.fill(1);
        remainingCapacity -= numColors;
    }

    // Пропорционально распределяем оставшиеся шары
    let adjustedBalls = balls.map((count, index) => count - stolen[index]);
    let adjustedTotal = adjustedBalls.reduce((sum, count) => sum + count, 0);

    if (remainingCapacity > 0 && adjustedTotal > 0) {
        let proportionalSteal = adjustedBalls.map(count => (count / adjustedTotal) * remainingCapacity);
        let losses = proportionalSteal.map((value, index) => ({
            index,
            loss: value - Math.floor(value)
        }));

        // Округляем вниз с помощью функции Math.floor
        proportionalSteal = proportionalSteal.map(value => Math.floor(value));
        let totalProportionalStolen = proportionalSteal.reduce((sum, count) => sum + count, 0);

        // Если надо добрать шары, то корректируем округления
        let missingBalls = remainingCapacity - totalProportionalStolen;
        losses.sort((a, b) => b.loss - a.loss);

        for (let i = 0; i < missingBalls; i++) {
            proportionalSteal[losses[i % losses.length].index]++;
        }

        // Добавляем перераспределённые шарики к минимальным
        stolen = stolen.map((count, index) => count + proportionalSteal[index]);
    }

    return stolen;
}



//функция для сбора и обработки введеных данных через форму input на странице
function calculateTheft() {
    // Получаем введённые данные
    let bagCapacity = parseInt(document.getElementById("bagCapacity").value, 10);
    let ballsInput = document.getElementById("ballsInput").value.trim();

    // Преобразуем введённые данные в массив из чисел
    let balls = ballsInput.split(" ").map(num => parseInt(num, 10)).filter(num => !isNaN(num));

    // Проверяем корректность ввода
    if (isNaN(bagCapacity) || bagCapacity <= 0 || balls.length === 0) {
        document.getElementById("result").innerText = "Ошибка: Проверьте введенные данные!";
        return;
    }

    // Выполняем расчёт
    let result = stealBalls(balls, bagCapacity);

    // Выводим результат на страницу
    document.getElementById("result").innerText = "Украденные шарики: " + result.join(" ");
}