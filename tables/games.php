

 
    <?php
       require_once('../php/bd.php');
    ?>

            <h2>Наши игры</h2>
         
                <table>
                    <tr>
                        <th>№</th>
                        <th>Название</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM games";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM games" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_game'] . "</td>";
                            echo "<td>" .  $supplier['name'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_game']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_game']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
         
         
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['name']))){
        $name=$_POST['name'];
        mysqli_query($conn, "INSERT INTO `games` (`id_game`,  `name`) VALUES (NULL, '$name')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
 
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Название игры</p>
            <input type="text" name="name">
            <input type="submit" name="submit" value="Добавить">
        </form>

            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM games where id_game={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM games" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                            <h2>Изменить данные</h2>
                            <p>Название игры</p>
                            <input type='text' name='name' value='{$supplier['name']}'>
                       <br>";
                    } 
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $name=$_POST['name'];
                    mysqli_query($conn, "UPDATE `games` SET `name` = '$name' where id_game = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM games WHERE id_game = {$_GET['del_id']}");        
                }   
            ?>
