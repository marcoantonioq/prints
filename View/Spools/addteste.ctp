<div class="row-fluid">

<?php 
	// pr($this->request->data); 
?>
	<div class='span12'>
		<?php 
			echo $this->Form->create('Spool', array('type'=>'file')); 
			$this->Form->inputDefaults(array(
				'class'=>'span12'
			));
		?>
		<?php  

			echo $this->Form->input('user_id', array(
				'label'=>'Usuário: ',
				'empty'=>'Selecione usuário...'
			));

			$default = ( !empty($this->request->params['pass'][0]) ? $this->request->params['pass'][0] : 1);

			echo $this->Form->input('printer_id', array(
				'label'=>"Impressora: ",
				'legend'=>"Selecione impressora",
				'default'=>$default,
				// 'empty'=>"Selecione...",
				// 'type'=> "radio",
				// 'class'=>'printers'
			));

			echo $this->Form->input('host', array(
				'label'=>ucfirst(__('host')),
				'type'=>'hide',
				'value'=>$_SERVER['REMOTE_ADDR']
			));


			echo $this->Form->input('copies', array(
				'label'=>'Cópias: ',
				'value'=>1
				));

			?>

		<div class="row-fluid">
			
			<?php 
			    echo "<br>".$this->Form->input('file.', array(
					'label'=>false,
					'type'=>'file',
					'multiple'=>true,
					'class'=>'btn'
				));
		 	?>
		
			<br>
			<a href="#" class="options btn btn-info"><b>Opções...</b></a>

		</div>
		
		<div class="row-fluid options">

			<?php 			
			echo $this->Form->input('pages', array(
				'label'=>"Página(s):",
				'type'=>'text',
				'div'=>'span4',
				'placeholder'=>'ex: 1-5 or 2,3,4'
			));

			echo $this->Form->input('double_sided', array(
				'label'=>"Frente e verso:",
				'type'=>'select',
				'div'=>'span4',
				'empty'=>'Não - Um lado',
				'options'=>array(
					'two-sided-long-edge'=>'Sim - Virar na borda(padrão)',
					'two-sided-short-edge'=>'Sim - Virar na borda(short)',
				)
			));

			echo $this->Form->input('page_set', array(
				'label'=>"Apenas imprimir:",
				'type'=>'select',
				'div'=>'span4',
				'empty'=>'Todas folhas',
				'options'=>array(
					'even'=>'Folhas pares',
					'odd'=>'Folhas impares',					
				)
			));

		?>
		</div>
		<div class="row-fluid options">
				
		
		<?php 
			echo $this->Form->input('media', array(
				'label'=>"Tamanho do papel:",
				'type'=>'select',
				'div'=>'span4',
				'default'=>'A4',
				'options'=>array(
					'A3'=>'A3',
					'A4'=>'A4',
					'A5'=>'A5',
					'A6'=>'A6',
				)
			));

			echo $this->Form->input('orientation', array(
				'label'=>"Orientação",
				'type'=>'select',
				'div'=>'span4',
				'default'=>'3',
				'options'=>array(
					'3'=>'retrato',
					'4'=>'paisagem',
				)
			));

		 ?>
		</div>
		

		<div class="row-fluid">			
		<?php 
			echo $this->Form->input('file_dir', array(
				'type'=>'hide'
			));			

			echo $this->Form->input('params', array(
				'label'=>ucfirst(__('params')),
				'type'=>'hide',
			));

			echo $this->Form->input('printWebApp', array(
				'label'=>ucfirst(__('printWebApp')),
				'type'=>'hide',
			));

			echo $this->Form->input('status', array(
				'label'=>ucfirst(__('status')),
				'type'=>'hide',
			));

			echo $this->Form->input('status', array(
				'label'=>ucfirst(__('status')),
				'type'=>'hide',
				'value'=>1
			));

		 ?>
		</div>

		<div class="row-fluid">
			
			<div class="form-actions form-horizontal span12">
				<?php  echo $this->Html->link('Cancelar', 
					array('controller'=>'printers', 'action' => 'index'),
					array('class'=> 'btn btn-error')
				); ?>

				<?php
				echo $this->Form->button('Limpar', array(
					'type'=>'reset',
					'class'=>'btn btn-warning'
				))." ";
				echo $this->Form->button('Enviar', array(
					'class'=>'btn btn-success'
				));
				
				echo $this->Form->end();

				?>		
			</div>

		</div>
	</div>

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