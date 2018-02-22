<link rel="stylesheet" href="http://rawgithub.com/cheeaun/mooeditable/master/Assets/MooEditable/MooEditable.css">
<script src="http://ajax.googleapis.com/ajax/libs/mootools/1.3.0/mootools-yui-compressed.js"></script>
<script src="http://rawgithub.com/cheeaun/mooeditable/master/Source/MooEditable/MooEditable.js"></script>
<script>
    window.addEvent('domready', function(){
        $('textarea-1').mooEditable();
    });
</script>
<?php
ob_start();
session_start();
require('config/index.php');

if(isset($_SESSION['username'])):
    if(@$_GET['action'] == 'delete-receptor' AND isset($_GET['id'])):
        $mensaje = mysqli_query($connection, "SELECT id,title,message FROM mp WHERE id = '".mysqli_real_escape_string($connection, $_GET['id'])."' AND receptor = '".$_SESSION['username']."'");
        if($mensaje1 = mysqli_fetch_assoc($mensaje)):
            mysqli_query($connection, "DELETE FROM mp WHERE id = '".mysqli_real_escape_string($connection, $_GET['id'])."' AND receptor = '".$_SESSION['username']."'");
            header('Location: ?action=recibido');
        else:
            echo 'No puedes eliminar este mensaje<br>';
        endif;
    elseif(@$_GET['action'] == 'recibido' AND isset($_GET['id'])):
        $mensaje = mysqli_query($connection, "SELECT id,title,message FROM mp WHERE id = '".mysqli_real_escape_string($connection, $_GET['id'])."' AND receptor = '".$_SESSION['username']."'");
        if($mensaje1 = mysqli_fetch_assoc($mensaje)):
            mysqli_query($connection, "UPDATE mp SET leido = 'yes' WHERE id = '".mysqli_real_escape_string($connection, $_GET['id'])."' AND receptor = '".$_SESSION['username']."'");
            echo '<b>Titulo:</b> '.$mensaje1['title'].'<br><b>Mensaje:</b> '.$mensaje1['message'].'<br> <a href="?action=delete-receptor&id='.$mensaje1['id'].'">Eliminar mensaje</a><br>';
        else:
            echo 'No puedes leer este mensaje<br>';
        endif;
    elseif(@$_GET['action'] == 'recibido'):
        echo '<b>Mensajes Recibidos:</b><br>';
        $receptor = mysqli_query($connection, "SELECT title FROM mp WHERE receptor = '".$_SESSION['username']."'");
        if($receptor1 = mysqli_fetch_assoc($receptor)):
            $receptor1 = mysqli_query($connection, "SELECT id,title,leido FROM mp WHERE receptor = '".$_SESSION['username']."' ORDER BY leido");
            while($receptor2 = mysqli_fetch_assoc($receptor1)):
                if($receptor2['leido'] == 'no'):
                    echo '<a href="?action=recibido&id='.$receptor2['id'].'">'.$receptor2['title'].'</a> <img src="http://i.imgur.com/VROg8Bx.png"></img><br>';
                else:
                    echo '<a href="?action=recibido&id='.$receptor2['id'].'">'.$receptor2['title'].'</a><br>';
                endif;
            endwhile;
        else:
            echo 'No haz enviado ningun mensaje<br><br>';
        endif;
    elseif(@$_GET['action'] == 'delete-emisor' AND isset($_GET['id'])):
        $mensaje = mysqli_query($connection, "SELECT id,title,message FROM mp WHERE id = '".mysqli_real_escape_string($connection, $_GET['id'])."' AND emisor = '".$_SESSION['username']."'");
        if($mensaje1 = mysqli_fetch_assoc($mensaje)):
            mysqli_query($connection, "DELETE FROM mp WHERE id = '".mysqli_real_escape_string($connection, $_GET['id'])."' AND emisor = '".$_SESSION['username']."'");
            header('Location: ?action=enviado');
        else:
            echo 'No puedes eliminar este mensaje<br>';
        endif;
    elseif(@$_GET['action'] == 'enviado' AND isset($_GET['id'])):
        $mensaje = mysqli_query($connection, "SELECT id,title,message FROM mp WHERE id = '".mysqli_real_escape_string($connection, $_GET['id'])."' AND emisor = '".$_SESSION['username']."'");
        if($mensaje1 = mysqli_fetch_assoc($mensaje)):
            echo '<b>Titulo:</b> '.$mensaje1['title'].'<br><b>Mensaje:</b> '.$mensaje1['message'].' <a href="?action=delete-emisor&id='.$mensaje1['id'].'">Eliminar mensaje</a><br>';
        else:
            echo 'No puedes leer este mensaje<br>';
        endif;
    elseif(@$_GET['action'] == 'enviado'):
        echo '<b>Mensajes Enviados:</b><br>';
        $emisor = mysqli_query($connection, "SELECT title FROM mp WHERE emisor = '".$_SESSION['username']."'");
        if($emisor1 = mysqli_fetch_assoc($emisor)):
            $emisor1 = mysqli_query($connection, "SELECT id,title FROM mp WHERE emisor = '".$_SESSION['username']."'");
            while($emisor2 = mysqli_fetch_assoc($emisor1)):
                echo '<a href="?action=enviado&id='.$emisor2['id'].'">'.$emisor2['title'].'</a><br>';
            endwhile;
        else:
            echo 'No haz enviado ningun mensaje<br><br>';
        endif;
    elseif(@$_GET['action'] == 'create'):
        if(isset($_POST['enviar'])):
            if(empty($_POST['username']) || empty($_POST['title']) || empty($_POST['message'])):
                echo 'Haz dejado campos en blanco';
            else:
                $email = mysqli_fetch_assoc(mysqli_query($connection, "SELECT email FROM username WHERE username = '".mysqli_real_escape_string($connection, $_POST['username'])."'"));
                if($email):
                        mysqli_query($connection, "INSERT INTO mp(id,emisor,receptor,title,message,leido,fecha,ip) VALUES ('', '".$_SESSION['username']."', '".mysqli_real_escape_string($connection, $_POST['username'])."', '".mysqli_real_escape_string($connection, $_POST['title'])."', '".mysqli_real_escape_string($connection, $_POST['message'])."', 'no', '".date("Y-m-d")."', '".$_SERVER['SERVER_ADDR']."')");
                        header('Location: ?action=enviado');
                else:
                        echo 'El usuario no existe';
                endif;
            endif;
        endif;
        echo '<form action="" method="post">
                  <input name="username" placeholder="Usuario para enviarle el mensaje"><br>
              <input name="title" value="Sin asunto"><br>
              <textarea class="mooeditable" id="textarea-1" name="message" rows="10" cols="50">Mensaje</textarea><br>
              <input name="enviar" type="submit" value="Enviar mensaje">
            </form>';
    endif;
        echo '<br><a href="?action=create">Enviar mensaje</a> | <a href="?action=recibido">Mensajes recibidos</a> | <a href="?action=enviado">Mensajes enviados</a> | <a href="logout.php">Salir</a><hr>';
else:
    header('Location: index.php');
endif;
?>