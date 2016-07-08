<?php
use Weconstudio\Misc\U;
use \App\Models\User;
/* @var $user User */
$subject = $user->getSubject();
if(!$subject instanceof \App\Models\Subject) abort(500);
?>

@extends ('user.page')
@section('page_title')
	<?php echo \Weconstudio\Misc\U::T_('Visualizza/Modifica utente') ?>
@endsection

@section('content')
	<div style="padding: 12px;">
		<form id="frmUser" data-id="<?php echo $user->getId() ?>" action="{{ url('user') }}">
			<fieldset class="col-sm-4">
				<label for="email"><?php echo U::T_("Email"); ?></label>
				<input type="text" class="form-control" id="email" name="email" value="<?php echo old('email') ? old('email') : $user->getEmail(); ?>">
			</fieldset>
			<fieldset class="col-sm-4">
				<label for="username"><?php echo U::T_("Username"); ?></label>
				<input disabled type="text" class="form-control" id="username" value="<?php echo $user->getUsername(); ?>">
			</fieldset>
			<fieldset class="col-sm-4">
				<label for="iso"><?php echo U::T_("Lingua"); ?></label>
				<select name="iso" class="form-control">
					<option value="it_IT" <?php echo old('iso') == "it_IT" ? "selected" : $subject->getIso() == "it_IT" ? : ""; ?>><?php echo U::T_("Italiano"); ?></option>
					<option value="en_EN" <?php echo old('iso') == "en_EN" ? "selected" : $subject->getIso() == "en_EN" ? : ""; ?>><?php echo U::T_("Inglese"); ?></option>
					<option value="fr_FR" <?php echo old('iso') == "fr_FR" ? "selected" : $subject->getIso() == "fr_FR" ? : ""; ?>><?php echo U::T_("Francese"); ?></option>
					<option value="es_ES" <?php echo old('iso') == "es_ES" ? "selected" : $subject->getIso() == "es_ES" ? : ""; ?>><?php echo U::T_("Spagnolo"); ?></option>
					<option value="de_DE" <?php echo old('iso') == "de_DE" ? "selected" : $subject->getIso() == "de_DE" ? : ""; ?>><?php echo U::T_("Tedesco"); ?></option>
				</select>
			</fieldset>
			<div class="clearfix"></div>
			<hr>
			<fieldset class="col-sm-4">
				<label for="first_name"><?php echo U::T_("Nome"); ?></label>
				<input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo old('first_name') ? old('first_name') : $subject->getFirstName(); ?>">
			</fieldset>
			<fieldset class="col-sm-4">
				<label for="last_name"><?php echo U::T_("Cognome"); ?></label>
				<input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo old('last_name') ? old('last_name') : $subject->getLastName(); ?>">
			</fieldset>

			<fieldset class="col-sm-4">
				<label for="address"><?php echo U::T_("Indirizzo"); ?></label>
				<input type="text" class="form-control" id="address" name="address" value="<?php echo old('address') ? old('address') : $subject->getAddress(); ?>">
			</fieldset>
			<fieldset class="col-sm-4">
				<label for="zip"><?php echo U::T_("Codice Postale"); ?></label>
				<input type="text" class="form-control" id="zip" name="zip" value="<?php echo old('zip') ? old('zip') : $subject->getZip(); ?>">
			</fieldset>
			<fieldset class="col-sm-4">
				<label for="city"><?php echo U::T_("Città"); ?></label>
				<input type="text" class="form-control" id="city" name="city" value="<?php echo old('city') ? old('city') : $subject->getZip(); ?>">
			</fieldset>
			<fieldset class="col-sm-4">
				<label for="province"><?php echo U::T_("Provincia"); ?></label>
				<input type="text" class="form-control" id="province" name="province" value="<?php echo old('province') ? old('province') : $subject->getProvince(); ?>">
			</fieldset>
			<fieldset class="col-sm-4">
				<label for="country"><?php echo U::T_("Paese"); ?></label>
				<input type="text" class="form-control" id="country" name="country" value="<?php echo old('country') ? old('country') : $subject->getCountry(); ?>">
			</fieldset>
			<fieldset class="col-sm-4">
				<label for="phone"><?php echo U::T_("Telefono"); ?></label>
				<input type="text" class="form-control" id="phone" name="phone" value="<?php echo old('phone') ? old('phone') : $subject->getPhone(); ?>">
			</fieldset>
			<fieldset class="col-sm-4">
				<label for="fax"><?php echo U::T_("FAX"); ?></label>
				<input type="text" class="form-control" id="fax" name="fax" value="<?php echo old('fax') ? old('fax') : $subject->getFax(); ?>">
			</fieldset>
			<fieldset class="col-sm-4">
				<label for="notes"><?php echo U::T_("Note"); ?></label>
				<input type="text" class="form-control" id="notes" name="notes" value="<?php echo old('notes') ? old('notes') : $subject->getNotes(); ?>">
			</fieldset>
			<div class="clearfix"></div>

			<div class="form-actions center">
				<a href="javascript:history.back()" class="btn btn-grey">
					<i class="ace-icon fa fa-arrow-left"></i>
					<?php echo U::T_('Back') ?>
				</a>
				<button data-interaction="save" data-reload="1" data-error="<?php echo U::T_("Errore salvataggio Utente!"); ?>" type="submit" class="btn btn-info">
					<i class="fa fa-save"></i>
					<?php echo U::T_("Save")?>
				</button>
			</div>
		</form>
	</div>

	<script>
		$(function() {
			new crud({
				form: 'frmUser'
			});
		});
	</script>
@endsection