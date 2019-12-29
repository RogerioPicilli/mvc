<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<nav>
		<ul>
			<li><a href="/contact.php">Contact US</a></li>
			<li><a href="/about.php">About</a></li>
		</ul>
	</nav>

 	<h1>Task for today</h1>

 	<ul>
 		<?php foreach ($tasks as $task) : ?>
 			<li>
 				<?php if ($task->completed) : ?>
 					<strike><?= $task->description; ?></strike>
	 			<?php else: ?>
	 				<?= $task->description; ?>
	 			<?php endif; ?>
			</li>
		<?php endforeach; ?>	
 	</ul>

</body>
</html>
