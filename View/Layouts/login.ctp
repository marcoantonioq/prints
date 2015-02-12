<?php $cakeDescription = 'NUCLEO'; ?>

<!DOCTYPE html>
<html>
<head>
  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this -> Html -> charset('UTF-8'); ?>
    <title>IFG:
      <?php echo $title_for_layout; ?></title>
      <?php echo $this -> Html -> meta('icon');

      echo $this -> Html -> css('login');

      echo $this -> fetch('meta');
      echo $this -> fetch('css');
      echo $this -> fetch('script');
      echo $this -> fetch('script');
      ?>
  </head>
  <body>
    
<div class="logo">
    <?php 
        echo $this->Html->image(
            "banner-principal.png",
            array(
                'class'=>'logo_img',
                'title'=>"IFG Goias"
            )
        ); 
    ?>
</div>

<div id="content">
        <?php echo $this -> Session -> flash(); ?>
        <?php echo $this -> Session -> flash('auth'); ?>
        <div class="login">

            <?php echo $this -> fetch('content'); ?>

        </div>
        
        <div id="helping" class="hide helping">
            <span class="close"></span>
            <b>Aluno/Professor:</b> Utilize seu login e senha de acesso ao IFG-ID, caso não tenha, procure o setor responsavel (<b>TI</b>).
            </p>
            <b>Visitante:</b> Solicite ao setor responsavel (<b>TI</b>) um voucher de acesso.
        </div>

</div>
</body>
</html>



