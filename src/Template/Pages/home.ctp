<!-- NORMAL VERSION -->
<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

?>
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
    <?php Debugger::checkSecurityKeys(); ?>
	<h3>Welcome to Puntoon - this is a holding page</h3>
    <ul>
		<li><?= $this->Html->link(__('May Leader Board'), array('controller' => 'entries', 'action' => 'leader-board',7)); ?></li>
		<?php if ($this->request->session()->read('Auth.User.role')== 'admin'):?>
			<li><?= $this->Html->link(__('API Auto Update'), array('controller' => 'fixtures', 'action' => 'auto_update')); ?> </li>
			<li><?= $this->Html->link(__('Update Results'), array('controller' => 'fixtures', 'action' => 'results')); ?> </li>
			<li><?= $this->Html->link(__('Tournaments'), array('controller' => 'tournaments', 'action' => 'index')); ?> </li>
			<li><?= $this->Html->link(__('Update Fixtures'), array('controller' => 'fixtures', 'action' => 'index')); ?> </li>
			<li><?= $this->Html->link(__('All Fixtures'), array('controller' => 'fixtures', 'action' => 'all')); ?> </li>
		<?php endif;?>
		<li><?= $this->Html->link(__('Organise a Competition'), array('controller' => 'competitions', 'action' => 'add')); ?></li>
	</ul>
	</body>
</html>

