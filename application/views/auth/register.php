<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?=form_open()?>
	<?php if(!empty(validation_errors())){ ?>
		<div class="alert alert-danger">
			<?=validation_errors()?>
		</div>
	<?php } ?>
	<div class="form-group">
		<?=form_label('Nom d\'utilisateur', 'username')?>
		<?=form_input('username', set_value('username'), ['id' => 'username', 'class' => 'form-control'])?>
	</div>
	<div class="form-group">
		<?=form_label('Adresse e-mail', 'email')?>
		<?=form_input('email', set_value('email'), ['id' => 'email', 'class' => 'form-control'])?>
	</div>
	<div class="form-group">
		<?=form_label('Mot de passe', 'password')?>
		<?=form_password('password', set_value('password'), ['id' => 'password', 'class' => 'form-control'])?>
	</div>
	<div class="form-group">
		<?=form_label('Confirmation de mot de passe', 'passconf')?>
		<?=form_password('passconf', set_value('passconf'), ['id' => 'passconf', 'class' => 'form-control'])?>
	</div>
	<?=form_submit('submit', 'S\'inscrire', ['class' => 'btn btn-primary'])?>
<?=form_close()?>