<br><?= $this->Form->create('User'); ?>
    <?php
        echo $this->Form->input('suap', array(
            'label'=>'IF-ID: '
        ));
        echo $this->Form->input('password', array(
            'label'=>'Senha: '
        ));
        
        echo $this->Form->submit(
            'Logar',
            array('div'=>false)
        );
    ?>
    <?php echo $this->Form->end(); ?>