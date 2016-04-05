<?php
/* @var $this NewsController */
?>
<a href="index.php?r=news/index">На главную</a><br><br>
<h3><?=$news->title?></h3>
<? if($news->files != null): ?>
	<img src="upload/<?=$news->files->name?>"><br>
<? endif; ?>
<b><?=$news->desc?></b><br><br>
<p><?=$news->body?></p>