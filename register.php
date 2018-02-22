<?php
ob_start();
session_start();
require('config/index.php');

if(isset($_SESSION['username'])):
    header('Location: mp.php');
else:
    if(isset($_POST['register'])):
        if(empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])):
            echo 'No dejes campos en blanco';
        elseif(strlen($_POST['email']) > 30):
            echo 'El email no puede tener mas de 30 caracteres';
        elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)):
            echo 'El email no es valido';
        elseif(strlen($_POST['username']) > 30):
            echo 'El username no puede tener mas de 30 caracteres';
        else:
            $email = mysqli_query($connection, "SELECT email FROM username WHERE email = '".mysqli_real_escape_string($connection, $_POST['email'])."'");
            if($email1 = mysqli_fetch_assoc($email)):
                echo 'El email ya existe';
            else:
                $user = mysqli_query($connection, "SELECT user FROM username WHERE user = '".mysqli_real_escape_string($connection, $_POST['username'])."'");
                if($user1 = mysqli_fetch_assoc($user)):
                    echo 'El usuario ya existe';
                else:
                    mysqli_query($connection, "INSERT INTO username(id,email,username,password,fecha,ip) VALUES ('', '".mysqli_real_escape_string($connection, $_POST['email'])."', '".mysqli_real_escape_string($connection, $_POST['username'])."', '".mysqli_real_escape_string($connection, hash('ripemd160', $_POST['password']))."', '".date("Y-m-d")."', '".$_SERVER['SERVER_ADDR']."')");
                    $_SESSION['username'] = $_POST['username'];
                    header('Location: mp.php');
                endif;
            endif;
        endif;
    endif;
endif;
?>
<form method="post">
    <input name="email" type="email" placeholder="Introduce tu email"><br>
    <input name="username" type="text" placeholder="Introduce tu usuario"><br>
    <input name="password" type="password" placeholder="Introduce tu contraseña"><br>
    <input name="register" type="submit" value="Registrate">
</form>