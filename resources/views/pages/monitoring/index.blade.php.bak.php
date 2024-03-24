@extends('layouts.app')
@section('pagetitle', 'Monitoring')

@section('extra-css')
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		
		
			<!--begin::Container-->
			<div id="kt_content_container" class="container-xxl">
				
				<!--begin::Tables Widget 12-->
				<div class="card mb-5 mb-xl-8">
					<!--begin::Header-->
					<div class="card-header border-0 pt-5">
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bolder fs-3 mb-1">List Monitoring</span>
							<!-- <span class="text-muted mt-1 fw-bold fs-7">Over 500 new members</span> -->
						</h3>
						<div>
						<?php /*
						<a href="{{ route('monitoring.create') }}" class="btn btn-primary"><i class="bi bi-plus-square-dotted fs-4 me-2"></i>Add New</a>
						*/ ?>
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body py-3">
						<!--begin::Table container-->
						<div class="table-responsive">


							<!--begin::Table-->
							<table id="kt_datatable_example_5" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
								<!--begin::Table head-->
								<thead>
									<tr class="fw-bolder fs-6 text-gray-800 px-7">
										<th>Tgl Lapor</th>
										<th>Jenis Form</th>
										<th>Nama Alat</th>
										<th>Jalur</th>
										<th>Pelapor</th>
										<th>Status</th>
										<th>Menu</th>
									</tr>
								</thead>
								<!--end::Table head-->
								<!--begin::Table body-->
								<tbody>
									
								</tbody>
								<!--end::Table body-->
							</table>
							<!--end::Table-->
						</div>
						<!--end::Table container-->
					</div>
					<!--begin::Body-->
				</div>
				<!--end::Tables Widget 12-->

			</div>
			<!--end::Container-->	
	</div>
	<!--end::Content-->
@endsection

@section('extra-js')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('app/js/monitoring-datatable.js') }}"></script>

    <script>
    $(document).ready(function () {

        $('#kt_datatable_example_5').DataTable({
        	"scrollX": true,
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('monitoring.data') }}",
            "columns": [          
                {data: 'created_at', name: 'created_at', defaultContent: '-'},
                {data: 'jenis_form', name: 'jenis_form', defaultContent: '-', orderable: false, searchable: false},
                {data: 'source.inventory.uraian', name: 'uraian', defaultContent: '-'},
                {data: 'source.inventory.location.ket', name: 'ket', defaultContent: '-'},
                {data: 'pic.full_name', name: 'pelapor', defaultContent: '-'},
                {data: 'source.status_label', name: 'status', defaultContent: '-'},
                {data: 'menu', orderable: false, searchable: false}
            ],
            "order": [[0, 'asc']]
        });

        $('body').on('click', '.delete', function () {

        	if (confirm("Delete Record?") == true) {
        		var id = $(this).data('id');

        		// ajax
        		$.ajax({
        			type:"post",
        			url: "{{ url('monitoring/destroy') }}",
        			data: {id : id, _token: "{{ csrf_token() }}"},
        			success: function(res){
        				if (res.result == 'success') {
        					flasher.success("Data has been deleted successfully!");

        					$('#kt_advance_table_widget_1').DataTable().ajax.url("{{ route('monitoring.data') }}").load();
        				}
        			}
        		});
        	}
        });
    });
    </script>
@endsection