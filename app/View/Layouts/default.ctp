<?php

$cakeDescription = __d('cake_dev', 'Hamburgueria do Sr.Val');

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-grid.min');
        echo $this->Html->css('bootstrap-reboot.min');
        //echo $this->Html->css('dropzone');
		echo $this->Html->css('album');
		echo $this->Html->script('jquery-1.11.1.min');
        echo $this->Html->script('jquery.maskedinput.min');
        //echo $this->Html->script('dropzone');
		echo $this->Html->script('bootstrap.bundle.min');
		

	?>
	<script src="https://kit.fontawesome.com/08e32008c1.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="content">
	<?php echo $this->fetch('content'); ?>
</div>
</body>
</html>
