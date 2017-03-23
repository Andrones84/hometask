<?php
session_start();

    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    require_once 'database.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $flag  = (int)abs($_POST['order']);
        $from = mysql_real_escape_string(strip_tags(trim($_POST['from'])));
        $to = mysql_real_escape_string(strip_tags(trim($_POST['to'])));
        if($from > $to){
            $_SESSION['error'] = "Вы выбрали  недопутимые параметры фильтра";
            header("Location:".$_SERVER['PHP_SELF']);
            exit;
        }
    }

    $db = new Database();
    $res = $db->getUsers($from,$to,$flag);
    $datedb = $db->getDate();
    ?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript">
window.onload = function(){
    var fromSel = document.getElementById("from");
    var firstOpt = fromSel.childNodes[1];
    firstOpt.setAttribute("selected","");
    var toSel = document.getElementById("to");
    var lastOpt = toSel.childNodes[toSel.length];
    lastOpt.setAttribute("selected","");
}
        </script>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css"/>   
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <div class="col-md-2"><a href="index.php">добавить юзера</a></div>
            <div class="col-md-8">

                <form class="form" method="POST">
                    <div class="form-group">
                       <p>фильтр по дате
                        <select name="from" id="from">
                            <?php  foreach ($datedb as $key => $value){
                                echo "<option>{$value['group_date']}</option>";
                            }
                            ?>
                        </select>
                        <select name="to" id="to">
                           <?php foreach ($datedb as $key => $value){
                                echo "<option>{$value['group_date']}</option>";
                            }
                            ?>
                        </select>
                       </p>                      
                    </div>
                    <select name="order">
                        <option value="0">От старых к новым</option>
                        <option value="1">От новых к старым</option>
                    </select>

                    <button type="submit" class="btn">Отправить</button>
                </form>
                <?php 
                if(isset($_SESSION['error'])){
                    echo "<h2>".$_SESSION['error']."</h2>";
                    unset($_SESSION['error']);
                    exit;
                } 
                ?>
                <?php if(!$res){
                  echo "<p class='lead'>Записей нет</p>";   
                  exit;
                }?>
                <table class="table table-bordered">
                    <thead class="warning">
                            <tr class="warning">
                            <th>Логин</th>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>О себе</th>
                            <th>IP</th>
                            <th>Путь к файлу</th>
                            <th>Дата</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  foreach ($res as $key => $value):?>
                        <tr>
                            <td><?=$value["login"]?></td>
                            <td><?=$value["userName"]?></td>
                            <td><?=$value["Email"]?></td>
                            <td><?=$value["textArea"]?></td>
                            <td><?=$value["ip"]?></td>
                            <td><a href="<?=$value["filePath"]?>"><?=$value["filePath"]?></a></td>
                            <td><?=$value["dateTime"]?></td>
                        </tr>
                     <?php    endforeach; ?>
                    </tbody>
                </table>
               
            </div>

         
            <div class="col-md-2"></div>

</div>

    </body>
</html>
