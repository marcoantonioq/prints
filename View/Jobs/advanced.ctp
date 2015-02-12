<?php echo $this->Form->create('Filter'); ?>
<div class="row-fluid">

    <div class="span12 well">
		<?php 
			echo $this->Html->link('Nova Impressão',
				array('controller' => 'spools', 'action' => 'add'),
				array('class'=> 'btn btn-success')
			)." ";

			echo $this->Html->link('Menu', '#',
				array('class'=> 'btn btn-info','id'=>'btnmenu')
			)." ";

			echo $this->Html->link('Imprimir relatório',
				"#",
				array(
					'class'=> 'btn',
					"onclick"=>"window.print()"
				)
			);

		?> 
		<div id="rowmenus" class="row-fluid">
			    <br>
	
				<?php
					echo  $this->Form->button('Apagar', array(
					'class'=>'btn btn-block',
					'style'=>'margin-bottom: 10px;',
					'formaction'=> $_SERVER['REQUEST_URI']."/deleteall",
					)); 
				?>
			
		</div>
	</div>
</div>

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

<div class="row-fluid no-print">
	<div class="span12">		

	<?php 			
			$this->Form->inputDefaults(array(
				'label'=>false,
				'div'=>false,
				'class'=>'span6',
				'autocomplete'=>'off',
				'onfocus'=>'this.select();',
			));

			$options = array(
                '=' => 'igual',
                'LIKE' => 'contenha',
                'NOT LIKE' => 'não contenha',
                'LIKE BEGIN' => 'começando com',
                'LIKE END' => 'terminando com',
                '!=' => 'diferente',
                '>'  => 'maior do que',
                '>=' => 'maior ou igual a',
                '<'  => 'menor que',
                '<=' => 'menor ou igual a'
            );
			
	 ?>
	<div class="tabela">
		<table class='rwd-table'>
		<thead>
			<tr>
				<th class="btnFilter">
					<?php $this->Filter->img(); ?>

				</th>
												
				<th class="">
					<?php 
						echo $this->Paginator->sort('id', ucfirst(__('Job'))); 
					?>				
				</th>
												
				<th>
					<?php 
						echo $this->Paginator->sort('user_id', ucfirst(__('user_id'))); 
					?>				
				</th>
				
				<th>
					IF-ID
				</th>
												
				<th>
					<?php 
						echo $this->Paginator->sort('printer_id', ucfirst(__('printer_id'))); 
					?>				
				</th>
												
				<th>
					<?php 
						echo $this->Paginator->sort('date', ucfirst(__('date'))); 
					?>				
				</th>
												
				<th>
					<?php 
						echo $this->Paginator->sort('pages', ucfirst(__('pages'))); 
					?>				
				</th>
												
				<th>
					<?php 
						echo $this->Paginator->sort('copies', ucfirst(__('copies'))); 
					?>				
				</th>
												
				<th class="hide">
					<?php 
						echo $this->Paginator->sort('host', ucfirst(__('host'))); 
					?>				
				</th>
												
				<th>
					<?php 
						echo $this->Paginator->sort('file', ucfirst(__('file'))); 
					?>				
				</th>
		
				
				<th class="actions">
					<?php echo $this->Filter->limit( ); ?>
				</th>
			</tr>
			<tr id="filter">
				<td>
					<?php echo $this->Form->checkbox('all.row', array( 'id'=>'allrow' ));?>
				</td>
									
					<?php echo $this->Filter->conditions('id'); ?>
									
					<?php echo $this->Filter->conditions('User.name'); ?>
					
					<!-- 
					<?php echo $this->Filter->conditions('User.suap'); ?>
					 -->
					 <td></td>
									
					<?php echo $this->Filter->conditions('Printer.name'); ?>
									
					<?php echo $this->Filter->conditionsDate('date'); ?>
									
					<?php echo $this->Filter->conditions('pages'); ?>
									
					<?php echo $this->Filter->conditions('copies'); ?>
									
					<?php echo $this->Filter->conditions('host'); ?>
									
					<?php echo $this->Filter->conditions('file'); ?>
					
				<td>
					<?php 

						echo  $this->Form->button('Buscar', array(
							'class'=>'btn btn-success',
							'style'=>'margin-bottom: 10px;'
						)); 

						echo $this->Html->link('Limpar',
							array('action'=>'index'),
							array('class'=>'btn btn-warning')
						);

					 ?>

				</td>
			</tr>
		</thead>

	<?php 
		foreach ($jobs as $job): 
		if ( !isset($job['Job']['id']))
			continue;
	 ?>
	<tr>

		<td data-th='Selecionar' >
			<?php echo $this->Form->checkbox('row.'.$job['Job']['id'], array( 'class'=>'rowfilter' ));?>
		</td>

		<td data-th="<?php echo ucfirst(__('id'));?>" >
			<?php echo h($job['Job']['id']); ?>
			&nbsp;
		</td>

		<td data-th="<?php echo ucfirst(__('user_id'));?>" >
			<?php echo $this->Html->link(ucfirst($job['User']['name']), array('controller' => 'users', 'action' => 'view', $job['User']['id'])); ?>
		</td>

		<td data-th="suap" >
			<?php echo $this->Html->link(ucfirst($job['User']['suap']), array('controller' => 'users', 'action' => 'view', $job['User']['id'])); ?>
		</td>

		<td data-th="<?php echo ucfirst(__('printer_id'));?>" >
			<?php echo $this->Html->link($job['Printer']['name'], array('controller' => 'printers', 'action' => 'view', $job['Printer']['id'])); ?>
		</td>

		<td data-th="<?php echo ucfirst(__('date'));?>" >
			<?php echo h($job['Job']['date']); ?>
			&nbsp;
		</td>

		<td data-th="<?php echo ucfirst(__('pages'));?>" >
			<?php echo h($job['Job']['pages']); ?>
			&nbsp;
		</td>

		<td data-th="<?php echo ucfirst(__('copies'));?>" >
			<?php echo h($job['Job']['copies']); ?>
			&nbsp;
		</td>

		<td data-th="<?php echo ucfirst(__('host'));?>" >
			<?php echo h($job['Job']['host']); ?>
			&nbsp;
		</td>

		<td data-th="<?php echo ucfirst(__('file'));?>" >
			<?php echo h($job['Job']['file']); ?>
			&nbsp;
		</td>

			<td data-th='Ações' class="actions">
				
				<?php 
				echo $this->Html->link('<span class="icon12 brocco-icon-search"></span>', 
					array(
						'action' => 'view', 
						$job['Job']['id']
					),
					array(
						'escape'=>false,
						'title'=>'Visualizar',
						'class'=>'view',
					)
				); ?>				
				
				<?php 
				echo $this->Html->link('<span class="icon12 brocco-icon-pencil"></span>', 
					array(
						'action' => 'edit', 
						$job['Job']['id']
					),
					array(
						'escape'=>false,
						'class'=>'edit',
						'title'=>'Editar',
					)
				); ?>
			</td>

	
	</tr>

	<?php endforeach; ?>
	</table>

	</div>

	<?php echo $this->element('layout/pagination'); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>