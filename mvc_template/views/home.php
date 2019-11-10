<a href="<?php echo BASE_URL; ?>contatos/addContato">Adicionar Contato</a><br><br>		

<table width="100%">
	<tr>
		<th>Id</th>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Ações</th>
	</tr>
		<?php foreach($lista as $item): ?>
			<tr>	
				<td><?php echo $item['id'];	 ?></td>
				<td><?php echo $item['nome'];	 ?></td>
				<td><?php echo $item['email'];	 ?></td>
				<td>
					<a href="<?php echo BASE_URL; ?>contatos/updContato/<?php echo $item['id']; ?>">[ Editar]</a>
					<a href="<?php echo BASE_URL; ?>contatos/delContato/<?php echo $item['id']; ?>">[ Excluir]</a>
				</td>
			</tr>
		<?php 	endforeach; ?>
</table>