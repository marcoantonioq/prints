<div class="row-fluid">
    <div class="span12 well">
		<?php echo $this->Html->link('Novo '.__('user'),
				array('controller' => 'users', 'action' => 'add'),
				array('class'=> 'btn btn-success')
			)." ";

			echo $this->Html->link('Menu', '#',
				array('class'=> 'btn btn-info','id'=>'btnmenu')
			)." ";

			echo $this->Html->link('Sair',
				array('app'=>true, 'controller' => 'users', 'action' => 'logout'),
				array('class'=> 'btn')
			);

		?> 
		<div id="rowmenus" class="row-fluid">
			<br>
			    <?php echo $this->Html->link('Novo '.__('user'),
						array('controller' => 'users', 'action' => 'add'),
						array('class'=> 'btn btn-block btn-success')
					);
			    ?> 
			    
			    <?php echo $this->Html->link('Sincronizar AD',
						array('controller' => 'users', 'action' => 'syc'),
						array('class'=> 'btn btn-block')
					);
			    ?> 

			    <?php echo $this->Html->link('Departamentos',
						array('controller' => 'departments', 'action' => 'index'),
						array('class'=> 'btn btn-block')
					);
			    ?>

			
		</div>
	</div>
</div>

<div class="row-fluid">
	<?php 
			echo $this->Form->create('Filter');
	 ?>

	<div class="tabela">
		<table class='rwd-table'>
		<thead>
			<tr>
				<th class="btnFilter">
					<?php $this->Filter->img(); ?>
				</th>
												
				<th class="hide">
					<?php 
						echo $this->Paginator->sort('id', ucfirst(__('id'))); 
					?>				
				</th>
												
				<th>
					<?php 
						echo $this->Paginator->sort('name', ucfirst(__('name'))); 
					?>				
				</th>
												
				<th>
					<?php 
						echo $this->Paginator->sort('department_id', ucfirst(__('department'))); 
					?>				
				</th>
												
				<th>
					<?php 
						echo $this->Paginator->sort('quota', ucfirst(__('quota'))); 
					?>				
				</th>
													
				<th>
					<?php 
						echo $this->Paginator->sort('status', ucfirst(__('status'))); 
					?>				
				</th>
												
				<th class="hide">
					<?php 
						echo $this->Paginator->sort('created', ucfirst(__('created'))); 
					?>				
				</th>
												
				<th class="hide">
					<?php 
						echo $this->Paginator->sort('updated', ucfirst(__('updated'))); 
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
									
					<?php echo $this->Filter->conditions('name'); ?>
									
					<?php echo $this->Filter->conditionsSelect('department_id', $departments); ?>
									
					<?php echo $this->Filter->conditions('Department.quota'); ?>
					
					<?php echo $this->Filter->conditions('status'); ?>
									
					<?php echo $this->Filter->conditions('created'); ?>
									
					<?php echo $this->Filter->conditions('updated'); ?>
								
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
	</table>
	</div>
</div>
<div class="row-fluid">
	<?php 
		// pr($users); 
	?>
	 <?php foreach ($users as $user): ?>
			<table class="profile borderGreen">
				<tr>
					<!-- <td>
						<?php echo $this->Html->image("/img/icons/users.png", array(
							'class'=>'iconprofile',
							'title'=>$user['User']['name'],
							'url' => array('action'=>'view', $user['User']['id'])
						)); ?>						
					</td> -->
					<td>
						<b><?php echo ucfirst($user['User']['name']); ?></b><br>
						SIAP: <?php echo ucfirst($user['User']['suap']); ?><br>
						Quota: <?php echo (empty($user['User']['department_id'])) ? "nenhum grupo" : $user['Department']['quota']; ?><br>
						Status: <?php echo $this->Link->status($user['User']['id'], $user['User']['status']); ?><br>
						Impressões: 
						<?php echo $this->Html->link(
							"", 
							array(
								"controller"=>"users",
								'action'=>"printerCount",
								$user['User']['id']
							), 
							array('class'=>"updateAjax impressoes")); 
						?> <br>
						<?php echo $this->Html->link('a', 
							array('action'=>'view', $user['User']['id']),
							array('class'=>'hide link')
						); ?>
					</td>
				</tr>
			</table>
		<?php endforeach; ?>
</div>
<div class="row-fluid">
	<div class="span12">		

	<?php echo $this->element('layout/pagination'); ?>
   	<?php echo $this->Form->end(); ?>
	</div>
</div>