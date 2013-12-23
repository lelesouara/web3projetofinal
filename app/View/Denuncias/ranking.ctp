<div class="page-header">
  <h1>Ranking <small>Os mais famosos da rede - TOP 20.</small></h1>
</div>

<table class='table'>
	<tr>
		<th>N°</th>
		<th>Descrição</th>
		<th>Empresa</th>
		<th>Apoiadores</th>
	</tr>
	<?php
		$i = 1;
		foreach($lista as $item){
	?>
	<tr>
		<td><?= $i; ?></td>
		<td><?= $this->Html->link(substr($item['Denuncia']['descricao'], 0, 40). "...", array('controller' => 'denuncias', 'action' => 'view', $item['Denuncia']['id'])); ?></td>
		<td><?= empty($item['Denuncia']['empresa']) ? "SEM EMPRESA" : $item['Denuncia']['empresa']; ?></td>
		<td><?= $item['Ranking']['qtdapoios']; ?></td>
	</tr>
	<?php
		$i++;
		} 
	?>
</table>