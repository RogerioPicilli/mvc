<h3>Add Contato Page</h3>

<?php if($error == 'exist'): ?>
	<div class="alert alert-danger">
		O email já está cadastrado em nossa base de dados!
	</div>
<?php endif; ?>	

<form method="POST" action="<?php echo BASE_URL;?>contatos/addContatoSave">

	Nome:<br>
	<input type="text" name="nome"><br><br>

	E-mail:<br>
	<input type="email" name="email"><br><br>

	<input type="submit" value="Incluir" name=""><br>


	
</form>