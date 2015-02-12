<div class="row-fluid">

	
	<div class='span8'>
	    <dl>
			<dt><?php echo ucfirst(__('name')); ?></dt>
            <dd>
                <?php echo h($user['User']['name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo ucfirst(__('suap')); ?></dt>
            <dd>
                <?php echo h($user['User']['suap']); ?>
                &nbsp;
            </dd>
            <dt><?php echo ucfirst(__('email')); ?></dt>
            <dd>
                <?php echo h($user['User']['email']); ?>
                &nbsp;
            </dd>
			<dt><?php echo ucfirst(__('department')); ?></dt>
            <dd>
                <?php echo h($user['Department']['name']); ?>
                &nbsp;
            </dd>
			<dt><?php echo ucfirst(__('quota')); ?></dt>
            <dd>
                <?php echo h($user['User']['quota']); ?>
                &nbsp;
            </dd>
			<dt><?php echo ucfirst(__('created')); ?></dt>
            <dd>
                <?php echo h($user['User']['created']); ?>
                &nbsp;
            </dd>
			<dt><?php echo ucfirst(__('updated')); ?></dt>
            <dd>
                <?php echo h($user['User']['updated']); ?>
                &nbsp;
            </dd>
		</dl>
	</div>

	<div class="span4">
		<div class="actions form-horizontal well ucase">
			<a href="javascript:history.back()" class="btn btn-block">Voltar</a>
			
			<?php echo $this->Html->link('Sair', 
				array( 'action' => 'logout'),
				array('class'=> 'btn btn-block btn-info')
			); ?>

		</div>
	</div>

</div>


<div class="row-fluid">
		
		
<?php if (!empty($user['Job'])): ?>

		<h3>
			<a href="#"  id="Job">
				<?php echo __('Jobs'); ?></a>
		</h3>
		
	<div class="tabela " id="Job">
		<?php 
			// pr($prints);
		?>
	<table class='rwd-table'>
		<tr>
		<th><?php echo ucfirst(__('printer_id')); ?></th>
		<th><?php echo ucfirst(__('date')); ?></th>
		<th><?php echo ucfirst(__('pages')); ?></th>
		<th><?php echo ucfirst(__('copies')); ?></th>
		<th><?php echo ucfirst(__('host')); ?></th>
		<th><?php echo ucfirst(__('file')); ?></th>
		</tr>
		<?php foreach ($user['Job'] as $job): ?>
		<?php if ( !isset($job['id']))
			continue; ?>
		<tr>
			<td data-th="<?php echo ucfirst(__('printer_id')) ?>" >
				<?php echo $this->Html->link(
					ucfirst($prints[$job['printer_id']]), 
					array(
						'controller'=>'printers', 
						'action'=>'view', 
						$job['printer_id']
					)
				); ?>
			</td>
			<td data-th="<?php echo ucfirst(__('date')) ?>" ><?php echo $job['date']; ?></td>
			<td data-th="<?php echo ucfirst(__('pages')) ?>" ><?php echo $job['pages']; ?></td>
			<td data-th="<?php echo ucfirst(__('copies')) ?>" ><?php echo $job['copies']; ?></td>
			<td data-th="<?php echo ucfirst(__('host')) ?>" ><?php echo $job['host']; ?></td>
			<td data-th="<?php echo ucfirst(__('file')) ?>" ><?php echo $job['file']; ?></td>
			
		</tr>
	<?php endforeach; ?>
		</table>
	</div>

<?php endif; ?>


		

</div>
