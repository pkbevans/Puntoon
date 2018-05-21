<div class="users form">
<?= $this->Flash->render('auth'); ?>
<?= $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?= __('Please enter your username and password'); ?>
        </legend>
        <?= $this->Form->input('username');
        echo $this->Form->input('password');?>
        <?= $this->Form->checkbox('rememberMe', ['selected'=>'false']);?> &nbsp;Remember Me
    </fieldset>
	<?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?= __('Actions'); ?></h3>
	<ul>
		<?= $this->Html->link(__('Register'), array('controller' => 'users', 'action' => 'register')); ?> 
	</ul>
</div>
