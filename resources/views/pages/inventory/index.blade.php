@extends('layouts.app')
@section('pagetitle', 'Inventory Management')

@section('extra-css')
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
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
							<span class="card-label fw-bolder fs-3 mb-1">List Data</span>
							<!-- <span class="text-muted mt-1 fw-bold fs-7">Over 500 new members</span> -->
						</h3>
						
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body py-3">
						<!--begin::Table container-->
						<div class="table-responsive">


							<!--begin::Table-->
							<table class="table table-striped gy-7 gs-7" id="kt_advance_table_widget_1">
								<!--begin::Table head-->
								<thead>
									<tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
										<th class="min-w-125px">Codefication</th>
										<th class="min-w-125px">Name</th>
										<th class="min-w-125px">Alat</th>
										<th class="min-w-125px">Brand</th>
										<th class="min-w-125px">Spesification</th>
										<th class="min-w-125px">Type</th>
										<!-- <th class="min-w-125px">Functional Placement</th> -->
										<th class="min-w-125px">Remark</th>
										<th class="min-w-125px">Manufacture Year</th>
										<th class="min-w-125px">Location</th>
										<th class="min-w-125px">Status</th>
										<th class="min-w-125px">PIC</th>
										<th class="min-w-200px">Action</th>
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
		<!--end::Post-->
	</div>
	<!--end::Content-->
@endsection

@section('extra-js')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script>
    $(document).ready(function () {

        $('#kt_advance_table_widget_1').DataTable({
        	"scrollX": true,
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('inventory.data') }}",
            "searching": true,
            "columns": [          
                {data: 'no_inventaris', name: 'no_inventaris', defaultContent: '-'},
                {data: 'uraian', name: 'uraian', defaultContent: '-'},
                {data: 'category.ket', name: 'category', defaultContent: '-'},
                {data: 'brand.ket', name: 'brand', defaultContent: '-'},
                {data: 'kapasitas', name: 'kapasitas', defaultContent: '-'},
                {data: 'tipe', name: 'tipe', defaultContent: '-'},
                {data: 'uraian', name: 'uraian', defaultContent: '-'},
                {data: 'th_pembuatan', name: 'th_pembuatan', defaultContent: '-'},
                {data: 'location.ket', name: 'lokasi', defaultContent: '-'},
                {data: 'condition.kondisi', name: 'condition', defaultContent: '-'},
                {data: 'pic', name: 'pic', defaultContent: '-'},
                {data: 'menu', orderable: false, searchable: false}
            ],
            "order": [[0, 'asc']]
        });
    });
    </script>
@endsection