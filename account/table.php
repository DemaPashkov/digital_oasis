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
<main class="main_admin admins">

    <section class="blocksss">
        <div class="">
            <div class="">
                <nav class="table_section-nav"> 
                    <ul> 
                      <?php
                  
                      $sql = "SHOW FULL TABLES FROM oasis WHERE TABLE_TYPE != 'VIEW';";
                      $result = mysqli_query($conn, $sql);
                    
                      // output database names
                      if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                          if($row['Tables_in_oasis'] == 'computer_reservation'){
                            $tables = 'Бронирование';
                            $href = 'computer_reservation.php';
                          }if($row['Tables_in_oasis'] == 'computer_schedule'){
                            $tables = 'Расписание';
                            $href = 'computer_schedule.php';
                          }if(($row['Tables_in_oasis'] == 'payment')){
                            $tables = 'Платежи';
                            $href = 'payment.php';
                          }if($row['Tables_in_oasis'] == 'resources'){
                            $tables = 'Ресурсы';
                            $href = 'resources.php';
                          }if($row['Tables_in_oasis'] == 'resource_usage'){
                            $tables = 'Использованные ресурсы';
                            $href = 'resource_usage.php';
                          }if($row['Tables_in_oasis'] == 'users'){
                            $tables = 'Пользователи';
                            $href = 'users.php';
                          }if($row['Tables_in_oasis'] == 'visits'){
                            $tables = 'Посещаймость';
                            $href = 'visits.php';
                          }if($row['Tables_in_oasis'] == 'games'){
                            $tables = 'Игры';
                            $href = 'games.php';
                          }
                          echo '<li><a href="../tables/'.$href.'" class="">'.$tables ."</a></li><br>";
                        }
                      }

                      ?>
                     
                        
                    </ul>
                </nav>
            </div>
        </div>
</section>
</main>  

<?php
include 'footer.php';
?>