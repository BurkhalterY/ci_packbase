<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?=form_open()?>
	<?php if(!empty(validation_errors())){ ?>
		<div class="alert alert-danger">
			<?=validation_errors()?>
		</div>
	<?php } ?>
	<div class="form-group">
		<?=form_label(lang('username'), 'username')?>
		<?=form_input('username', set_value('username'), ['id' => 'username', 'class' => 'form-control'])?>
	</div>
	<div class="form-group">
		<?=form_label(lang('email'), 'email')?>
		<?=form_input('email', set_value('email'), ['id' => 'email', 'class' => 'form-control'])?>
	</div>
	<div class="form-group">
		<?=form_label(lang('password'), 'password')?>
		<?=form_password('password', set_value('password'), ['id' => 'password', 'class' => 'form-control'])?>
	</div>
	<div class="form-group">
		<?=form_label(lang('passconf'), 'passconf')?>
		<?=form_password('passconf', set_value('passconf'), ['id' => 'passconf', 'class' => 'form-control'])?>
	</div>
	<?=form_submit('submit', lang('btn_register'), ['class' => 'btn btn-primary'])?>
<?=form_close()?>