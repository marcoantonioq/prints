<div class="row-fluid">

	
	<div class='span8'>
	    <dl>
			<dt><?php echo ucfirst(__('id')); ?></dt>
            <dd>
                <?php echo h($department['Department']['id']); ?>
                &nbsp;
            </dd>
			<dt><?php echo ucfirst(__('name')); ?></dt>
            <dd>
                <?php echo h($department['Department']['name']); ?>
                &nbsp;
            </dd>
			<dt><?php echo ucfirst(__('quota')); ?></dt>
            <dd>
                <?php echo h($department['Department']['quota']); ?>
                &nbsp;
            </dd>
		</dl>
	</div>

	<div class="span4">
		<div class="actions form-horizontal well ucase">
			<h3>Ações</h3>
			
			<?php echo $this->Html->link('Voltar', 
				array( 'action' => 'index'),
				array('class'=> 'btn btn-block')
			); ?>

			<?php echo $this->Html->link('Novo '.__('department'),
                array( 'action' => 'add'),
                array('class'=> 'btn btn-block btn-success')
            ); ?>
            <?php echo $this->Html->link('Editar',
                array( 'action' => 'edit', $this->params['pass'][0]),
                array('class'=> 'btn btn-block btn-warning')
            ); ?>			
			<?php echo $this->Form->postLink('Apagar',
				array( 'action' => 'delete', $this->params['pass'][0]),
                array('class'=> 'btn btn-block btn-danger', 'style'=>'margin-top: 5px;'),
                __('Tem certeza de que deseja excluir?')
			);?>
		</div>
	</div>
</div>


<div class="row-fluid">
		
		
<?php if (!empty($department['User'])): ?>

		<h3>
			<a href="#"  id="User">
				<?php echo __('Users'); ?>			</a>
		</h3>
		
	<div class="tabela " id="User">
	<table class='rwd-table'>
		<tr>
			<th><?php echo __('id'); ?></th>
		<th><?php echo __('name'); ?></th>
		<th><?php echo __('department_id'); ?></th>
		<th><?php echo __('quota'); ?></th>
		<th><?php echo __('job_count'); ?></th>
		<th><?php echo __('created'); ?></th>
		<th><?php echo __('updated'); ?></th>
			<th data-th="Ações" class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($department['User'] as $user): ?>
		<tr>
			<td data-th="<?php echo ucfirst(__('id')) ?>" ><?php echo $user['id']; ?></td>
			<td data-th="<?php echo ucfirst(__('name')) ?>" ><?php echo $user['name']; ?></td>
			<td data-th="<?php echo ucfirst(__('department_id')) ?>" ><?php echo $user['department_id']; ?></td>
			<td data-th="<?php echo ucfirst(__('quota')) ?>" ><?php echo $user['quota']; ?></td>
			<td data-th="<?php echo ucfirst(__('job_count')) ?>" ><?php echo $user['job_count']; ?></td>
			<td data-th="<?php echo ucfirst(__('created')) ?>" ><?php echo $user['created']; ?></td>
			<td data-th="<?php echo ucfirst(__('updated')) ?>" ><?php echo $user['updated']; ?></td>
			<td data-th="Ações" class="actions">

			<?php 
				echo $this->Html->link('<span class="icon12 brocco-icon-search"></span>', 
					array(
						'controller' => 'users', 
						'action' => 'view', 
						$user['id']
					),
					array(
						'escape'=>false,
						'title'=>'Visualizar',
						'class'=>'view',
					)
				); 
				
				echo $this->Html->link('<span class="icon12 brocco-icon-pencil"></span>', 
					array(
						'controller' => 'users', 
						'action' => 'edit', 
						$user['id']
					),
					array(
						'escape'=>false,
						'class'=>'edit',
						'title'=>'Editar',
					)
				);

			?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
	</div>

<?php endif; ?>


		

</div>
