<?php /** @var $gridConfiguration \Weconstudio\Grid\GridConfiguration */
    $gridId = $gridConfiguration->id;
?>
@yield('table')

<div id="pager_{{ $gridId }}"></div>
<script type="text/javascript">
    $(function(){
        grid.init($("#{{ $gridId }}"), <?php echo json_encode($gridConfiguration->getColumns()); ?>, '<?php echo sha1($gridConfiguration->id); ?>');
    });
</script>