<div class="page-header">
  <h1>Inicio <small> Ultimas reclamações </small></h1>
</div>

<?php foreach($ultimasDenuncias as $denuncia): ?>
<div class='boxDenuncia'>
	<h2> <?= substr($denuncia['Denuncia']['descricao'], 0, 40). "..."; ?> </h2>
	<p><?= $denuncia['User']['username']; ?> </p>
	<div class='saibamais'>
	<?= $this->Html->link('Saiba Mais', array('controller' => 'denuncias', 'action' => 'view', $denuncia['Denuncia']['id'])); ?>
	</div>
	<div class='apoiar'>
	<?= $this->Html->link('Apoiar', array('controller' => 'denuncias', 'action' => 'apoiar', $denuncia['Denuncia']['id'])); ?>
	</div>
</div>
<?php endforeach; ?>
<div class='hack'></div>
<?php
/* Paginator Helper */
echo "<div id='paginate-global'>";
    echo "<div id='paginate-news'>".$this->Paginator->prev('« Mais novas', null, null, array('class' => 'desabilitado'))."</div>";
    echo "<div id='paginate-numbers'>".$this->Paginator->numbers()."</div>";
    echo "<div id='paginate-olders'>".$this->Paginator->next('Mais antigas »', null, null, array('class' => 'desabilitado'))."</div>";
echo "</div>";
?>
<div class='hack'></div>