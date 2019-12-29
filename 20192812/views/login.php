<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/login.css">
</head>
<body>
	<div class="loginarea">	
		<form method="POST">	
			<input type="email" name="email" autocomplete="false" autofocus="true" placeholder="Digite seu email">

			<input type="password" name="senha" autocomplete="false" placeholder="Digite sua senha">

			<input type="submit" value="Logar"><br>	<br>	

			<?php if(isset($error) && !empty($error)): ?>
				<div class="warning">	
					<?php echo $error; ?>
				</div>
			<?php endif; ?>
		</form>
	</div>	
</body>
</html>


