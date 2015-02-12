<div class="row-fluid">
    <div class="span12 well">
		<?php 
			echo $this->Html->link('Nova '.__('printer'),
				array(
					'app'=>false,
					'controller' => 'printers',
					'action' => 'add'
				),
				array('class'=> 'btn btn-success')
			)." ";

			echo $this->Html->link('Menu', '#',
				array('class'=> 'btn btn-info','id'=>'btnmenu')
			);

		?> 
		<div id="rowmenus" class="row-fluid">
			<br>
			    <?php echo $this->Html->link('Editar impressoras',
						array('controller' => 'printers', 'action' => 'indexedit'),
						array('class'=> 'btn btn-block')
					);
				?>
		</div>
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
								echo $this->Html->image("/img/icons/block.png", array('class'=>'block','title'=>"Desconectada ou bloqueada pelo administrador")); 
						?>

						<?php echo $this->Html->image("/img/icons/print.png", array(
							'class'=>'iconprofile',
							'title'=>$printer['Printer']['local'],
							'url' => array('controller'=>'printers', 'action'=>'edit', $printer['Printer']['id'])
						)); ?>

					</td>
				</tr>
				<tr>
					<td>
						<b>Editar: <br><?php echo $printer['Printer']['name']; ?><br></b>
						<?php echo $printer['Printer']['local']; ?><br>
						
					</td>
				</tr>

			</table>
		<?php endforeach; ?>
	</div>
	
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