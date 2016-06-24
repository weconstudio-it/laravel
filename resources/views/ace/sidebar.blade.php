<?php
$menu_items = [
    'Dashboard' => [
        'href' => 'dashboard',
        'icon' => 'fa-tachometer',
        'minimum_level' => 0
    ]
];

/**
 * Se minimum_level è 0 allora tutti possono vedere quella voce di menu
 * Se minimum_level != 0 quelli con livello <= a minimum_level
 * Se levels è specificato solo quelli con level in levels possono vedere
 *
 * @param $item array
 * @return boolean
 */
function canIAccess($item = []) {
    // levels vince su mimum_level
    $level = \Auth::user()->getLevel();

    if(isset($item['levels']) and count($item['levels'])) {
        // solo i level specificati potranno vedere questa voce di menu e le eventuali sottovoci
        $ret = in_array($level, $item['levels']);
    } else {
        $minimum = (isset($item['minimum_level'])) ? intval($item['minimum_level']) : 0;
        if($minimum) {
            if($level >= $minimum) {
                $ret = true;
            } else {
                $ret = false;
            }
        } else {
            $ret = true;
        }
    }

    return $ret;
}
?>
<?php if(\Auth::check()) : ?>
<ul class="nav nav-list">
    <?php foreach ($menu_items as $title => $menu_item): ?>

    <?php if(canIAccess($menu_item)) : ?>
    <li class="">
        <a data-url="<?php echo (isset($menu_item['href'])) ? $menu_item['href'] : ""; ?>" href="#<?php echo (isset($menu_item['href'])) ? $menu_item['href'] : ""; ?>" class="<?php echo (isset($menu_item['subitems']) and count($menu_item['subitems'])) ? "dropdown-toggle" : ""; ?>">
            <i class="menu-icon fa <?php echo (isset($menu_item['icon'])) ? $menu_item['icon'] : ""; ?>"></i>
            <span class="menu-text"><?php echo $title; ?></span>

            <?php if(isset($menu_item['badge']) and count($menu_item['badge'])) : ?>
            <span class="badge <?php echo (isset($menu_item['badge']['badge_class'])) ? $menu_item['badge']['badge_class'] : ""; ?>" title="<?php echo (isset($menu_item['badge']['title'])) ? $menu_item['badge']['title'] : ""; ?>">
                    <i class="ace-icon fa <?php echo (isset($menu_item['badge']['icon_class'])) ? $menu_item['badge']['icon_class'] : ""; ?> bigger-130"></i>
                </span>
            <?php endif; ?>


            <?php if(isset($menu_item['subitems']) and count($menu_item['subitems'])) : ?>
            <b class="arrow fa fa-angle-down"></b>
            <?php endif; ?>
        </a>

        <b class="arrow"></b>

        <?php if(isset($menu_item['subitems']) and count($menu_item['subitems'])) : ?>
        <ul class="submenu">
            <?php foreach($menu_item['subitems'] as $subTitle => $subItem) : ?>
            <?php if(canIAccess($subItem)) : ?>
                <li class="">
                    <a data-url="<?php echo (isset($subItem['href'])) ? $subItem['href'] : ""; ?>" href="#<?php echo (isset($subItem['href'])) ? $subItem['href'] : ""; ?>">
                        <i class="menu-icon fa <?php echo (isset($subItem['icon'])) ? $subItem['icon'] : ""; ?>"></i>
                        <?php echo $subTitle; ?>
                    </a>
                    <b class="arrow"></b>
                </li>
            <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </li>
    <?php endif; ?>
    <?php endforeach; ?>

</ul><!-- /.nav-list -->

<!-- #section:basics/sidebar.layout.minimize -->
<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>

<!-- /section:basics/sidebar.layout.minimize -->
<?php endif; ?>