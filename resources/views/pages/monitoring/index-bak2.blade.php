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
	<div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
		<!--begin::Card-->
		<div class="card card-docs flex-row-fluid mb-2">
			<!--begin::Card Body-->
			<div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
				<!--begin::Section-->
				<div class="p-0">
					<!--begin::Heading-->
					<h1 class="anchor fw-bolder mb-5" id="server-side">
					<a href="#server-side"></a>List Monitoring</h1>
					<!--end::Heading-->
					
					<!--begin::CRUD-->
					<div class="py-5">
						<!--begin::Wrapper-->
						<div class="d-flex flex-stack flex-wrap mb-5">
							<!--begin::Search-->
							<div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
								<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
								<span class="svg-icon svg-icon-1 position-absolute ms-6">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
										<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->
								<input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Customers" />
							</div>
							<!--end::Search-->
							<!--begin::Toolbar-->
							<div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
								<!--begin::Filter-->
								<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
								<!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
								<span class="svg-icon svg-icon-2">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->Filter</button>
								<!--begin::Menu 1-->
								<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
									<!--begin::Header-->
									<div class="px-7 py-5">
										<div class="fs-4 text-dark fw-bolder">Filter Options</div>
									</div>
									<!--end::Header-->
									<!--begin::Separator-->
									<div class="separator border-gray-200"></div>
									<!--end::Separator-->
									<!--begin::Content-->
									<div class="px-7 py-5">
										<!--begin::Input group-->
										<div class="mb-10">
											<!--begin::Label-->
											<label class="form-label fs-5 fw-bold mb-3">Payment Type:</label>
											<!--end::Label-->
											<!--begin::Options-->
											<div class="d-flex flex-column flex-wrap fw-bold" data-kt-docs-table-filter="payment_type">
												<!--begin::Option-->
												<label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
													<input class="form-check-input" type="radio" name="payment_type" value="all" checked="checked" />
													<span class="form-check-label text-gray-600">All</span>
												</label>
												<!--end::Option-->
												<!--begin::Option-->
												<label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
													<input class="form-check-input" type="radio" name="payment_type" value="visa" />
													<span class="form-check-label text-gray-600">Visa</span>
												</label>
												<!--end::Option-->
												<!--begin::Option-->
												<label class="form-check form-check-sm form-check-custom form-check-solid mb-3">
													<input class="form-check-input" type="radio" name="payment_type" value="mastercard" />
													<span class="form-check-label text-gray-600">Mastercard</span>
												</label>
												<!--end::Option-->
												<!--begin::Option-->
												<label class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input" type="radio" name="payment_type" value="americanexpress" />
													<span class="form-check-label text-gray-600">American Express</span>
												</label>
												<!--end::Option-->
											</div>
											<!--end::Options-->
										</div>
										<!--end::Input group-->
										<!--begin::Actions-->
										<div class="d-flex justify-content-end">
											<button type="reset" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-docs-table-filter="reset">Reset</button>
											<button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-docs-table-filter="filter">Apply</button>
										</div>
										<!--end::Actions-->
									</div>
									<!--end::Content-->
								</div>
								<!--end::Menu 1-->
								<!--end::Filter-->
								<!--begin::Add customer-->
								<button type="button" class="btn btn-primary" data-bs-toggle="tooltip" title="Coming Soon">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
								<span class="svg-icon svg-icon-2">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
										<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->Add Customer</button>
								<!--end::Add customer-->
							</div>
							<!--end::Toolbar-->
							<!--begin::Group actions-->
							<div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
								<div class="fw-bolder me-5">
								<span class="me-2" data-kt-docs-table-select="selected_count"></span>Selected</div>
								<button type="button" class="btn btn-danger" data-kt-docs-table-select="delete_selected">Selection Action</button>
							</div>
							<!--end::Group actions-->
						</div>
						<!--end::Wrapper-->
						<!--begin::Datatable-->
						<table id="kt_datatable_example_1" class="table align-middle table-row-dashed min-h-400px fs-6 gy-5">
							<thead>
								<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
									<th>Tgl Lapor</th>
									<th>Jenis Form</th>
									<th>Nama Alat</th>
									<th>Pelapor</th>
									<th>Menu</th>
								</tr>
							</thead>
							<tbody class="text-gray-600 fw-bold"></tbody>
						</table>
						<!--end::Datatable-->
					</div>
					<!--end::CRUD-->
					
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
    	            ajax: "{{ route('monitoring.data') }}",
    	            columns: [
    	                {data: 'created_at', name: 'created_at', defaultContent: '-'},
		                {data: 'jenis_form', name: 'jenis_form', defaultContent: '-', orderable: false, searchable: false},
		                {data: 'source.inventory', name: 'source.inventory.uraian', defaultContent: '-'},
		                {data: 'pic.full_name', name: 'pic', defaultContent: '-', orderable: false, searchable: false},
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
    	        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
    	        filterSearch.addEventListener('keyup', function (e) {
    	        	console.log(e);
    	            dt.search(e.target.value).draw();
    	        });
    	    }

    	    // Filter Datatable
    	    var handleFilterDatatable = () => {
    	        // Select filter options
    	        filterPayment = document.querySelectorAll('[data-kt-docs-table-filter="payment_type"] [name="payment_type"]');
    	        const filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');

    	        // Filter datatable on submit
    	        filterButton.addEventListener('click', function () {
    	            // Get filter values
    	            let paymentValue = '';

    	            // Get payment value
    	            filterPayment.forEach(r => {
    	                if (r.checked) {
    	                    paymentValue = r.value;
    	                }

    	                // Reset payment value if "All" is selected
    	                if (paymentValue === 'all') {
    	                    paymentValue = '';
    	                }
    	            });

    	            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
    	            dt.search(paymentValue).draw();
    	        });
    	    }

    	    // Reset Filter
    	    var handleResetForm = () => {
    	        // Select reset button
    	        const resetButton = document.querySelector('[data-kt-docs-table-filter="reset"]');

    	        // Reset datatable
    	        resetButton.addEventListener('click', function () {
    	            // Reset payment type
    	            filterPayment[0].checked = true;

    	            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
    	            dt.search('').draw();
    	        });
    	    }
    	    

    	    // Public methods
    	    return {
    	        init: function () {
    	            initDatatable();
    	            handleSearchDatatable();
    	            handleFilterDatatable();
    	            handleResetForm();
    	        }
    	    }
    	}();

    	// On document ready
    	KTUtil.onDOMContentLoaded(function () {
    	    KTDatatablesServerSide.init();
    	});
    </script>
@endsection