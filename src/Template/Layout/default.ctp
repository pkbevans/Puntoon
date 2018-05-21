<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$puntoonDescription = __d ( 'cake_dev', 'Puntoon: Footy Fun For F-wits' );
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $puntoonDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

<!-- <?= $this->Html->css('base.css') ?> -->
    <?= $this->Html->css('puntoon.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
	<div id="container">
		<div id="header">
			<table>
				<tr>
					<td class="logo">
						<?= $this->Html->link ($this->Html->image('puntoonlogo.png', array('alt' => $puntoonDescription, 'border' => '0')),"/", array ('escape' => false) ); ?>
						<span class="logo">Puntoon</span>
					</td>
					<td>
					<?php if ($this->request->session()->read('Auth.User.id')): ?>
   							Hi <?= $this->request->session()->read('Auth.User.firstname') ?>
						<?= $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'));?>
   					<?php else: 
	   					echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login'));
   					endif;
   					?>
   					&nbsp;
   					<?php
   					echo $this->Html->link(__('My Punts'), array('controller' => 'entries', 'action' => 'mine'));
   					?>
   					&nbsp;
   					<?php
   					echo $this->Html->link(__('My Competitions'), array('controller' => 'competitions', 'action' => 'mine'));
   					?>
   					&nbsp;
   					<?php
   					echo $this->Html->link(__('All Competitions'), array('controller' => 'competitions', 'action' => 'index'));
   					?>
   					</td>
   					<td>
						<?php echo $this->Flash->render(); ?>
   					</td>
   					
				</tr>
			</table>
		</div>
		<div id="content">
			<?= $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php
			echo $this->Html->link ($this->Html->image('cake.power.gif',  array ('alt' => $puntoonDescription,	'border' => '0')), 'http://www.cakephp.org/', array (
					'target' => '_blank',
					'escape' => false,
					'id' => 'cake-powered' 
			) );
			?>
		</div>
	</div>
	</body>
</html>
