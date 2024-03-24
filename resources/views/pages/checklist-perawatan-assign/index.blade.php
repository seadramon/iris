@extends('layouts.app')

@section('extra-css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<div class="card card-xl-stretch mb-5 mb-xl-8">
				<div class="card-header">
					<h3 class="card-title">Assign Checklist Perawatan</h3>
					<div class="card-toolbar">
						<a href="{{route('checklist-perawatan-assign.create')}}" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Tambah Data</a>
					</div>
				</div>
				<div class="card-body">
					<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="tabel_tipe_pc">
						<thead>
							<tr class="text-start text-gray-800 fw-bolder fs-7 text-uppercase">
								<th>Form Checklist</th>
								<th>Kode Pat</th>
								<th>Periode Awal</th>
								<th>Periode Akhir</th>
								<th>Submitted</th>
								<th>Menu</th>
							</tr>
						</thead>
						<tbody class="fw-bold text-gray-600">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
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
	        dt = $("#tabel_tipe_pc").DataTable({
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
	            ajax: "{{ route('checklist-perawatan-assign.data') }}",
	            columns: [
	                {data: 'form_checklist.nama', name: 'form_checklist.nama', defaultContent: '-'},
					{data: 'kd_pat', name: 'kd_pat', defaultContent: '-'},
	                {data: 'periode_awal', name: 'periode_awal', defaultContent: '-'},
	                {data: 'periode_akhir', name: 'periode_akhir', defaultContent: '-'},
	                {data: 'submitted', orderable: false, searchable: false},
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
				url: "{{ url('checklist-perawatan-assign/destroy') }}",
				data: {id : id, _token: "{{ csrf_token() }}"},
				success: function(res){
					if (res.result == 'success') {
						flasher.success("Data telah berhasil dihapus!");

						$('#tabel_tipe_pc').DataTable().ajax.url("{{ route('checklist-perawatan-assign.data') }}").load();
					}
				}
			});
		}
	});
</script>
@endsection