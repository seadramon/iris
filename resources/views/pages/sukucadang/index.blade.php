@extends('layouts.app')
@section('pagetitle', 'Suku Cadang Stok')

@section('extra-css')
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Container-->
	<div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
		<!--begin::Card-->
		<div class="card card-docs flex-row-fluid mb-2">
			<!--begin::Card Body-->
			<div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
				<!--begin::Section-->
				<div class="py-0">
					<!--begin::Heading-->
					<h1 class="anchor fw-bolder mb-5" id="buttons">
					List Sukucadang Stok</h1>
					<!--end::Heading-->
					<!--begin::Block-->
					<div class="py-5">
						<!--begin::Card-->
						<div class="card card-p-0 card-flush">
							<!--begin::Card header-->
							<div class="card-header align-items-center py-5 gap-2 gap-md-5">
								<!--begin::Card title-->
								<div class="card-title">
									<!--begin::Search-->
									<div class="d-flex align-items-center position-relative my-1">
										<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
										<span class="svg-icon svg-icon-1 position-absolute ms-4">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
												<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
											</svg>
										</span>
										<!--end::Svg Icon-->
										<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Data" />
									</div>
									<!--end::Search-->
									<!--begin::Export buttons-->
									<div id="kt_datatable_example_1_export" class="d-none"></div>
									<!--end::Export buttons-->
								</div>
								<!--end::Card title-->
								<!--begin::Card toolbar-->
								<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
									<!--begin::Export dropdown-->
									<!-- <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
									Export Report</button> -->
									<!--end::Export dropdown-->
								</div>
								<!--end::Card toolbar-->
							</div>
							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body">
								<!--begin::Table-->
								<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example_1">
									<thead>
										<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase">
											<th>Kode</th>
											<th>Uraian</th>
											<th>Spek</th>
											<th>Saldo</th>
											<th>Menu</th>
										</tr>
									</thead>
									<tbody class="fw-bold text-gray-600">
										
									</tbody>
								</table>
								<!--end::Table-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card-->
					</div>
					<!--end::Block-->
					
				</div>
				<!--end::Section-->
			</div>
			<!--end::Card Body-->
		</div>
		<!--end::Card-->
	</div>
	<!--end::Container-->
</div>
<!--end::Content-->
@endsection

@section('extra-js')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
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
	        dt = $("#kt_datatable_example_1").DataTable({
	            searchDelay: 500,
	            processing: true,
	            serverSide: true,
	            order: [[0, 'desc']],
	            stateSave: true,
	            ajax: "{{ route('sukucadang.data') }}",
	            columns: [
	                {data: 'kd_material', name: 'kd_material', defaultContent: '-'},
	                {data: 'uraian', name: 'uraian', defaultContent: '-'},
	                {data: 'spesifikasi', name: 'spesifikasi', defaultContent: '-'},
	                {data: 'saldo', orderable: false, searchable: false},
	                {data: 'menu', orderable: false, searchable: false}
	            ],
	            // Add data-filter attribute
	            createdRow: function (row, data, dataIndex) {
	                $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
	            }
	        });

	        table = dt.$;
	    }

	    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
	    var handleSearchDatatable = function () {
	        const filterSearch = document.querySelector('[data-kt-filter="search"]');
	        filterSearch.addEventListener('keyup', function (e) {
	        	console.log(e);
	            dt.search(e.target.value).draw();
	        });
	    }
	    
	    // Public methods
	    return {
	        init: function () {
	            initDatatable();
	            handleSearchDatatable();
	        }
	    }
	}();

	// On document ready
	KTUtil.onDOMContentLoaded(function () {
	    KTDatatablesServerSide.init();
	});
</script>
@endsection