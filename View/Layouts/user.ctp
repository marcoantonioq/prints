<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset('UTF-8'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		IFG: <?php echo __($title_for_layout); ?>
	</title>	
	<?php
	setlocale(LC_ALL, 'pt_BR.utf-8', 'pt_BR', 'pt-br');
	
	echo $this->Html->meta('icon');

	echo $this->Html->css(array(
		'/bootstrap/css/bootstrap.min.css',
		'/bootstrap/css/bootstrap-responsive.min.css',
		'admin.css',
		'print.css',
		"icons.css",
	));

	echo $this->Html->script(
		array(
			'jquery.js',
			'/bootstrap/js/bootstrap.min.js',
			'ckeditor/ckeditor.js',
			'jquery.mask.min.js',
			'admin.js',
			'ajax.js',
			'spool.js',
			'print.js',
			'stupidtable.js',
		)
	);

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
	
</head>
<body>
	<div class="row-fluid">		
		<div class="logo topHeader">
			<img src="/img/ifg.jpg" width='250px' >
		</div>
	
		<?php 
			echo $this->element('admin/user_menu');
		?>		
	</div>
	
	<div id="container">
		
		<div class="row-fluid no-print">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>
		</div>

		<div id="content" class="print">
			<?php 
				echo $this->fetch('content'); 
			?>
		</div>

	</div>
	
	<div id="footer">			
		<?php echo $this->element('sql_dump'); ?>
	</div>
	
	<div id="print">&nbsp; </div>	
</body>
</html>
