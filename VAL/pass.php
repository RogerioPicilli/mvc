<?php 
//para teste peguei um hash gerado para a senha 123456
$hashsalvo = '$2y$10$Akw4yCRjhLSCtXvecBj/6.fq2KzAHywEMlyp5hICpgPx14QPWWiHa';
//o password_hash a cada execução gera um hash diferente para a mesma senha!!!
$hash = password_hash("123456", PASSWORD_BCRYPT);
echo($hash);
echo "<hr>";
echo "Enquanto o md5 sempre gera a mesma";
echo "<hr>";
echo md5("123456");

echo "<hr>";

$senha = '123456';
if(password_verify($senha, $hashsalvo)) {
	echo "A senha está correta";
} else {
	echo "A senha está INcorreta";
}


