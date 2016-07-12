<?php use Weconstudio\Misc\U; ?>

@extends('login')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="login-container">
                <div class="center">
                    <h1>
                        <span class="_red"><?php echo U::T_("Registrazione"); ?></span>
                    </h1>
                </div>

                <div class="space-6"></div>
                <?php if(old('message')) : ?>
                <div class="alert alert-<?php echo old('status') ? old('status') : 'danger'; ?> text-center">
                    <?php echo old('message'); ?>
                </div>
                <div class="space-6"></div>
                <?php endif; ?>
                <div class="position-relative">
                    <div id="signup-box" class="signup-box visible widget-box no-border">
                        <div class="widget-body">
                            <div class="widget-main">
                                <h4 class="header green lighter bigger">
									<?php echo U::T_("Form di registrazione"); ?>
                                </h4>

                                <form id="registerForm" role="form" action="{{ url('/register') }}" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" id="currency" name="currency" value="<?php echo old('currency'); ?>">
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block">
                                                <select name="id_language" class="form-control">
                                                    <option value="">-- please select your language --</option>
                                                    <?php foreach(\App\Models\LanguageQuery::create()->find() as $lang) : ?>
                                                    <option value="<?php echo $lang->getId(); ?>" <?php echo old('id_language') == $lang->getId() ? "selected" : ""; ?>><?php echo $lang->getDescription(); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                @if ($errors->has('iso'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('iso') }}</strong>
                                                    </span>
                                                @endif
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" name="first_name" class="form-control" placeholder="<?php echo U::T_("Nome"); ?>" value="{{ old('first_name') }}" />
                                                @if ($errors->has('first_name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                    </span>
                                                @endif
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block">
                                                <input type="text" name="last_name" class="form-control" placeholder="<?php echo U::T_("Cognome"); ?>" value="{{ old('last_name') }}" />
                                                @if ($errors->has('last_name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('last_name') }}</strong>
                                                    </span>
                                                @endif
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="email" name="email" class="form-control" placeholder="<?php echo U::T_("Email"); ?>" value="{{ old('email') }}" />

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif

                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" name="username" class="form-control" placeholder="<?php echo U::T_("Username"); ?>" value="{{ old('username') }}" />

                                                @if ($errors->has('username'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('username') }}</strong>
                                                    </span>
                                                @endif

                                                <i class="ace-icon fa fa-user"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" name="password" class="form-control" placeholder="Password" />

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif

                                                <i class="ace-icon fa fa-key"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" />

                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif

                                                <i class="ace-icon fa fa-key"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" name="address" class="form-control" placeholder="<?php echo U::T_("Indirizzo"); ?>" value="<?php echo old("address"); ?>">
                                                @if ($errors->has('address'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-map"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block">
                                                <input type="text" name="zip" class="form-control" placeholder="<?php echo U::T_("Codice Postale"); ?>" value="<?php echo old("zip"); ?>">
                                                @if ($errors->has('zip'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('zip') }}</strong>
                                                    </span>
                                                @endif
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block">
                                                <input type="text" name="city" class="form-control" placeholder="<?php echo U::T_("Città"); ?>" value="<?php echo old("city"); ?>">
                                                @if ($errors->has('city'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('city') }}</strong>
                                                    </span>
                                                @endif
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block">
                                                <input type="text" name="province" class="form-control" placeholder="<?php echo U::T_("Provincia"); ?>" value="<?php echo old("province"); ?>">
                                                @if ($errors->has('province'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('province') }}</strong>
                                                    </span>
                                                @endif
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block">
                                                <select id="country" name="country" class="form-control">
                                                    <option value="">- select your country -</option>
                                                    <option data-currency="EUR" value="Austria" <?php echo old("country") == "Austria" ? "selected" : ""; ?>>Austria</option>
                                                    <option data-currency="EUR" value="Belgium" <?php echo old("country") == "Belgium" ? "selected" : ""; ?>>Belgium</option>
                                                    <option data-currency="EUR" value="Bulgaria" <?php echo old("country") == "Bulgaria" ? "selected" : ""; ?>>Bulgaria</option>
                                                    <option data-currency="EUR" value="Cyprus" <?php echo old("country") == "Cyprus" ? "selected" : ""; ?>>Cyprus</option>
                                                    <option data-currency="EUR" value="Czech Republic" <?php echo old("country") == "Czech Republic" ? "selected" : ""; ?>>Czech Republic</option>
                                                    <option data-currency="EUR" value="Denmark" <?php echo old("country") == "Denmark" ? "selected" : ""; ?>>Denmark</option>
                                                    <option data-currency="EUR" value="Estonia" <?php echo old("country") == "Estonia" ? "selected" : ""; ?>>Estonia</option>
                                                    <option data-currency="EUR" value="Finland" <?php echo old("country") == "Finland" ? "selected" : ""; ?>>Finland</option>
                                                    <option data-currency="EUR" value="France" <?php echo old("country") == "France" ? "selected" : ""; ?>>France</option>
                                                    <option data-currency="EUR" value="Germany" <?php echo old("country") == "Germany" ? "selected" : ""; ?>>Germany</option>
                                                    <option data-currency="EUR" value="Greece" <?php echo old("country") == "Greece" ? "selected" : ""; ?>>Greece</option>
                                                    <option data-currency="EUR" value="Hungary" <?php echo old("country") == "Hungary" ? "selected" : ""; ?>>Hungary</option>
                                                    <option data-currency="EUR" value="Ireland" <?php echo old("country") == "Ireland" ? "selected" : ""; ?>>Ireland</option>
                                                    <option data-currency="EUR" value="Italy" <?php echo old("country") == "Italy" ? "selected" : ""; ?>>Italy</option>
                                                    <option data-currency="EUR" value="Latvia" <?php echo old("country") == "Latvia" ? "selected" : ""; ?>>Latvia</option>
                                                    <option data-currency="EUR" value="Lithuania" <?php echo old("country") == "Lithuania" ? "selected" : ""; ?>>Lithuania</option>
                                                    <option data-currency="EUR" value="Luxembourg" <?php echo old("country") == "Luxembourg" ? "selected" : ""; ?>>Luxembourg</option>
                                                    <option data-currency="EUR" value="Malta" <?php echo old("country") == "Malta" ? "selected" : ""; ?>>Malta</option>
                                                    <option data-currency="EUR" value="Netherlands" <?php echo old("country") == "Netherlands" ? "selected" : ""; ?>>Netherlands</option>
                                                    <option data-currency="EUR" value="Poland" <?php echo old("country") == "Poland" ? "selected" : ""; ?>>Poland</option>
                                                    <option data-currency="EUR" value="Portugal" <?php echo old("country") == "Portugal" ? "selected" : ""; ?>>Portugal</option>
                                                    <option data-currency="EUR" value="Romania" <?php echo old("country") == "Romania" ? "selected" : ""; ?>>Romania</option>
                                                    <option data-currency="EUR" value="Slovakia" <?php echo old("country") == "Slovakia" ? "selected" : ""; ?>>Slovakia</option>
                                                    <option data-currency="EUR" value="Slovenia" <?php echo old("country") == "Slovenia" ? "selected" : ""; ?>>Slovenia</option>
                                                    <option data-currency="EUR" value="Spain" <?php echo old("country") == "Spain" ? "selected" : ""; ?>>Spain</option>
                                                    <option data-currency="EUR" value="Sweden" <?php echo old("country") == "Sweden" ? "selected" : ""; ?>>Sweden</option>
                                                    <option data-currency="EUR" value="United Kingdom" <?php echo old("country") == "United Kingdom" ? "selected" : ""; ?>>United Kingdom</option>
                                                </select>
                                                @if ($errors->has('country'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('country') }}</strong>
                                                    </span>
                                                @endif
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" name="phone" class="form-control" placeholder="<?php echo U::T_("Telefono"); ?>" value="<?php echo old("phone"); ?>">
                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-phone"></i>
                                            </span>
                                        </label>
                                        <label class="block clearfix">
                                            <span class="block input-icon input-icon-right">
                                                <input type="text" name="fax" class="form-control" placeholder="<?php echo U::T_("Fax"); ?>" value="<?php echo old("fax"); ?>">
                                                @if ($errors->has('fax'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('fax') }}</strong>
                                                    </span>
                                                @endif
                                                <i class="ace-icon fa fa-fax"></i>
                                            </span>
                                        </label>

                                        <label class="block">
                                            <input type="checkbox" name="agree" class="ace" />
                                                <span class="lbl">
                                                    <a href="#"><?php echo U::T_("Accetto"); ?></a>
                                                    @if ($errors->has('agree'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('agree') }}</strong>
                                                        </span>
                                                    @endif
                                                </span>
                                        </label>

                                        <div class="space-24"></div>

                                        <div class="clearfix">
                                            <button id="submit" type="submit" class="width-100 pull-right btn btn-sm btn-success">
                                                <i class="fa fa-paper-plane"></i>
												<span class="bigger-110"><?php echo U::T_("Invia"); ?></span>
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                            <div class="toolbar center">
                                <a href="{{ url('/login') }}" class="back-to-login-link">
                                    <i class="ace-icon fa fa-arrow-left"></i>
									<?php echo U::T_("Torna alla pagine di login"); ?>
                                </a>
                            </div>
                        </div><!-- /.widget-body -->
                    </div><!-- /.signup-box -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            new register();
        });
    </script>
@endsection