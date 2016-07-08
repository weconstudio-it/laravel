<?php
use Weconstudio\Misc\U;
/* @var $configuration \Weconstudio\DataTable\DataTableConfiguration */
?>
@extends ('user.page')
@section('page_title')
	<?php echo U::T_('Utenti') ?>
@endsection

@section('content')
	<table id="tblUser" class="table" data-dt-url="{{ url("user") }}">
		<thead data-dt-enable-filter="true">
			<tr>
				<th
						data-dt-inline-button="{{ ($configuration->inlineButton != "" ? 1 : 0) }}"
						data-dt-button="{{ $configuration->inlineButton }}"
						data-dt-edit-url="{{ $configuration->editUrl }}"
						data-dt-delete-url="{{ $configuration->deleteUrl }}">
				</th>
				<?php foreach ($configuration->columns as $column):
				$formatter = U::arrayIsSet($column, 'formatter', '');
				$filter = U::arrayIsSet($column, 'filter', false) ? '1' : '0';
				$sort = U::arrayIsSet($column, 'sort', false) ? '1' : '0';
				$field = U::arrayIsSet($column, 'field', '');
				$label = U::arrayIsSet($column, 'label', '');
				$align = U::arrayIsSet($column, 'align', 'left');
				?>
				<th data-dt-formatter="{{ $formatter }}"
					data-dt-filter="{{ $filter }}"
					data-dt-sort="{{ $sort }}"
					data-dt-align="{{ $align }}"
					data-dt-field="{{ $field }}">{{ $label }}</th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	<script>
		$(function () {
			var dt = new dataTable({
				idTable: "tblUser"
			});
			var u = new user(dt.ajaxUrl);
			dt.DTfnDrawCallback = function() {
				dt.bindEvents();
				u.bindEvents();
			};
			dt.make();
		});
	</script>
@endsection