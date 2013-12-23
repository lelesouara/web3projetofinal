<div class="page-header">
  <h1>Visualizar <small> Saiba o que está acontecendo. </small></h1>
</div>

<table class='table'>
	<tr>
		<th> Empresa </th>
		<td> <?= empty($denuncia['Denuncia']['empresa']) ? "SEM EMPRESA" : $denuncia['Denuncia']['empresa']; ?> </td>
	</tr>
	<tr>
		<th> Descrição </th>
		<td> <?= $denuncia['Denuncia']['descricao']; ?> </td>
	</tr>
	<tr>
		<th> Link </th>
		<td> <?= empty($denuncia['Denuncia']['link']) ? "SEM LINK" : $denuncia['Denuncia']['link']; ?> </td>
	</tr>
	<tr>
		<th> Por </th>
		<td> 
		<?=  $this->Html->image('avatar.png', array('alt' => "avatar usuario", 'border' => '0')); ?>
		<?= $denuncia['User']['username']; ?> 
		</td>
	</tr>
	<tr>
		<th> Marcadores </th>
		<td>
			<?php foreach($denuncia['Tags'] as $tag): ?>
				<span class='label label-success'> <?= utf8_encode($tag['titulo']); ?> </span> &nbsp; 
			<?php endforeach; ?>
		</td>
	</tr>
	<tr>
		<th> </th>
		<td>
			<div style="position: relative; width:100px; height:90px;">
			<div class='apoiar'>
				<?= $this->Html->link('Apoiar', array('controller' => 'denuncias', 'action' => 'apoiar', $denuncia['Denuncia']['id'])); ?>
			</div>
			</div>
		</td>
	</tr>
</table>