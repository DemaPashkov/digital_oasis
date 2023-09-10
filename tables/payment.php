

 
    <?php
        require_once('../php/bd.php');
    ?>

            <h2>Платежи</h2>
         
                <table>
                    <tr>
                        <th>№</th>
                        <th>Пользователь</th>
                        <th>Цена</th>
                        <th>День</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM payment";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM payment" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM users where id = '$supplier[id]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id'] . "</td>";
                            echo "<td>".  $rows['surname'] . " ".  $rows['name'] . " ".  $rows['otchestvo'] . "</td>";
                            echo "<td>" .  $supplier['amount'] . "</td>";
                            echo "<td>" .  $supplier['payment_date'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
         
         
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['name']))){
        $user_id =$_POST['user_id '];
        $amount=$_POST['amount'];
        $payment_date=$_POST['payment_date'];
       
        mysqli_query($conn, "INSERT INTO `payment` (`id`, `user_id `, `amount`, `payment_date`) VALUES (NULL, '$user_id ', '$amount', '$payment_date')");
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
            $querys = mysqli_query($conn,"SELECT * FROM users");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id'].'>'.  $rows['surname'] . ' '.  $rows['name'] . ' '.  $rows['otchestvo'] . '</option>';
            }
            ?>
            </select>
            <br>
            <p>Цена</p>
            <input type="text" name="amount">
            <p>День</p>
            <input type="date" name="payment_date">
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
                            <p>Пользователь</p>
                            <select name='name'>
                            ";
                            $querys = mysqli_query($conn,"SELECT * FROM users");
                            while($rows = mysqli_fetch_assoc($querys)){
                            echo '<option value='.$rows['id'].'>'.  $rows['surname'] . ' '.  $rows['name'] . ' '.  $rows['otchestvo'] . '</option>';
                            }
                            echo "
                            </select>
                        
                            <p>Цена</p>
                            <input type='text' name='amount' value='{$supplier['amount']}''>
                            <p>День</p>
                            <input type='date' name='payment_date' value='{$supplier['payment_date']}''>
                           
                        </div> <br>";
                    } 
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $user_id =$_POST['user_id '];
                    $amount=$_POST['amount'];
                    $payment_date=$_POST['payment_date'];
                   

                    mysqli_query($conn, "UPDATE `payment` SET `user_id` = '$user_id', `amount` = '$amount' , `payment_date` = '$payment_date' where id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM payment WHERE id = {$_GET['del_id']}");        
                }   
            ?>
