

 
    <?php
        require_once('../php/bd.php');
    ?>

            <h2>Забронированные игры</h2>
         
                <table>
                    <tr>
                        <th>№</th>
                        <th>Номер Пк</th>
                        <th>Кол-во</th>
                        <th>Игра</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM game_orders";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM game_orders" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM games where id_game = '$supplier[id_game]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>" .  $supplier['name'] . "</td>";
                            echo "<td>" .  $supplier['quantity'] . "</td>";
                            echo "<td>" .  $rows['name'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
         
         
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['name']))){
        $name=$_POST['name'];
        $quantity=$_POST['quantity'];
        $id_game=$_POST['id_game'];
       
        mysqli_query($conn, "INSERT INTO `game_orders` (`id`, `name`, `quantity`, `id_game`) VALUES (NULL, '$name', '$quantity', '$id_game')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
 
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Номер ПК</p>
            <select name="name" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM computer_schedule ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['computer_number'].'>'.  $rows['computer_number'] . '</option>';
            }
            ?>
            </select>
            <br>
            <p>Кол-во</p>
            <input type="text" name="quantity">
            <p>Игра</p>
            <select name="id_game">
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM games ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id_game'].'>'.  $rows['name'] . '</option>';
            }
            ?>
            </select>
           <br><br>
            <input type="submit" name="submit" value="Добавить">
        </form>

            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM game_orders where id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM game_orders" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div > 
                            <h2>Изменить данные</h2>
                            <p>Номер ПК</p>
                            <select name='name'>
                            ";
                            $querys = mysqli_query($conn,"SELECT * FROM computer_schedule ");
                            while($rows = mysqli_fetch_assoc($querys)){
                            echo '<option value='.$rows['computer_number'].'>'.  $rows['computer_number'] . '</option>';
                            }
                            echo "
                            </select>
                        
                            <p>Кол-во</p>
                            <input type='text' name='quantity' value='{$supplier['quantity']}''>
                            <p>Игра</p>
                            <select name='id_game'>
                            ";
                            $querys = mysqli_query($conn,"SELECT * FROM games ");
                            while($rows = mysqli_fetch_assoc($querys)){
                            echo '<option value='.$rows['id_game'].'>'.  $rows['name'] . '</option>';
                            }
                            echo "
                            </select>
                           
                        </div> <br>";
                    } 
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $name=$_POST['name'];
                    $quantity=$_POST['quantity'];
                    $id_game=$_POST['id_game'];
                   
                  
                    // $query = "UPDATE `computer_reservation` SET `user_id` = '$user_id', `computer_schedule_id` = '$computer_schedule_id' where id = {$_GET['red_id']}";
                    mysqli_query($conn, "UPDATE `game_orders` SET `name` = '$name', `quantity` = '$quantity' , `id_game` = '$id_game' where id = {$_GET['red_id']}");
                    // var_dump($query);
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM game_orders WHERE id = {$_GET['del_id']}");        
                }   
            ?>
