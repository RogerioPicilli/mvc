<h3>Atualizar Contato</h3>

<?php if($error == 'exist'): ?>
	<div class="alert alert-danger">
		O email já está cadastrado em nossa base de dados!
	</div>
<?php endif; ?>	

<form method="POST" action="<?php echo BASE_URL;?>contatos/updContatoSave">

	<input type="hidden" name="id" id="id" value="<?php echo $contato['id']; ?>">
	Nome:<br>
	<input type="text" name="nome" value="<?php echo $contato['nome']; ?>"><br><br>

	E-mail:<br>
	<input type="email" name="email" value="<?php echo $contato['email']; ?>"><br><br>

	<input type="submit" value="Atualizar" name=""><br>


	
</form>