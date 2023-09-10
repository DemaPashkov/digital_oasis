 <?php
include "header.php";
require_once('php/bd.php');

if (isset($_SESSION['login_user'])) {

    $user_check = $_SESSION['login_user'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
    $rows = mysqli_fetch_array($query);
    $surname = $rows['surname'];
    $otchestvo = $rows['otchestvo'];
    $names = $rows['name'];
    $status = $rows['admin'];
    $number = $rows['number'];
    $email = $rows['email'];
    $date_birth = $rows['date_birth'];

    if($status ==1){
        $admin = 'Администратор';
    }else{
        $admin = 'Покупатель';
    }
} else {
    header('Location index.php');
}

?>
<div class="account">
    <div class="main-account">
        <div class="main-account-up">
            <div class="main-account-up-img">
                <div class="image"></div>
                <div class="btn-image">
                    <p>Загрузить фото</p>
                </div>
            </div>
            <div class="main-account-up-inp">
                <label for="">Имя</label> <br>
                <input type="text" value="<?php echo $names?>"><br>
                <label for="">Фамилия</label><br>
                <input type="text" value="<?php echo $surname?>"><br>
                <label for="">Отчество</label><br>
                <input type="text" value="<?php echo $otchestvo?>"><br>
                <label for="">Дата рождения</label><br>
                <input type="text" value="<?php echo $date_birth?>">
            </div>
            <div class="main-account-up-inp">
                <label for="">e-mail</label><br>
                <input type="text" value="<?php echo $email?>"><br>
                <label for="">Телефон</label><br>
                <input type="text" value="<?php echo $number?>"><br>
                <label for="">Паспорт</label><br>
                <input type="text" >
            </div>
        </div>
        <div class="main-account-down">
            <div class="save-btn">
                <p>Сохранить изменения</p>
            </div>
            <a href="account/exit.php">
                <div class="save-btn">
                    <p>Выйти</p>
                </div>
            </a>
        </div>
    </div>
</div>
<?php
include "footer.php";
?> 



