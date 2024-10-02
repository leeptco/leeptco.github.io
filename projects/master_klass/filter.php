<?php 
$mysqli = new mysqli("localhost", "root", "", "MK"); 
// Проверка подключения 
if ($mysqli->connect_error) { 
    echo "Ошибка подключения к БД"; 
} 

$MK_category = $_POST['MK_category']; 
$MK_price = $_POST['MK_price']; 
$MK_date = $_POST['MK_date']; // Добавленная переменная даты
$currentDate = $_POST['currentDate']; // Переданная текущая дата

$sql = "SELECT * FROM Master_class WHERE 1"; 

if($MK_category != 'all') { 
    $sql .= " AND MK_category = '$MK_category'"; 
} 

if($MK_price != 'all') { 
    $MK_price = explode('-', $MK_price); 
    $min = $MK_price[0]; 
    $max = $MK_price[1]; 
    $sql .= " AND MK_price >= '$min' AND MK_price <= '$max'"; 
} 

if ($MK_date == 'weekend') { // Если выбраны ближайшие выходные
    $nextSaturday = date('Y-m-d', strtotime('next Saturday', strtotime($currentDate)));
    $nextSunday = date('Y-m-d', strtotime('next Sunday', strtotime($currentDate)));
    $sql .= " AND MK_date BETWEEN '$nextSaturday' AND '$nextSunday'";
} elseif ($MK_date == 'month') { // Если выбран ближайший месяц
    $nextMonth = date('Y-m-d', strtotime('+1 month', strtotime($currentDate)));
    $sql .= " AND MK_date BETWEEN '$currentDate' AND '$nextMonth'";
}

$result = mysqli_query($mysqli, $sql); 

while($row = mysqli_fetch_assoc($result)) { 
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
      <button type='submit' class='btn btn-primary katalog_btn'>Забронировать</button> 
      <br> 
      </form> 
         </div> 
      </div>"; 
} 
if ($result->num_rows === 0) {
  $status = "По вашему запросу нет мастер-классов";
}
?>







