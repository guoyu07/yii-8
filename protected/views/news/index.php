<?php
/* @var $this NewsController */
?>
<h1>Новости</h1>

<table>		
	<? foreach($news as $n): ?>
		<tr>
			<td><a href="index.php?r=news/get&id=<?=$n['id']?>"><?=$n['title']?></a></td>
			<td><a href="index.php?r=news/update&id=<?=$n['id']?>">[ред]</a> | <a name="delete"href="index.php?r=news/delete&id=<?=$n['id']?>">[удал]</a></td> 
		</tr>
	<? endforeach; ?>
		<tr>
			<td><h3><a href="index.php?r=news/create">[Создать новость]</a></h3></td>
		</tr>
</table>