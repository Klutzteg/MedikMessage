<?php
ob_start();
session_start();
require('config/index.php');

if(isset($_SESSION['username'])):
    header('Location: mp.php');
else:
    if(isset($_POST['login'])):
        if(empty($_POST['username']) || empty($_POST['password'])):
            echo 'Hay datos en blanco';
        elseif(strlen($_POST['username']) > 30):
            echo 'El usuario no puede tener mas de 30 caracteres';
        else:
            $login = mysqli_query($connection, "SELECT username,password FROM username WHERE username = '".mysqli_real_escape_string($connection, $_POST['username'])."' AND password = '".mysqli_real_escape_string($connection, hash('ripemd160', $_POST['password']))."'");
            if($login1 = mysqli_fetch_assoc($login)):
                $_SESSION['username'] = $_POST['username'];
                header('Location: mp.php');
                echo 'Datos correctos';
            else:
                echo 'Datos incorrectos';
            endif;
        endif;
    endif;
endif;
?>
<form action="" method="post">
    <input name="username" type="text" placeholder="Introduce tu usuario"><br>
    <input name="password" type="password" placeholder="Introduce tu contraseña"><br>
    <input name="login" type="submit" value="Iniciar Session">
</form>

<a href="register.php">Registrate</a>