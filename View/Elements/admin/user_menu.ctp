<div class="menu">
	<?php 
		echo $this->Html->image('/img/icons/app.png', 
			array('class'=>'app')
		);
	 ?> 
	
	<?php echo $this->Html->link( $this->Html->image("/img/icons/print.png"),
		array('controller'=>'printers'),
		array(
			'escape' => false,
			'title'=>'Impressoras'
		)
	); ?>
	
	
	<?php echo $this->Html->link( $this->Html->image("/img/icons/chart.png"),
		array('controller'=>'jobs'),
		array(
			'escape' => false,
			'title'=>'Trabalhos de impressão'
		)
	); ?>
	
</div>

