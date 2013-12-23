<div class="page-header">
  <h1>Adicionar Denúncia <small>Complete todos os campos.</small></h1>
</div>

<div style='width:500px;'>
	<?php echo $this->Form->create('Denuncia', array('class' => 'form-horizontal', 'onsubmit' => 'return validaForm();')); ?>
	<fieldset>
	    <?php
	    echo $this->Form->input('descricao', array('class' => 'form-control', 'label' => 'Descrição da Denúncia'));
	    echo "<br>";
	    echo $this->Form->input('link', array('class' => 'form-control', 'label' => 'Link (Url - Opcional)'));
	    echo "<br>";
	    echo $this->Form->input('empresa', array('class' => 'form-control', 'label' => 'Empresa'));
	    echo "<br> <b>Marcações para a denúncia</b> <br>";
	    foreach ($tags as $tag) {
	    	echo "<a id='".$tag['Tag']['id']."' class='btn btn-default' style='margin:5px;' onclick='addTag(".$tag['Tag']['id'].");'> ".utf8_encode($tag['Tag']['titulo'])." </a>";
	    }
	    ?>
	    <input id='inputTags' type="hidden" name='arrTags'>
	    <?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => AuthComponent::user('id'))); 
	    ?>
	</fieldset>
	<br>
	<?php echo $this->Form->submit('Denunciar', array('class' => 'btn btn-danger')); ?>
	<?php echo $this->Form->end(); ?>
</div>

<script>
	var arrTags = Array();

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