<?php
use Weconstudio\Misc\U;
/* @var $configuration \Weconstudio\DataTable\DataTableConfiguration */
?>
<th
        data-dt-inline-button="{{ ($configuration->inlineButton != "" ? 1 : 0) }}"
        <?php if($configuration->subgrid): ?>
        data-dt-subgrid='<?php echo json_encode($configuration->subgrid); ?>'
        <?php endif; ?>
        data-dt-button="{{ $configuration->inlineButton }}"
        data-dt-edit-url="{{ $configuration->editUrl }}"
        data-dt-delete-url="{{ $configuration->deleteUrl }}">
</th>
<?php foreach ($configuration->columns as $column):
$formatter = U::arrayIsSet($column, 'formatterjs', '');
$filter = U::arrayIsSet($column, 'filter', false) ? '1' : '0';
$sort = U::arrayIsSet($column, 'sort', false) ? '1' : '0';
$field = U::arrayIsSet($column, 'field', '');
$label = U::arrayIsSet($column, 'label', '');
$align = U::arrayIsSet($column, 'align', 'left');
$hide = U::arrayIsSet($column, 'hide', false);
$preload = U::arrayIsSet($column, 'filterPreload', true);
$initValue = "";
$initText = "";
$init = U::arrayIsSet($column, 'filterInitValue', []);
if(count($init)) {
        $initValue = U::arrayIsSet($init, 'id', '');
        $initText = U::arrayIsSet($init, 'text', '');
}
if($initText == "") $initText = $initValue;
?>
<?php if(!$hide) : ?>
<th data-dt-formatterjs="{{ $formatter }}"
    data-dt-filter="{{ $filter }}"
    data-dt-sort="{{ $sort }}"
    data-dt-align="{{ $align }}"
    data-dt-preload="{{ $preload }}"
    data-dt-init-value="{{ $initValue }}"
    data-dt-init-text="{{ $initText }}"
    data-dt-field="{{ $field }}">{{ $label }}</th>
<?php endif; ?>
<?php endforeach; ?>