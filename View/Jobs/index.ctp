<?php echo $this->Form->create('Filter'); ?>
<div class="row-fluid">

    <div class="span12 well">
		<?php 
			echo $this->Html->link('Imprimir relatório',
				"#",
				array(
					'class'=> 'btn',
					"onclick"=>"window.print()"
				)
			)." ";

			echo $this->Html->link('Avançado',
				array('controller' => 'jobs', 'action' => 'advanced'),
				array('class'=> 'btn btn-success')
			);

		?> 
	</div>
</div>

<div class="row-fluid no-print">
	<div class="span12">		

		<br>Identificador (jobs):<br>
		<?php echo $this->Filter->conditions('id', array('class'=>'span4')); ?>
							
		<br>Nome do Usuário:<br>
		<?php echo $this->Filter->conditions('User.name', array('class'=>'span4')); ?>
		
		<!-- <br>SUAP:<br>
		<?php echo $this->Filter->conditions('User.suap', array('class'=>'span4')); ?> -->
		 
		<br>Nome da Impressora:<br>
		<?php echo $this->Filter->conditions('Printer.name', array('class'=>'span4')); ?>
						
		<br>Data:<br>
		<?php echo $this->Filter->conditionsDate('date', array('class'=>'span4')); ?>
						
		<br>Paginas:<br>
		<?php echo $this->Filter->conditions('pages', array('class'=>'span4')); ?>
						
		<br>Copias:<br>
		<?php echo $this->Filter->conditions('copies', array('class'=>'span4')); ?>
						
		<br>Computador (IP):<br>
		<?php echo $this->Filter->conditions('host', array('class'=>'span4')); ?>
						
		<br>Arquivo:<br>
		<?php echo $this->Filter->conditions('file', array('class'=>'span4')); ?>
		
		</p>

		<div class="row-fluid">
			
			<div class="form-actions form-horizontal span12">
				
				<?php
				echo $this->Form->button('<i class="icon-ok-sign"></i> Buscar', array(
					'class'=>'btn btn-success'
				))." ";
				
				echo $this->Html->link('<i class="icon-remove-sign"></i> Cancelar', 
					array('action' => 'index'),
					array('class'=> 'btn btn-error', 'escape'=>false)
				);

				
				echo $this->Form->end();

				?>		
			</div>

		</div>

	</div>
</div>
<?php echo $this->Form->end(); ?>

<div class="row-fluid">
<div class="span12">
		
	<?php 
		//pr($jobs); 
	?>

</head>
		<!-- Table users -->
		<?php if(!empty($jobs['User'])): ?>
		<table class='table rwd-table'>
			<thead>
				<tr>
					<th data-sort="string">
						<a href="#">Usuário</a>
					</th>
					<th data-sort="int" data-th="Páginas">
						 <a href="#">Páginas</a>
					</th>
				</tr>
			</thead>

		<?php foreach ($jobs['User'] as $name => $user): ?>
			<tr>
				<td data-sort="string" data-th="<?php echo ucfirst(__('user'));?>" >
					<?php echo ucfirst($name); ?>
				</td>
				<td data-sort="int" data-th="Páginas">
					<?php echo $user['total_pages']; ?>
				</td>
			</tr>

		<?php endforeach; ?>
		
		</table>

		</p>

		<?php 
			endif;
			if(!empty($jobs['User'])):
		 ?>

		<!-- Table prints -->
		<table class='table rwd-table'>
			<thead>
				<tr>
					<th data-sort="string">
						<a href="#">Impressora</a>						
					</th>
					<th data-sort="int">
						<a href="#">Páginas</a>
					</th>
				</tr>
			</thead>
		<?php $total = 0; ?>
		<?php foreach ($jobs['Printer'] as $name => $printer): ?>
			<tr>
				<td data-th="<?php echo ucfirst(__('printer'));?>" >
					<?php echo ucfirst($name); ?>
				</td>
				<td data-th="Total de páginas">
					<?php 
						$total += $printer['total_pages'];
						echo $printer['total_pages']; 
					?>
				</td>
			</tr>

		<?php endforeach; ?>
		</table>
		<table class='table'>
			<tr>
				<td>
					<b>Total páginas:</b>
				</td>
				<td>
					<?php echo $jobs['Results']['total']; ?>					
				</td>
			</tr>
		</table>

		</p>
		<?php endif; ?>

	</div>
</div>
