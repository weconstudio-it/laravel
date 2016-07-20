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
				@include('datatable.th_definition')
			</tr>
		</thead>
		<tbody></tbody>
	</table>

	<script>
		$(function () {
			var dt = new dataTable({
				idTable: "tblUser",
				csv: true
			});
			var u = new user(dt.ajaxUrl);
			dt.DTfnDrawCallback = function() {
				dt.bindEvents();
				u.bindEvents(dt);
			};
			dt.make();
		});
	</script>
@endsection