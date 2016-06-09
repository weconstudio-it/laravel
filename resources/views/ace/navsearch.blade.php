<?php if(\Auth::check()) : ?>
<!-- #section:basics/content.searchbox -->
    <div class="nav-search" id="nav-search" style="display: none;">
        <form class="form-search form-inline">
            <span class="input-icon">
                <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                <i class="ace-icon fa fa-search nav-search-icon"></i>
            </span>
        </form>
    </div>
<!-- /.nav-search -->
<!-- /section:basics/content.searchbox -->
<?php endif; ?>