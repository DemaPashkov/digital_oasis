

 
    <?php
      require_once('../php/bd.php');
    ?>

            <h2>Все Визиты</h2>
         
                <table>
                    <tr>
                        <th>№</th>
                        <th>Пользователь</th>
                        <th>Начало</th>
                        <th>Конец</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM visits";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM visits" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM users where id = '$supplier[id]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>" .  $rows['surname'] . " " .  $rows['name'] . " " .  $rows['otchestvo'] . "</td>";
                            echo "<td>" .  $supplier['start_time'] . "</td>";
                            echo "<td>" .  $supplier['end_time'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
         
         
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['name']))){
        $user_id=$_POST['name'];
        $start_time=$_POST['start_time'];
        $end_time=$_POST['end_time'];
       
        mysqli_query($conn, "INSERT INTO `visits` (`id`, `user_id`, `start_time`, `end_time`) VALUES (NULL, '$user_id', '$start_time', '$end_time')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
 
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Пользователь</p>
            <select name="user_id">
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM users ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id'].'>'.  $rows['surname'] . ' '.  $rows['name'] . ' '.  $rows['otchestvo'] . '</option>';
            }
            ?>
            </select>
            <br>
            <p>Начало</p>
            <input type="date" name="start_time">
            <p>Конец</p>
            <input type="date" name="end_time">
            
           <br><br>
            <input type="submit" name="submit" value="Добавить">
        </form>

            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM visits where id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM visits" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div > 
                            <h2>Изменить данные</h2>
                            <p>Пользователь</p>
                            <select name='user_id'>
                            ";
                            $querys = mysqli_query($conn,"SELECT * FROM users ");
                            while($rows = mysqli_fetch_assoc($querys)){
                            echo '<option value='.$rows['id'].'>'.  $rows['surname'] . ' '.  $rows['name'] . ' '.  $rows['otchestvo'] . '</option>';
                            }
                            echo "
                            </select>
                        
                            <p>Начало</p>
                            <input type='date' name='start_time' value='{$supplier['start_time']}''>
                            <p>Игра</p>
                            <input type='date' name='end_time' value='{$supplier['end_time']}''>
                           
                        </div> <br>";
                    } 
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $user_id=$_POST['user_id'];
                    $start_time=$_POST['start_time'];
                    $end_time=$_POST['end_time'];

                  
                    // $query = "UPDATE `computer_reservation` SET `user_id` = '$user_id', `computer_schedule_id` = '$computer_schedule_id' where id = {$_GET['red_id']}";
                    mysqli_query($conn, "UPDATE `visits` SET `user_id` = '$user_id', `start_time` = '$start_time' , `end_time` = '$end_time' where id = {$_GET['red_id']}");
                    // var_dump($query);
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM visits WHERE id = {$_GET['del_id']}");        
                }   
            ?>
