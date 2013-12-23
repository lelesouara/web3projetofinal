<script type="text/javascript">
		var arrTags = Array();
</script>
<div class="page-header">
  <h1>Editar Denúncia <small>Complete todos os campos.</small></h1>
</div>

<div style='width:500px;'>
<?php
	echo $this->Form->create('Denuncia', array('type' => 'post'), array('class' => 'form-horizontal'));
	echo $this->Form->input('descricao', array('value' => $denuncia['Denuncia']['descricao'], 'class' => 'form-control', 'label' => 'Descrição da Denúncia'));
	echo "<br>";
    echo $this->Form->input('link', array('value' => $denuncia['Denuncia']['link'], 'class' => 'form-control', 'label' => 'Link (Url - Opcional)'));
    echo "<br>";
    echo $this->Form->input('empresa', array('value' => $denuncia['Denuncia']['empresa'], 'class' => 'form-control', 'label' => 'Empresa'));
    echo "<br> <b>Marcações para a denúncia</b> <br>";

    $tagsSelecionadas = array();
    $tagsSelecionadasString = "";
    $varI = 0;
    foreach ($denuncia['Tags'] as $tagDenuncia) {
    	$tagsSelecionadas[] = $tagDenuncia['id'];

    	if($varI == (count($denuncia['Tags']) -1) )
    		$tagsSelecionadasString .= $tagDenuncia['id'];
    	else
    		$tagsSelecionadasString .= $tagDenuncia['id'] . "@";
    	echo "<script> arrTags.push(".$tagDenuncia['id'].") </script>";
    	$varI++;
   	}

    foreach ($tags as $tag) {
    	if(in_array($tag['Tag']['id'], $tagsSelecionadas)){
    		echo "<a id='".$tag['Tag']['id']."' class='btn btn-success' style='margin:5px;' onclick='addTag(".$tag['Tag']['id'].");'> ".utf8_encode($tag['Tag']['titulo'])." </a>";
    	}else{
			echo "<a id='".$tag['Tag']['id']."' class='btn btn-default' style='margin:5px;' onclick='addTag(".$tag['Tag']['id'].");'> ".utf8_encode($tag['Tag']['titulo'])." </a>";
    	}
	}
	echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => AuthComponent::user('id'))); 
?>
	<input id='inputTags' type="hidden" name='arrTags'> 

<?php echo $this->Form->submit('Editar Denuncia', array('class' => 'btn btn-danger', 'onclick' => 'validaForm()')); ?>
<?php echo $this->Form->end(); ?>
</div>

<script>

	$(document).ready(function(){
		$("#inputTags").val("<?= $tagsSelecionadasString ?>");
	});

	function addTag(idTag){
		if(arrTags.indexOf(idTag) == (-1) ){
			arrTags.push(idTag);
			document.getElementById(idTag).className = "btn btn-success";	
		}else{
			var arrNotRemoved = Array();
			for(var i=0; i<arrTags.length; i++){
				if(arrTags[i] != idTag){
					arrNotRemoved.push(arrTags[i]);
				}
			}
			document.getElementById(idTag).className = "btn btn-default";
			arrTags = arrNotRemoved;
		}
		console.log(arrTags);
	}

	function montaArrToString(arrEntrada){
		var string = "";
		for(var i=0; i<arrEntrada.length; i++){
			if(i == (arrEntrada.length - 1) )
				string = string + arrEntrada[i];	
			else
				string = string + arrEntrada[i] + "@";	
		}
		return string;
	}

	function validaForm(){
		var returnedString = montaArrToString(arrTags);
		document.getElementById("inputTags").value = returnedString;
		document.form.submit();
	}

</script>