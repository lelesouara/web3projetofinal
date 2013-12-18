<?php echo $this->Session->flash('auth'); ?>

<div class="users form">
    <div class="page-header">
        <h1>Entrar <small>Acesse seu perfil</small></h1>
    </div>
    <div style='width:500px;'>
        <?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
        <fieldset>
            <?php
            echo $this->Form->input('username', array('class' => 'form-control', 'label' => 'Login (e-mail)'));
            echo $this->Form->input('password', array('class' => 'form-control', 'label' => 'Senha (senha)'));
            ?>
        </fieldset>
        <br>
        <?php echo $this->Form->submit('Entrar', array('class' => 'btn btn-primary')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
    <br>
    Sou novo, desejo <?php echo $this->Html->link("Criar um novo usuário", array('action' => 'add')) ?><br>
    Esqueci minha senha, desejo <?php echo $this->Html->link("recupera-la", array('action' => 'recsenha')) ?>
</div>