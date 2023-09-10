

 
    <?php
       require_once('../php/bd.php');
    ?>

            <h2>Часто используемые ресурсы</h2>
         
                <table>
                    <tr>
                        <th>№</th>
                        <th>Пользователь</th>
                        <th>Пк</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM computer_reservation";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM computer_reservation" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM users where id = '$supplier[user_id]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>" .  $rows['name'] . "</td>";
                            echo "<td>" .  $supplier['computer_schedule_id'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
         
         
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['user_id']))){
        $suppliers=$_POST['user_id'];
        $computer_schedule_id=$_POST['computer_schedule_id'];
       
        mysqli_query($conn, "INSERT INTO `computer_reservation` (`id`, `user_id`, `computer_schedule_id`) VALUES (NULL, '$suppliers', '$computer_schedule_id')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
 
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Пользователь</p>
            <select name="user_id" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM users ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id'].'>'.  $rows['name'] . '</option>';
            }
            ?>
            </select>
            <br><br>
            <p>Пк</p>
            <select name="computer_schedule_id" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM computer_schedule ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id'].'>'.  $rows['computer_number'] . '</option>';
            }
            ?>
            </select>
           <br><br>
            <input type="submit" name="submit" value="Добавить">
        </form>

            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM computer_reservation where id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM computer_reservation" );
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
                                echo '<option value='.$rows['id'].'>'.  $rows['name'] .'</option>';
                            } 
                            echo "
                            </select>
                        
                            <p>Пк</p>
                            <select name='computer_schedule_id'>
                            ";
                            $querys = mysqli_query($conn,"SELECT * FROM computer_schedule ");
                            while($rows = mysqli_fetch_assoc($querys)){
                                echo '<option value='.$rows['id'].'>'.  $rows['computer_number'] .'</option>';
                            } 
                            echo "
                            </select>
                           
                        </div> <br>";
                    } 
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $user_id=$_POST['user_id'];
                    $computer_schedule_id=$_POST['computer_schedule_id'];
                  
                    // $query = "UPDATE `computer_reservation` SET `user_id` = '$user_id', `computer_schedule_id` = '$computer_schedule_id' where id = {$_GET['red_id']}";
                    mysqli_query($conn, "UPDATE `computer_reservation` SET `user_id` = '$user_id', `computer_schedule_id` = '$computer_schedule_id' where id = {$_GET['red_id']}");
                    // var_dump($query);
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM computer_reservation WHERE id = {$_GET['del_id']}");        
                }   
            ?>
