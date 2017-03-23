<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once 'database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $error = "";
    $login = strip_tags(trim($_POST['login']));
    $userName = strip_tags(trim($_POST['userName']));
    $Email = strip_tags(trim($_POST['Email']));
    $textArea = strip_tags(trim($_POST['textArea']));
    if(empty($login) or empty($userName) or empty($Email) or  empty($textArea)){
        $_SESSION['user']['error'] = "<div class='error'>Заполните Обязательные поля формы</div>";
        $_SESSION['user']['login'] = $login;
        $_SESSION['user']['userName'] = $userName;
        $_SESSION['user']['Email'] = $Email;
        $_SESSION['user']['textArea'] = $textArea;
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }
    if(!preg_match('/^[a-zA-Zа-яА-ЯёЁдД0-9]{2,20}$/', $login)){
        $error.= '<li>Не валидное поле "Логин"</li>';
    }
    if(!preg_match('/^[а-яА-ЯёЁРрТтьъШшдД]{2,20}$/',$userName)){
        $error.= '<li>Не валидное поле "Имя"</li>';
    }
    if(!preg_match('/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/',$Email)){
        $error.= '<li>Не валидное поле "Email"</li>';
    }
    if(!preg_match('/^.{20,200}$/',$textArea)){
        $error.= '<li>Не валидное поле "О себе"</li>';
    }
    if(!empty($error)){
        $_SESSION['user']['error'] = "<div class='error'>$error</div>";
        $_SESSION['user']['login'] = $login;
        $_SESSION['user']['userName'] = $userName;
        $_SESSION['user']['Email'] = $Email;
        $_SESSION['user']['textArea'] = $textArea;
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }else{
        $ip = $_SERVER["REMOTE_ADDR"];
        if(!empty($_FILES['userfile']['name'])){
            $dt = date("d-m-Y-H-i-s");
            $filetype = end(explode(".", $_FILES['userfile']['name']));
            $newFileName = $dt.".".$filetype; 
            $_FILES['userfile']['name'] = $newFileName;
            $filePath = "upload/".$_FILES['userfile']['name'];

            if($_FILES['userfile']['error']!= 0){
                $error.= "Не удалось  загрузить  файл";
                $_SESSION['user']['error'] = "<div class='error'>$error</div>";
                $_SESSION['user']['login'] = $login;
                $_SESSION['user']['userName'] = $userName;
                $_SESSION['user']['Email'] = $Email;
                $_SESSION['user']['textArea'] = $textArea;
                header("Location:".$_SERVER['PHP_SELF']);
                exit;
            }
        }else{
            $filePath = "";
        }
        $db = new Database();
        $res = $db->saveForm($login,$userName,$Email,$textArea,$ip,$filePath);

        if(!$res){
            $_SESSION['user']['error'] = "<div class='error'>Добавить  запись  не удалось</div>";
            header("Location:".$_SERVER['PHP_SELF']);
            exit;
        }elseif($res and !empty($filePath)){
            move_uploaded_file($_FILES['userfile']['tmp_name'],"upload/".$_FILES['userfile']['name']);
            $_SESSION['user']['success'] = "<div class='success'>Запись в Базу Данных добавлена успешно<br>Файл успешно загружен</div>";
            header("Location:".$_SERVER['PHP_SELF']);
            exit; 
        }else{
            $_SESSION['user']['success'] = "<div class='success'>Запись в Базу Данных добавлена успешно</div>";
            header("Location:".$_SERVER['PHP_SELF']);
            exit;
        }    
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css"/>    
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <div class="col-md-3"><a href="view.php">Список Юзеров</a></div>
            <div class="col-md-6">
                <?php 
                if(isset($_SESSION['user']['error'])){
                    echo "<h2>".$_SESSION['user']['error']."</h2>";
                    unset($_SESSION['user']['error']);
                } 
                ?>
                <?php 
                if(isset($_SESSION['user']['success'])){
                    echo "<h2>".$_SESSION['user']['success']."</h2>";
                    unset($_SESSION['user']);
                } 
                ?>
                    
                <form role="form" method="POST" enctype="multipart/form-data">
                    <p class="help-block">Поля отмеченные * обязательны для заполнения</p>
                    <div class="form-group">
                      <label for="userName ">Логин *</label>
                      <input type="text" class="form-control" id="userName" name="login" value="<?php echo $_SESSION['user']['login']?>" placeholder="введите Логин">
                    </div>
                    <div class="form-group">
                      <label for="Name ">Имя *</label>
                      <input type="text" class="form-control" id="Name" name="userName" value="<?php echo $_SESSION['user']['userName']?>" placeholder="введите ваше имя">
                    </div>
                    <div class="form-group">
                      <label for="Email1">Email *</label>
                      <input type="email" class="form-control" id="Email1" name="Email" value="<?php echo $_SESSION['user']['Email']?>" placeholder="введите email">
                    </div>
                    <div class="form-group">
                      <label for="textArea">О себе *</label>
                      <textarea rows="5" class="form-control" id="textArea" name="textArea"  placeholder="напишите коротко о  себе (минимум 20 символов)."><?php echo $_SESSION['user']['textArea']?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="InputFile">File input</label>
                      <input type="file" id="InputFile" name="userfile">
                    </div>
                    <button type="submit" class="btn btn-success">Отправить</button>
                  </form>
            </div>
            <div class="col-md-3"></div>

</div>

    </body>
</html>
