@extends('layouts.app')

@section('extra-css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			
			<!--begin::Tables Widget 12-->
			<div class="card mb-5 mb-xl-8">
				<!--begin::Header-->
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bolder fs-3 mb-1">Checklist Perawatan</span>
						<!-- <span class="text-muted mt-1 fw-bold fs-7">Over 500 new members</span> -->
					</h3>
					<div>
						<a href="{{route('checklist-perawatan.create')}}" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Tambah Data</a>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body py-3">
					<!--begin::Table container-->
					<div class="table-responsive">
						<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="tabel_form_perawatan_it">
							<thead>
								<tr class="text-start text-gray-800 fw-bolder fs-7 text-uppercase">
									<th>Nama</th>
									<th>Menu</th>
								</tr>
							</thead>
							<tbody class="fw-bold text-gray-600">
								
							</tbody>
						</table>
					</div>
					<!--end::Table container-->
				</div>
				<!--begin::Body-->
			</div>
			<!--end::Tables Widget 12-->

		</div>
		<!--end::Container-->
	</div>
	<!--end::Post-->
</div>
@endsection

@section('extra-js')
	<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		"use strict";

		// Class definition
		var KTDatatablesServerSide = function () {
			// Shared variables
			var table;
			var dt;
			var filterPayment;

			// Private functions
			var initDatatable = function () {
				dt = $("#tabel_form_perawatan_it").DataTable({
					language: {
						lengthMenu: "Show _MENU_",
					},
					dom:
						"<'row'" +
						"<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
						"<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
						">" +

						"<'table-responsive'tr>" +

						"<'row'" +
						"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
						"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
						">",
					searchDelay: 500,
					processing: true,
					serverSide: true,
					order: [[0, 'desc']],
					stateSave: true,
					ajax: "{{ route('checklist-perawatan.data') }}",
					columns: [
						{data: 'nama', name: 'nama', defaultContent: '-'},
						{data: 'menu', orderable: false, searchable: false}
					],
				});

				table = dt.$;
			}
			
			// Public methods
			return {
				init: function () {
					initDatatable();
				}
			}
		}();

		// On document ready
		KTUtil.onDOMContentLoaded(function () {
			KTDatatablesServerSide.init();
		});

		$('body').on('click', '.delete', function () {
			if (confirm("Delete Record?") == true) {
				var id = $(this).data('id');

				// ajax
				$.ajax({
					type:"post",
					url: "{{ url('checklist-perawatan/destroy') }}",
					data: {id : id, _token: "{{ csrf_token() }}"},
					success: function(res){
						if (res.result == 'success') {
							flasher.success("Data telah berhasil dihapus!");

							$('#tabel_form_perawatan_it').DataTable().ajax.url("{{ route('checklist-perawatan.data') }}").load();
						}
					}
				});
			}
		});
	</script>
@endsection