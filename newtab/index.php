<?php
$today    = [];
$tomorrow = [];
$note     = [];
$removed  = [];

$mysqli = @new mysqli('localhost', 'vccaeosp_ezi', 'cpsess2881803224', 'vccaeosp_newtab');
if (mysqli_connect_errno()) { echo "Подключение невозможно: ".mysqli_connect_error(); }
$mysqli->query("SET NAMES 'utf8'");

$result_set = $mysqli->query('SELECT * FROM `note`');
while ($row = $result_set->fetch_assoc()) {
	if($row['tab'] == 'today')        array_push($today,    $row);
	elseif($row['tab'] == 'tomorrow') array_push($tomorrow, $row);
	elseif($row['tab'] == 'note') 	  array_push($note,     $row);
	elseif($row['tab'] == 'removed')  array_push($removed,  $row);
}

$word = $mysqli->query("SELECT * FROM `dictionary` WHERE status=0 ORDER BY RAND() LIMIT 1")->fetch_assoc();

$mysqli->close();

$btns = '<div class="btn arrow-circle-right"><i class="fa fa-arrow-circle-right"></i></div>
		 <div class="btn arrow-circle-left"><i class="fa fa-arrow-circle-left"></i></div>
		 <div class="btn check"><i class="fa fa-check"></i></div>
		 <div class="btn trash"><i class="fa fa-trash"></i></div>
		 <div class="btn chrome"><i class="fa fa-chrome"></i></div>';
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="theme-color" content="#111111">
	<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>New Tab</title>
	<script>
	if(localStorage.js==undefined||localStorage.css==undefined){location.href="http://ezi.co.ua/newtab/init.php";}
	else{
		var js = document.createElement('script'); js.innerHTML = localStorage.js; document.head.appendChild(js);
		var css = document.createElement('style'); css.innerHTML = localStorage.css; document.head.appendChild(css);
	}
		</script>
	<!-- <link rel="stylesheet" href="css.css"> -->
	<!-- <script src="js.js"></script> -->
</head>
<body>
	<nav>
		<ul><li id="li-today" class="active">сегодня</li><li id="li-tomorrow">Завтра</li><li id="li-note">Заметки</li><li id="li-removed">Выполненные</li></ul>
	</nav>
	<div class="wrapper">
		<div id="today" class="tab active">
			<? foreach($today as $item ): ?>
				<div class="business">
					<input type="text"  value="<?= $item['text'] ?>" data-id="<?= $item['id'] ?>">
					<?= $btns ?>
				</div>
			<? endforeach; ?>
		</div>
		<div id="tomorrow" class="tab">
			<? foreach($tomorrow as $item ): ?>
				<div class="business">
					<input type="text"  value="<?= $item['text'] ?>" data-id="<?= $item['id'] ?>">
					<?= $btns ?>
				</div>
			<? endforeach; ?>
		</div>
		<div id="note" class="tab">
			<? foreach($note as $item ): ?>
				<div class="business">
					<input type="text"  value="<?= $item['text'] ?>" data-id="<?= $item['id'] ?>">
					<?= $btns ?>
				</div>
			<? endforeach; ?>
		</div>
		<div id="removed" class="tab">
			<? foreach($removed as $item ): ?>
				<div class="business">
					<input type="text"  value="<?= $item['text'] ?>" data-id="<?= $item['id'] ?>">
					<?= $btns ?>
				</div>
			<? endforeach; ?>
		</div>
		<div class="btn-plus"><i class="fa fa-plus"></i></div>
		<div class="business english">
			<span><?= $word['word-en'] ?>  -  <?= $word['word-ru'] ?></span>
			<div class="btn next-word"><i class="fa fa-arrow-circle-right"></i></div>
			<div class="btn check-word" word-id="<?= $word['id'] ?>"><i class="fa fa-check"></i></div>
		</div>
	</div>
	<div id="consol">Раметка загружена</div>
</body>
</html>
