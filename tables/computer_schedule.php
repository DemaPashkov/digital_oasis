    <?php
       require_once('../php/bd.php');
    ?>
 
         <h2>Расписание</h2>
       
                <table>
                    <tr>
                        <th>№/Id</th>
                        <th>Номер столика</th>
                        <th>Тип</th>
                        <th>Начало</th>
                        <th>Конец</th>
                        <th>Класс</th>
                       
                    </tr>

                    <?php 
                        $query = "SELECT * FROM computer_schedule";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM computer_schedule" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM resources where id = '$supplier[resource_id]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>" .  $supplier['computer_number'] . "</td>";
                            echo "<td>" .  $rows['name'] . "</td>";
                            echo "<td>" .  $supplier['start_time'] . "</td>";
                            echo "<td>" .  $supplier['end_time'] . "</td>";
                            echo "<td>" .  $supplier['class'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
           
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['computer_number'])) and !empty($_POST['resource_id']) and !empty($_POST['start_time']) and !empty($_POST['end_time']) and !empty($_POST['class'])){
        $surname=$_POST['computer_number'];
        $name=$_POST['resource_id'];
        $otchestvo=$_POST['start_time'];
        $id_position=$_POST['end_time'];
        $number=$_POST['class'];
        mysqli_query($conn, "INSERT INTO `computer_schedule` (`id`, `computer_number`, `resource_id`, `start_time`, `end_time`, `class`) VALUES (NULL, '$surname', '$name', '$otchestvo', '$id_position','$number')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
   
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Номер столика</p>
            <select name="computer_number" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM computer_schedule ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['computer_number'].'>'.  $rows['computer_number'] . '</option>';
            }
            ?>
            </select>
           
            <p>Тип</p>
            <select name="resource_id" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM resources ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id'].'>'.  $rows['name'] . '</option>';
            }
            ?>
            </select>
            <p>Начало</p>
            <input  type="date" name="start_time">
            <p>Конец</p>
            <input type="date"  name="end_time"> <br> 
        
            <p>Класс</p>
            <input type="text" value="Стандарт" name="class"> <br> 
           
            <input  type="submit" name="submit" value="Добавить">
        </form>
    
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM computer_schedule where id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM computer_schedule" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Номер столика</p>
                            <input  type='text' required name='computer_number' value='{$supplier['computer_number']}'/>
                            <p>Тип</p>
                            <select name='resource_id'>
                           ";
                           $querys = mysqli_query($conn,"SELECT * FROM resources ");
                            while($rows = mysqli_fetch_assoc($querys)){
                            echo '<option value='.$rows['id'].'>'.  $rows['name'] . '</option>';
                            }
                           echo "
                           </select>
                            <p>Начало</p>
                            <input  type='date' required name='start_time' value='{$supplier['start_time']}'/>
                            <p>Конец</p>
                            <input  type='date' required name='end_time' value='{$supplier['end_time']}'/>
                            
                            <p>Класс</p>
                            <input type='text' required name='class' value='{$supplier['class']}'/>
                        ";
                    }
                echo '<br><br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>
                </div>';
                
                if (!empty($_POST['update'])){
                    $computer_number=$_POST['computer_number'];
                    $resource_id=$_POST['resource_id'];
                    $start_time=$_POST['start_time'];
                    $end_time=$_POST['end_time'];
                    $class=$_POST['class'];
                    mysqli_query($conn, "UPDATE `computer_schedule` SET `computer_number` = '$computer_number', `resource_id` = '$resource_id', `start_time` =  '$start_time', `end_time` = '$end_time',  `class` = '$class'  where id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM computer_schedule WHERE id = {$_GET['del_id']}");        
                }   
            ?>
 