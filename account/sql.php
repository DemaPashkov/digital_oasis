<?php

include 'header.php';
require_once('../php/bd.php');

if (isset($_SESSION['login_user'])) {

    $user_check = $_SESSION['login_user'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
    $rows = mysqli_fetch_array($query);
    $names = $rows['name'];
    $status = $rows['admin'];

} else {
    header('Location index.php');
}
?>
 <link rel='stylesheet' href='../css/style.css'> 

<section class="sql-zaprosi-section">

<div class="sql-zaprosi">
<h2>SQL - Запросы</h2>
<h4>1. Получить список и общее число оборудования определенного типа, с  определенными характеристиками.</h4>

<?php
require_once('../php/bd.php');
$sql = "SELECT name, COUNT(*) AS quantity FROM resources GROUP BY name;";
$result = mysqli_query($conn, $sql);

echo '<table>
<thead>
<tr>
<th>Оборудования</th>
<th>Количество</th>
</tr>
</thead>
<tbody>';
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $quantity = $row['quantity'];
    echo "<tr><td>" . $name . "</td><td>" .  $quantity . "</td></tr>";
}
echo '</table>';
}

?>
<br>
<h4>2.Получить список всех клиентов, зарегистрированных в компьютерном клубе. </h4>

<?php
$sql = "SELECT * FROM users;";
$result = mysqli_query($conn, $sql);
echo '<table>
<thead>
<tr>
<th>Id</th>
<th>Фамилия</th>
<th>Имя</th>
<th>Отчество</th>
</tr>
</thead>
<tbody>';
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $surname = $row['surname'];
    $name = $row['name'];
    $otchestvo = $row['otchestvo'];
    echo "<tr><td>" . $id . "</td><td>" .  $surname . "</td><td>" .  $name . "</td><td>" .  $otchestvo . "</td></tr>";
}
echo '</table>';
}
?>

<br>
<h4>3. Получить список всех игр, доступных в клубе.</h4>

<?php
$sql = "SELECT name FROM games;";
$result = mysqli_query($conn, $sql);
echo '<table>
<thead>
<tr>
<th>Наименование</th>
</tr>
</thead>
<tbody>';
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    echo "<tr><td>" . $name . "</td></tr>";
}
echo '</table>';
}
?>
<br>
<h4>4.Получить список и общее число компьютерных мест, которые оснащены  определённым типом оборудования.</h4>
<?php

$sql = "SELECT name, COUNT(*) AS quantity FROM computer_schedule JOIN resources ON computer_schedule.id = resources.id GROUP BY name;";
$result = mysqli_query($conn, $sql);
echo '<table>
<thead>
<tr>
<th>Наименование</th>
<th>Место</th>
</tr>
</thead>
<tbody>';
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $quantity = $row['quantity'];
    echo "<tr><td>" . $name . "</td><td>" . $quantity . "</td></tr>";
}
echo '</table>';
}
?>

<br>
<h4>5. Получить список посетителей, которые выбрали ночной тариф, место  определенного класса</h4>

<?php

$sql = "SELECT users.name FROM visits JOIN users ON visits.user_id = users.id JOIN computer_reservation ON visits.id = computer_reservation.id JOIN computer_schedule ON computer_reservation.computer_schedule_id = computer_schedule.id WHERE computer_schedule.class = 'Night';";
$result = mysqli_query($conn, $sql);
echo '<table>
<thead>
<tr>
<th>Наименование</th>
<th>Место</th>
</tr>
</thead>
<tbody>';
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $quantity = $row['quantity'];
    echo "<tr><td>" . $name . "</td><td>" . $quantity . "</td></tr>";
}
echo '</table>';
}
?>
<p>Пока никто не выбирал ночной тариф</p>
<br>
<h4>6.Получить список всех игр, которые были заказаны более двух раз.</h4>
<?php

$sql = "SELECT games.name, COUNT(*) AS quantity FROM games JOIN game_orders ON games.id_game = game_orders.id_game GROUP BY games.name HAVING COUNT(*) > 2;";
$result = mysqli_query($conn, $sql);
echo '<table>
<thead>
<tr>
<th>Список игр</th>
<th>Количество</th>
</tr>
</thead>
<tbody>';
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $quantity = $row['quantity'];
    echo "<tr><td>" . $name . "</td><td>" . $quantity . "</td></tr>";
}
echo '</table>';
}
?>
<p>Пока никто не заказал игры более 2-х раз</p>
<br>
<h4>7. Получить список всех компьютеров, которые свободны для аренды в  определенное время.</h4>

<?php
$sql = "SELECT games.name, COUNT(*) AS quantity FROM games JOIN game_orders ON games.id_game = game_orders.id_game GROUP BY games.name HAVING COUNT(*) > 2;";
$result = mysqli_query($conn, $sql);
echo '<table>
<thead>
<tr>
<th>Список игр</th>
<th>Количество</th>
</tr>
</thead>
<tbody>';
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $quantity = $row['quantity'];
    echo "<tr><td>" . $name . "</td><td>" . $quantity . "</td></tr>";
}
echo '</table>';
}
?>

<br>
<h4>8. Получить список общего количества арендованных компьютеров для каждого  типа компьютера.</h4>

<?php

$sql = "SELECT computer_schedule.computer_number, computer_schedule.start_time, computer_schedule.end_time FROM computer_schedule LEFT JOIN computer_reservation ON computer_schedule.id = computer_reservation.computer_schedule_id WHERE computer_reservation.id IS NULL;";
$result = mysqli_query($conn, $sql);
echo '<table>
<thead>
<tr>
<th>Список игр</th>
<th>Количество</th>
</tr>
</thead>
<tbody>';
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
    $computerNumber = $row['computer_number'];
    $startTime = $row['start_time'];
    $endTime = $row['end_time'];
    echo "<tr><td>" . $computerNumber . "</td><td>" . $startTime . "</td><td>" . $endTime . "</td></tr>";
}
echo '</table>';
}

?>

<br>
<h4>9. Получить список всех компьютеров, которые были арендованы определенным  клиентом в определенный период времени.</h4>

<?php
echo '<table>
<thead>
<tr>
<th>Комп</th>
<th>Начало</th>
<th>Конец</th>
</tr>
</thead>
<tbody>';
if ($result) {
$sql = "SELECT resources.name, COUNT(*) AS quantity FROM computer_reservation JOIN computer_schedule ON computer_reservation.computer_schedule_id = computer_schedule.id JOIN resources ON computer_schedule.id = resources.id GROUP BY resources.name;";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $quantity = $row['quantity'];
    echo "<tr><td>" . $name . "</td><td>" . $quantity . "</td></tr>";
}
echo '</table>';
}

?>

<br>
<h4>10. Получить список и общее число тарифов, выбранных посетителями за  определенный день, при выборе места определенного класса.</h4>
 <p>На данный день, нет информации</p>
<?php



?>
</div>

</section>
<?php
include 'footer.php';
?>
