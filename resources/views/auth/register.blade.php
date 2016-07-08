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

                                <form role="form" action="{{ url('/register') }}" method="post">
                                    {!! csrf_field() !!}
                                    <fieldset>
                                        <label class="block clearfix">
                                            <span class="block">
                                                <select name="iso" class="form-control">
                                                    <option value="">-- <?php echo U::T_("Seleziona la lingua"); ?> --</option>
                                                    <option value="it_IT" <?php echo old('iso') == "it_IT" ? "selected" : ""; ?>><?php echo U::T_("Italiano"); ?></option>
                                                    <option value="en_EN" <?php echo old('iso') == "en_EN" ? "selected" : ""; ?>><?php echo U::T_("Inglese"); ?></option>
                                                    <option value="fr_FR" <?php echo old('iso') == "fr_FR" ? "selected" : ""; ?>><?php echo U::T_("Francese"); ?></option>
                                                    <option value="es_ES" <?php echo old('iso') == "es_ES" ? "selected" : ""; ?>><?php echo U::T_("Spagnolo"); ?></option>
                                                    <option value="de_DE" <?php echo old('iso') == "de_DE" ? "selected" : ""; ?>><?php echo U::T_("Tedesco"); ?></option>
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
                                                <select name="country" class="form-control">
                                                    <option value="">-- <?php echo U::T_("Seleziona il paese"); ?> --</option>
                                                    <option value="Austria" <?php echo old("country") == "Austria" ? "selected" : ""; ?>>Austria</option>
                                                    <option value="Belgium" <?php echo old("country") == "Belgium" ? "selected" : ""; ?>>Belgium</option>
                                                    <option value="Bulgaria" <?php echo old("country") == "Bulgaria" ? "selected" : ""; ?>>Bulgaria</option>
                                                    <option value="Cyprus" <?php echo old("country") == "Cyprus" ? "selected" : ""; ?>>Cyprus</option>
                                                    <option value="Czech Republic" <?php echo old("country") == "Czech Republic" ? "selected" : ""; ?>>Czech Republic</option>
                                                    <option value="Denmark" <?php echo old("country") == "Denmark" ? "selected" : ""; ?>>Denmark</option>
                                                    <option value="Estonia" <?php echo old("country") == "Estonia" ? "selected" : ""; ?>>Estonia</option>
                                                    <option value="Finland" <?php echo old("country") == "Finland" ? "selected" : ""; ?>>Finland</option>
                                                    <option value="France" <?php echo old("country") == "France" ? "selected" : ""; ?>>France</option>
                                                    <option value="Germany" <?php echo old("country") == "Germany" ? "selected" : ""; ?>>Germany</option>
                                                    <option value="Greece" <?php echo old("country") == "Greece" ? "selected" : ""; ?>>Greece</option>
                                                    <option value="Hungary" <?php echo old("country") == "Hungary" ? "selected" : ""; ?>>Hungary</option>
                                                    <option value="Ireland" <?php echo old("country") == "Ireland" ? "selected" : ""; ?>>Ireland</option>
                                                    <option value="Italy" <?php echo old("country") == "Italy" ? "selected" : ""; ?>>Italy</option>
                                                    <option value="Latvia" <?php echo old("country") == "Latvia" ? "selected" : ""; ?>>Latvia</option>
                                                    <option value="Lithuania" <?php echo old("country") == "Lithuania" ? "selected" : ""; ?>>Lithuania</option>
                                                    <option value="Luxembourg" <?php echo old("country") == "Luxembourg" ? "selected" : ""; ?>>Luxembourg</option>
                                                    <option value="Malta" <?php echo old("country") == "Malta" ? "selected" : ""; ?>>Malta</option>
                                                    <option value="Netherlands" <?php echo old("country") == "Netherlands" ? "selected" : ""; ?>>Netherlands</option>
                                                    <option value="Poland" <?php echo old("country") == "Poland" ? "selected" : ""; ?>>Poland</option>
                                                    <option value="Portugal" <?php echo old("country") == "Portugal" ? "selected" : ""; ?>>Portugal</option>
                                                    <option value="Romania" <?php echo old("country") == "Romania" ? "selected" : ""; ?>>Romania</option>
                                                    <option value="Slovakia" <?php echo old("country") == "Slovakia" ? "selected" : ""; ?>>Slovakia</option>
                                                    <option value="Slovenia" <?php echo old("country") == "Slovenia" ? "selected" : ""; ?>>Slovenia</option>
                                                    <option value="Spain" <?php echo old("country") == "Spain" ? "selected" : ""; ?>>Spain</option>
                                                    <option value="Sweden" <?php echo old("country") == "Sweden" ? "selected" : ""; ?>>Sweden</option>
                                                    <option value="United Kingdom" <?php echo old("country") == "United Kingdom" ? "selected" : ""; ?>>United Kingdom</option>
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