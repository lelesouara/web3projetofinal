<div id='form-user' class="users form">
    <div class="page-header">
        <h1>Novo usuário <small>cadastro de novo usuário</small></h1>
    </div>

    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <?php
        echo $this->Form->input('username', array('label' => 'Informe um Email', 'id' => 'email', 'class' => 'form-control'));
        echo $this->Form->input('password', array('label' => 'Informe uma senha', 'id' => 'senha', 'class' => 'form-control'));
        echo "<label for='resenha'> Repita novamente a senha: </label><input type='password' name='resenha' id='resenha' class='form-control'>";
        echo $this->Form->input('role', array(
            'type' => 'hidden',
            'value' => 'user',
        ));
        ?>
    </fieldset>    
    <br>
    <?php
    echo $this->Form->submit('Cadastrar', array('name' => 'submit', 'id' => 'btn_submitCadastro', 'class' => 'btn btn-primary'));
    echo $this->Form->end();
    ?>
</div>
<br>
Já possuo conta, desejo <?php echo $this->Html->link("entrar", array('action' => 'login')) ?>

<script>
    
</script>