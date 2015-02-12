
<div class="row-fluid">
    <div class="span12 well">
		<?php 
			echo $this->Html->link('Nova impressão',
				array(
					'app'=>true,
					'controller' => 'spools',
					'action' => 'add'
				),
				array('class'=> 'btn btn-success')
			)." ";
		?> 

		<?php 
			$user =  $this->Session->read('Auth.User');
			if($user['Department']['admin']): 
				echo  $this->Html->link("Painel",array(
					'plugin'=>false,
					'app'=>false,
					'controller' => 'printers', 
					'action' => 'index'
				),
				array(
					'class' => 'btn btn-info',
				))." ";
			endif; 

			echo $this->Html->link("Olá {$user['name']}!",array(
				'plugin'=>false,
				'app'=>true,
				'controller' => 'users', 
				'action' => 'index'
			),
			array(
				'escape' => false,
				'class' => 'btn',
			))." ";
		?>
	</div>
</div>

	<div class="row-fluid">
		<?php foreach ($printers as $printer): ?>
			<table class="profile" printer="<?php echo $printer['Printer']['id'] ?>">
				<tr>
					<td style="position:relative;">
						<?php
							if($printer['Printer']['allow'])
								echo $this->Html->image("/img/icons/1_users.png", array('class'=>'shared','title'=>"compartilhamento")); 
							if(!$printer['Printer']['status'])
								echo $this->Html->image("/img/icons/block.png", array('class'=>'block','title'=>"Desligada ou bloqueada pelo administrador"));
						?>

						<?php echo $this->Html->image("/img/icons/print.png", array(
							'class'=>'iconprofile',
							'title'=>$printer['Printer']['local'],
							'url' => array('controller'=>'spools', 'action'=>'add', $printer['Printer']['id'])
						)); ?>

					</td>
				</tr>
				<tr>
					<td>
						<b><?php echo $printer['Printer']['name']; ?><br></b>
						<?php echo $printer['Printer']['local']; ?><br>
						
					</td>
				</tr>

			</table>
		<?php endforeach; ?>
	</div>
	
	<?php echo $this->Html->link("", 
		array('app'=>false, 'controller'=>'spools', 'action'=>'active'), 
		array('id' => 'UrlSpools')
	); ?>
	<div id="spoolsActive" class="row-fluid"></div>
	
</div>


<?php 
echo $this->Html->link('', 
	array(
		'app'=>true,
		'controller'=>'spools',
		'action'=>'upload',
	),
	array(
		'id'=>'uploadURL',
		// 'class'=>'hide',
	)
);
 ?>

<?php 
	// pr($printers);
 ?>