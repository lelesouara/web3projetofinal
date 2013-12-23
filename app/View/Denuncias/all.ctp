<div class="page-header">
  <h1>Minhas denúncias <small> </small></h1>
</div>

<table class="table">
	<tr>
		<th>ID</th>
		<th>Empresa</th>
		<th>Link</th>
		<th>Descrição</th>
		<th></th>
	</tr>
	<?php foreach($minhasDenuncias as $denuncia): ?>
	<tr>
		<td><?= $denuncia['Denuncia']['id']; ?></td>
		<td><?= empty($denuncia['Denuncia']['empresa']) ? "SEM EMPRESA" : $denuncia['Denuncia']['empresa']; ?></td>
		<td>
			<?= empty($denuncia['Denuncia']['empresa']) ? "SEM LINK" : substr($denuncia['Denuncia']['link'], 0, 15). "..."; ?>
		</td>
		<td><?= substr($denuncia['Denuncia']['descricao'], 0, 40). "..."; ?></td>
		<td>
			<?= $this->Html->link('Editar', array('controller' => 'denuncias', 'action' => 'edit', $denuncia['Denuncia']['id']), array('class' => 'btn btn-primary')); ?>
			&nbsp;
			<?= $this->Form->postLink('Deletar', array('controller' => 'denuncias', 'action' => 'delete', $denuncia['Denuncia']['id']), array('class' => 'btn btn-danger'), "Deseja deletar esta denúncia?"); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>