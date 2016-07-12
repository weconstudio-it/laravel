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
			<input type="hidden" id="currency" name="currency" value="<?php echo old('currency') ? old('currency') : $user->getCurrency() instanceof \App\Models\Currency ? $user->getCurrency()->getShortName() : "EUR"; ?>">
			<fieldset class="col-sm-4">
				<label for="email"><?php echo U::T_("Email"); ?></label>
				<input type="text" class="form-control" id="email" name="email" value="<?php echo old('email') ? old('email') : $user->getEmail(); ?>">
			</fieldset>
			<fieldset class="col-sm-4">
				<label for="username"><?php echo U::T_("Username"); ?></label>
				<input disabled type="text" class="form-control" id="username" value="<?php echo $user->getUsername(); ?>">
			</fieldset>
			<fieldset class="col-sm-2">
				<label for="id_language"><?php echo U::T_("Lingua"); ?></label>
				<select id="id_language" name="id_language" class="form-control">
					<option value="">-- <?php echo U::T_("Seleziona la tua lingua"); ?> --</option>
					<?php foreach(\App\Models\LanguageQuery::create()->find() as $lang) : ?>
					<option value="<?php echo $lang->getId(); ?>" <?php echo old('id_language') == $lang->getId() ? "selected" : $user->getIdLanguage() == $lang->getId() ? "selected" : ""; ?>><?php echo $lang->getDescription(); ?></option>
					<?php endforeach; ?>
				</select>
			</fieldset>
			<fieldset class="col-sm-2">
				<label for="id_currency"><?php echo U::T_("Valuta"); ?></label>
				<select id="id_currency" name="id_currency" class="form-control">
					<option value="">-- <?php echo U::T_("Seleziona la tua valuta"); ?> --</option>
					<?php foreach(\App\Models\CurrencyQuery::create()->orderByShortName()->find() as $currency) : ?>
					<option value="<?php echo $currency->getId(); ?>" <?php echo old('id_currency') == $currency->getId() ? "selected" : $user->getIdCurrency() == $currency->getId() ? "selected" : ""; ?>><?php echo $currency->getShortName(); ?></option>
					<?php endforeach; ?>
				</select>
			</fieldset>
			<div class="clearfix"></div>
			<?php if($user->getId() == \Auth::user()->getId()) : ?>
				<fieldset class="col-sm-4">
					<label for="password"><?php echo U::T_("Password"); ?> <small>(<?php echo U::T_("Opzionale"); ?>)</small></label>
					<input type="password" class="form-control" id="password" name="password">
				</fieldset>
				<fieldset class="col-sm-4">
					<label for="password_confirmation"><?php echo U::T_("Ripeti password"); ?> <small>(<?php echo U::T_("Opzionale"); ?>)</small></label>
					<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
				</fieldset>
				<div class="clearfix"></div>
			<?php endif; ?>
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
				<select id="country" name="country" class="form-control">
					<option value="">- select your country -</option>
					<option data-currency="EUR" value="Austria" <?php echo old("country") == "Austria" ? "selected" : $user->getSubject()->getCountry() == "Austria" ? "selected" : ""; ?>>Austria</option>
					<option data-currency="EUR" value="Belgium" <?php echo old("country") == "Belgium" ? "selected" : $user->getSubject()->getCountry() == "Belgium" ? "selected" : ""; ?>>Belgium</option>
					<option data-currency="EUR" value="Bulgaria" <?php echo old("country") == "Bulgaria" ? "selected" : $user->getSubject()->getCountry() == "Bulgaria" ? "selected" : ""; ?>>Bulgaria</option>
					<option data-currency="EUR" value="Cyprus" <?php echo old("country") == "Cyprus" ? "selected" : $user->getSubject()->getCountry() == "Cyprus" ? "selected" : ""; ?>>Cyprus</option>
					<option data-currency="EUR" value="Czech Republic" <?php echo old("country") == "Czech Republic" ? "selected" : $user->getSubject()->getCountry() == "Czech Republic" ? "selected" : ""; ?>>Czech Republic</option>
					<option data-currency="EUR" value="Denmark" <?php echo old("country") == "Denmark" ? "selected" : $user->getSubject()->getCountry() == "Denmark" ? "selected" : ""; ?>>Denmark</option>
					<option data-currency="EUR" value="Estonia" <?php echo old("country") == "Estonia" ? "selected" : $user->getSubject()->getCountry() == "Estonia" ? "selected" : ""; ?>>Estonia</option>
					<option data-currency="EUR" value="Finland" <?php echo old("country") == "Finland" ? "selected" : $user->getSubject()->getCountry() == "Finland" ? "selected" : ""; ?>>Finland</option>
					<option data-currency="EUR" value="France" <?php echo old("country") == "France" ? "selected" : $user->getSubject()->getCountry() == "France" ? "selected" : ""; ?>>France</option>
					<option data-currency="EUR" value="Germany" <?php echo old("country") == "Germany" ? "selected" : $user->getSubject()->getCountry() == "Germany" ? "selected" : ""; ?>>Germany</option>
					<option data-currency="EUR" value="Greece" <?php echo old("country") == "Greece" ? "selected" : $user->getSubject()->getCountry() == "Greece" ? "selected" : ""; ?>>Greece</option>
					<option data-currency="EUR" value="Hungary" <?php echo old("country") == "Hungary" ? "selected" : $user->getSubject()->getCountry() == "Hungary" ? "selected" : ""; ?>>Hungary</option>
					<option data-currency="EUR" value="Ireland" <?php echo old("country") == "Ireland" ? "selected" : $user->getSubject()->getCountry() == "Ireland" ? "selected" : ""; ?>>Ireland</option>
					<option data-currency="EUR" value="Italy" <?php echo old("country") == "Italy" ? "selected" : $user->getSubject()->getCountry() == "Italy" ? "selected" : ""; ?>>Italy</option>
					<option data-currency="EUR" value="Latvia" <?php echo old("country") == "Latvia" ? "selected" : $user->getSubject()->getCountry() == "Latvia" ? "selected" : ""; ?>>Latvia</option>
					<option data-currency="EUR" value="Lithuania" <?php echo old("country") == "Lithuania" ? "selected" : $user->getSubject()->getCountry() == "Lithuania" ? "selected" : ""; ?>>Lithuania</option>
					<option data-currency="EUR" value="Luxembourg" <?php echo old("country") == "Luxembourg" ? "selected" : $user->getSubject()->getCountry() == "Luxembourg" ? "selected" : ""; ?>>Luxembourg</option>
					<option data-currency="EUR" value="Malta" <?php echo old("country") == "Malta" ? "selected" : $user->getSubject()->getCountry() == "Malta" ? "selected" : ""; ?>>Malta</option>
					<option data-currency="EUR" value="Netherlands" <?php echo old("country") == "Netherlands" ? "selected" : $user->getSubject()->getCountry() == "Netherlands" ? "selected" : ""; ?>>Netherlands</option>
					<option data-currency="EUR" value="Poland" <?php echo old("country") == "Poland" ? "selected" : $user->getSubject()->getCountry() == "Poland" ? "selected" : ""; ?>>Poland</option>
					<option data-currency="EUR" value="Portugal" <?php echo old("country") == "Portugal" ? "selected" : $user->getSubject()->getCountry() == "Portugal" ? "selected" : ""; ?>>Portugal</option>
					<option data-currency="EUR" value="Romania" <?php echo old("country") == "Romania" ? "selected" : $user->getSubject()->getCountry() == "Romania" ? "selected" : ""; ?>>Romania</option>
					<option data-currency="EUR" value="Slovakia" <?php echo old("country") == "Slovakia" ? "selected" : $user->getSubject()->getCountry() == "Slovakia" ? "selected" : ""; ?>>Slovakia</option>
					<option data-currency="EUR" value="Slovenia" <?php echo old("country") == "Slovenia" ? "selected" : $user->getSubject()->getCountry() == "Slovenia" ? "selected" : ""; ?>>Slovenia</option>
					<option data-currency="EUR" value="Spain" <?php echo old("country") == "Spain" ? "selected" : $user->getSubject()->getCountry() == "Spain" ? "selected" : ""; ?>>Spain</option>
					<option data-currency="EUR" value="Sweden" <?php echo old("country") == "Sweden" ? "selected" : $user->getSubject()->getCountry() == "Sweden" ? "selected" : ""; ?>>Sweden</option>
					<option data-currency="EUR" value="United Kingdom" <?php echo old("country") == "United Kingdom" ? "selected" : $user->getSubject()->getCountry() == "United Kingdom" ? "selected" : ""; ?>>United Kingdom</option>
				</select>
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
			new register();
			new crud({
				form: 'frmUser'
			});
		});
	</script>
@endsection