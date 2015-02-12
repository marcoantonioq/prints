<!-- <div class="row-fluid">


	<div class='span8'>		
		<?php 
			echo $this->Form->create('Job', array('type'=>"file")); 
			$this->Form->inputDefaults(array(
				'class'=>'span12'
			));
		?>
		<?php  
		

			echo $this->Form->input('user_id', array(
				'label'=>ucfirst(__('user_id')),
			));

			echo $this->Form->input('printer_id', array(
				'label'=>"Impressora",
				'legend'=>"Impressora",
				'type'=> "radio",
				'class'=>false
			));

			echo $this->Form->input('date', array(
				'label'=>ucfirst(__('date')),
				'type'=>'hide'
			));

			echo $this->Form->input('host', array(
				'label'=>ucfirst(__('host')),
				'type'=>'hide',
			));

			echo $this->Form->input('pages', array(
				'label'=>"Página(s)",
				'type'=>'hide',
			));

			echo $this->Form->input('pageranges', array(
				'label'=>"Página(s) ",
				'div'=>'span12',
				'type'=>'text',
				'placeholder'=>'ex: 1-5 or 2,3,4'
			));

			echo $this->Form->input('copies', array(
				'label'=>ucfirst(__('copies')),
				'div'=>'span12',
			));

			echo $this->Form->input('orientation', array(
				'label'=>"Orientação",
				'div'=>'span12',
				'type'=>'select',
				'empty'=>'retrato',
				'options'=>array(
					'landscape'=>'paisagem',
				)
			));

			echo "<br>";

			echo $this->Form->input('file', array(
				'label'=>ucfirst(__('file')),
				'class'=>'span12',
				'type'=>'file'
			));			
		?>
		<div class="form-actions form-horizontal">
			<?php			  echo $this->Form->button('Enviar', array(
				'class'=>'btn btn-info'
			))." ";
			echo $this->Form->button('Limpar', array(
				'type'=>'reset',
				'class'=>'btn btn-warning'
			));
			
			echo $this->Form->end();

			?>		</div>

	</div>

	<div class="span4">
		<div class="actions form-horizontal well ucase">
			<h3><?php echo __('Actions'); ?></h3>
			
			<?php  echo $this->Html->link('Voltar', 
				array( 'action' => 'index'),
				array('class'=> 'btn btn-block')
			); ?>
				</div>
	</div>

</div>
 -->