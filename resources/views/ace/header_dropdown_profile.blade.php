<?php if(\Auth::check()) : ?>
<li class="light-blue dropdown-modal">
    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
        <!--img class="nav-user-photo" src="" alt="Jason's Photo" /-->
								<span class="user-info">
									<small>Benvenuto,</small>
									<?php echo \Auth::user(); ?>
								</span>

        <i class="ace-icon fa fa-caret-down"></i>
    </a>

    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
        <li>
            <a href="#">
                <i class="ace-icon fa fa-cog"></i>
                Settings
            </a>
        </li>

        <li>
            <a href="#user/{{ \Auth::user()->getId() }}/edit">
                <i class="ace-icon fa fa-user"></i>
                Profile
            </a>
        </li>

        <li class="divider"></li>

        <li>
            <a href="{{ url('logout') }}">
                <i class="ace-icon fa fa-power-off"></i>
                Logout
            </a>
        </li>
    </ul>
</li>
<?php endif; ?>