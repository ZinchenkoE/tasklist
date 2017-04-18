<?php
try{
    $mysqli = @new mysqli('localhost', 'vccaeosp_ezi', 'cpsess2881803224', 'vccaeosp_newtab');
    if (mysqli_connect_errno()) { echo 'Подключение невозможно: ' . mysqli_connect_error(); }
    $mysqli->query("SET NAMES 'utf8'");
    $action = $_GET['action'] ?? '';
    $text   = urldecode($_GET['text'] ?? '');
    //   var_dump($text); die;
    $tab = $_GET['tab'] ?? '';
    $id = $mysqli->real_escape_string($_GET['id'] ?? '');
    // $text = $mysqli->real_escape_string($text);
    //print_r($text); die;
    if($action == 'insert'){
        $mysqli->query("INSERT INTO note(`text`, `tab`) VALUES ('$text', '$tab');");
        echo $mysqli->insert_id;
    }elseif($action == 'updateText'){
        $mysqli->query("UPDATE `note` SET `text`='$text' WHERE id=$id");
        echo 'Обновили запись ' . $id;
    }elseif($action == 'updateTab'){
        $mysqli->query("UPDATE `note` SET `tab`='$tab' WHERE id=$id");
        echo 'Переместили запись в ' . $tab;
    }elseif($action == 'delete'){
        $mysqli->query("UPDATE `note` SET `tab`='5' WHERE id=$id");
        echo 'Запись ' . $id .' перемещена в архив';
    }elseif($action == 'checkWord'){
        $mysqli->query("UPDATE `dictionary` SET `status`='1' WHERE id=$id");
        $word = $mysqli->query("SELECT * FROM `dictionary` WHERE status=0 ORDER BY RAND() LIMIT 1")->fetch_assoc();
        $count = $mysqli->query("SELECT COUNT(*) FROM `dictionary` WHERE status=1")->fetch_assoc();
        echo $word['id'] . '++' . $word['word-en'] . '  -  ' . $word['word-ru'] . '++' . $count['COUNT(*)'];
    }elseif($action == 'nextWord'){
        $word = $mysqli->query("SELECT * FROM `dictionary` WHERE status=0 ORDER BY RAND() LIMIT 1")->fetch_assoc();
        $count = $mysqli->query("SELECT COUNT(*) FROM `dictionary` WHERE status=1")->fetch_assoc();
        echo $word['id'] . '++' . $word['word-en'] . '  -  ' . $word['word-ru'] . '++' . $count['COUNT(*)'];
    }
    $mysqli->close();
}catch(Exception $e){ var_dump($e); }





















//_____________________________________________

//header('Access-Control-Allow-Origin: *');

//foreach($_POST['qq'] as $key){

//    $en = mysql_escape_string($key[0]);

//    $ru = mysql_escape_string($key[1]);

//    $mysqli->query("INSERT INTO dictionary(`word-en`, `word-ru`) VALUES ('$en', '$ru');");

//}

//echo count($_POST['qq']);

//_____________________________________________________