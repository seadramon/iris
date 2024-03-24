<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<title>DataTables Ajax Server Side Examples by Keenthemes</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body data-bs-spy="scroll" data-bs-target="#kt_sidebar_nav" data-bs-offset="350" class="position-relative">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="docs-page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				<div id="kt_docs_aside" class="docs-aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_docs_aside_toggle">
					<!--begin::Menu-->
					<div class="docs-aside-menu flex-column-fluid">
						<!--begin::Aside Menu-->
						<div class="hover-scroll-overlay-y mt-5 mb-5 mt-lg-0 mb-lg-5 pe-lg-n2 me-lg-2" id="kt_docs_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_docs_aside_logo" data-kt-scroll-wrappers="#kt_docs_aside_menu" data-kt-scroll-offset="10px">
							<!--begin::Menu-->
							<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_docs_aside_menu" data-kt-menu="true">
								<div class="menu-item">
									<h4 class="menu-content text-muted mb-0 fs-7 text-uppercase">Getting Started</h4>
								</div>
								
							</div>
							<!--end::Menu-->
						</div>
					</div>
					<!--end::Menu-->
				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="docs-wrapper d-flex flex-column flex-row-fluid" id="kt_docs_wrapper">
					<!--begin::Header-->
					<div id="kt_docs_header" class="docs-header align-items-stretch mb-2 mb-lg-10">
						<!--begin::Container-->
						<div class="container">
							<div class="d-flex align-items-stretch justify-content-between py-3 h-75px">
								
								
								
							</div>
							<div class="border-gray-300 border-bottom border-bottom-dashed"></div>
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
					<!--begin::Content-->
					<div class="docs-content d-flex flex-column flex-column-fluid" id="kt_docs_content">
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
										<a href="#server-side"></a>Server Side</h1>
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
														<th class="w-10px pe-2">
															<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
																<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_example_1 .form-check-input" value="1" />
															</div>
														</th>
														<th>Customer Name</th>
														<th>Email</th>
														<th>Company</th>
														<th>Payment Method</th>
														<th>Created Date</th>
														<th class="text-end min-w-100px">Actions</th>
													</tr>
												</thead>
												<tbody class="text-gray-600 fw-bold"></tbody>
											</table>
											<!--end::Datatable-->
										</div>
										<!--end::CRUD-->
										<!--begin::Code-->
										<div class="py-5">
											<!--begin::Highlight-->
											<div class="highlight">
												<button class="highlight-copy btn" data-bs-toggle="tooltip" title="Copy code">copy</button>
												<ul class="nav nav-pills" role="tablist">
													<li class="nav-item">
														<a class="nav-link active" data-bs-toggle="tab" href="#kt_highlight_6244455240d51" role="tab">HTML</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#kt_highlight_6244455240d5a" role="tab">JAVASCRIPT</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#kt_highlight_6244455240d5c" role="tab">PHP</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-bs-toggle="tab" href="#kt_highlight_6244455240d5d" role="tab">PHP</a>
													</li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane fade show active" id="kt_highlight_6244455240d51" role="tabpanel">
														<div class="highlight-code">
															<pre class="language-html" style="height:400px">
<code class="language-html">&lt;!--begin::Wrapper--&gt;
&lt;div class="d-flex flex-stack mb-5"&gt;
    &lt;!--begin::Search--&gt;
    &lt;div class="d-flex align-items-center position-relative my-1"&gt;
        &lt;span class="svg-icon svg-icon-2"&gt;...&lt;/span&gt;
        &lt;input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Customers"/&gt;
    &lt;/div&gt;
    &lt;!--end::Search--&gt;

    &lt;!--begin::Toolbar--&gt;
    &lt;div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base"&gt;
        &lt;!--begin::Filter--&gt;
        &lt;button type="button" class="btn btn-light-primary me-3" data-bs-toggle="tooltip" title="Coming Soon"&gt;
            &lt;span class="svg-icon svg-icon-2"&gt;...&lt;/span&gt;
            Filter
        &lt;/button&gt;
        &lt;!--end::Filter--&gt;

        &lt;!--begin::Add customer--&gt;
        &lt;button type="button" class="btn btn-primary" data-bs-toggle="tooltip" title="Coming Soon"&gt;
            &lt;span class="svg-icon svg-icon-2"&gt;...&lt;/span&gt;
            Add Customer
        &lt;/button&gt;
        &lt;!--end::Add customer--&gt;
    &lt;/div&gt;
    &lt;!--end::Toolbar--&gt;

    &lt;!--begin::Group actions--&gt;
    &lt;div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected"&gt;
        &lt;div class="fw-bolder me-5"&gt;
            &lt;span class="me-2" data-kt-docs-table-select="selected_count"&gt;&lt;/span&gt; Selected
        &lt;/div&gt;

        &lt;button type="button" class="btn btn-danger" data-bs-toggle="tooltip" title="Coming Soon"&gt;
            Selection Action
        &lt;/button&gt;
    &lt;/div&gt;
    &lt;!--end::Group actions--&gt;
&lt;/div&gt;
&lt;!--end::Wrapper--&gt;

&lt;!--begin::Datatable--&gt;
&lt;table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5"&gt;
    &lt;thead&gt;
    &lt;tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0"&gt;
        &lt;th class="w-10px pe-2"&gt;
            &lt;div class="form-check form-check-sm form-check-custom form-check-solid me-3"&gt;
                &lt;input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_example_1 .form-check-input" value="1"/&gt;
            &lt;/div&gt;
        &lt;/th&gt;
        &lt;th&gt;Customer Name&lt;/th&gt;
        &lt;th&gt;Email&lt;/th&gt;
        &lt;th&gt;Company&lt;/th&gt;
        &lt;th&gt;Payment Method&lt;/th&gt;
        &lt;th&gt;Created Date&lt;/th&gt;
        &lt;th class="text-end min-w-100px"&gt;Actions&lt;/th&gt;
    &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody class="text-gray-600 fw-bold"&gt;
    &lt;/tbody&gt;
&lt;/table&gt;
&lt;!--end::Datatable--&gt;</code>
</pre>
														</div>
													</div>
													<div class="tab-pane fade" id="kt_highlight_6244455240d5a" role="tabpanel">
														<div class="highlight-code">
															<pre class="language-javascript" style="height:400px">
<code class="language-javascript">"use strict";

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
            order: [[5, 'desc']],
            stateSave: true,
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                url: "https://preview.keenthemes.com/api/datatables.php",
            },
            columns: [
                { data: 'RecordID' },
                { data: 'Name' },
                { data: 'Email' },
                { data: 'Company' },
                { data: 'CreditCardNumber' },
                { data: 'Datetime' },
                { data: null },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {
                        return `
                            &lt;div class="form-check form-check-sm form-check-custom form-check-solid"&gt;
                                &lt;input class="form-check-input" type="checkbox" value="${data}" /&gt;
                            &lt;/div&gt;`;
                    }
                },
                {
                    targets: 4,
                    render: function (data, type, row) {
                        return `&lt;img src="${hostUrl}media/svg/card-logos/${row.CreditCardType}.svg" class="w-35px me-3" alt="${row.CreditCardType}"&gt;` + data;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return `
                            &lt;a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end"&gt;
                                Actions
                                &lt;span class="svg-icon svg-icon-5 m-0"&gt;
                                    &lt;svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"&gt;
                                        &lt;g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"&gt;
                                            &lt;polygon points="0 0 24 0 24 24 0 24"&gt;&lt;/polygon&gt;
                                            &lt;path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"&gt;&lt;/path&gt;
                                        &lt;/g&gt;
                                    &lt;/svg&gt;
                                &lt;/span&gt;
                            &lt;/a&gt;
                            &lt;!--begin::Menu--&gt;
                            &lt;div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true"&gt;
                                &lt;!--begin::Menu item--&gt;
                                &lt;div class="menu-item px-3"&gt;
                                    &lt;a href="#" class="menu-link px-3" data-kt-docs-table-filter="edit_row"&gt;
                                        Edit
                                    &lt;/a&gt;
                                &lt;/div&gt;
                                &lt;!--end::Menu item--&gt;

                                &lt;!--begin::Menu item--&gt;
                                &lt;div class="menu-item px-3"&gt;
                                    &lt;a href="#" class="menu-link px-3" data-kt-docs-table-filter="delete_row"&gt;
                                        Delete
                                    &lt;/a&gt;
                                &lt;/div&gt;
                                &lt;!--end::Menu item--&gt;
                            &lt;/div&gt;
                            &lt;!--end::Menu--&gt;
                        `;
                    },
                },
            ],
            // Add data-filter attribute
            createdRow: function (row, data, dataIndex) {
                $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
            }
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            initToggleToolbar();
            toggleToolbars();
            handleDeleteRows();
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Filter Datatable
    var handleFilterDatatable = () =&gt; {
        // Select filter options
        filterPayment = document.querySelectorAll('[data-kt-docs-table-filter="payment_type"] [name="payment_type"]');
        const filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');

        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            // Get filter values
            let paymentValue = '';

            // Get payment value
            filterPayment.forEach(r =&gt; {
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

    // Delete customer
    var handleDeleteRows = () =&gt; {
        // Select all delete buttons
        const deleteButtons = document.querySelectorAll('[data-kt-docs-table-filter="delete_row"]');

        deleteButtons.forEach(d =&gt; {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const customerName = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + customerName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        // Simulate delete request -- for demo purpose only
                        Swal.fire({
                            text: "Deleting " + customerName,
                            icon: "info",
                            buttonsStyling: false,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function () {
                            Swal.fire({
                                text: "You have deleted " + customerName + "!.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                // delete row data from server and re-draw datatable
                                dt.draw();
                            });
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: customerName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    // Reset Filter
    var handleResetForm = () =&gt; {
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

    // Init toggle toolbar
    var initToggleToolbar = function () {
        // Toggle selected action toolbar
        // Select all checkboxes
        const container = document.querySelector('#kt_datatable_example_1');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        // Select elements
        const deleteSelected = document.querySelector('[data-kt-docs-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c =&gt; {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {
            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected customers?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                },
            }).then(function (result) {
                if (result.value) {
                    // Simulate delete request -- for demo purpose only
                    Swal.fire({
                        text: "Deleting selected customers",
                        icon: "info",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 2000
                    }).then(function () {
                        Swal.fire({
                            text: "You have deleted all selected customers!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            // delete row data from server and re-draw datatable
                            dt.draw();
                        });

                        // Remove header checked box
                        const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;
                    });
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Selected customers was not deleted.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        });
    }

    // Toggle toolbars
    var toggleToolbars = function () {
        // Define variables
        const container = document.querySelector('#kt_datatable_example_1');
        const toolbarBase = document.querySelector('[data-kt-docs-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-docs-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-docs-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements
        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state &amp; count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c =&gt; {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    // Public methods
    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
            initToggleToolbar();
            handleFilterDatatable();
            handleDeleteRows();
            handleResetForm();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});</code>
</pre>
														</div>
													</div>
													<div class="tab-pane fade" id="kt_highlight_6244455240d5c" role="tabpanel">
														<div class="highlight-code">
															<pre class="language-php" style="height:400px">
<code class="language-php">&lt;?php
include 'class-list-util.php';

class DataTableApi
{
    public $columnsDefault = [
        'RecordID'         =&gt; true,
        'OrderID'          =&gt; true,
        'Name'             =&gt; true,
        'Country'          =&gt; true,
        'CountryCode'      =&gt; true,
        'City'             =&gt; true,
        'Company'          =&gt; true,
        'Address'          =&gt; true,
        'Email'            =&gt; true,
        'Currency'         =&gt; true,
        'Notes'            =&gt; true,
        'Department'       =&gt; true,
        'Website'          =&gt; true,
        'Latitude'         =&gt; true,
        'Longitude'        =&gt; true,
        'Datetime'         =&gt; true,
        'TimeZone'         =&gt; true,
        'Money'            =&gt; true,
        'Gender'           =&gt; true,
        'CreditCardNumber' =&gt; true,
        'CreditCardType'   =&gt; true,
    ];

    public function __construct()
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: *');
    }

    public function init()
    {
        if (isset($_REQUEST['columnsDef']) &amp;&amp; is_array($_REQUEST['columnsDef'])) {
            foreach ($_REQUEST['columnsDef'] as $field) {
                $columnsDefault[$field] = true;
            }
        }

        // get all raw data
        $alldata = $this-&gt;getJsonDecode();

        $data = [];
        // internal use; filter selected columns only from raw data
        foreach ($alldata as $d) {
            $data[] = $this-&gt;filterArray($d, $this-&gt;columnsDefault);
        }

        // filter by general search keyword
        if (isset($_REQUEST['search']['value']) &amp;&amp; $_REQUEST['search']['value']) {
            $data = $this-&gt;arraySearch($data, $_REQUEST['search']['value']);
        }

        // count data
        $totalRecords = $totalDisplay = count($data);

        // sort
        if (isset($_REQUEST['order'][0]['column']) &amp;&amp; $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['order'][0]['column'];
            $dir    = $_REQUEST['order'][0]['dir'];
            usort($data, function ($a, $b) use ($column, $dir) {
                $a = array_slice($a, $column, 1);
                $b = array_slice($b, $column, 1);
                $a = array_pop($a);
                $b = array_pop($b);

                if ($dir === 'asc') {
                    return $a &gt; $b ? 1 : -1;
                }

                return $a &lt; $b ? 1 : -1;
            });
        }

        // pagination length
        if (isset($_REQUEST['length'])) {
            $data = array_splice($data, $_REQUEST['start'], $_REQUEST['length']);
        }

        $data = $this-&gt;reformat($data);

        $result = [
            'recordsTotal'    =&gt; $totalRecords,
            'recordsFiltered' =&gt; $totalDisplay,
            'data'            =&gt; $data,
        ];

        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function filterArray($array, $allowed = [])
    {
        return array_filter(
            $array,
            function ($val, $key) use ($allowed) { // N.b. $val, $key not $key, $val
                return isset($allowed[$key]) &amp;&amp; ($allowed[$key] === true || $allowed[$key] === $val);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    public function filterKeyword($data, $search, $field = '')
    {
        $filter = '';
        if (isset($search['value'])) {
            $filter = $search['value'];
        }
        if (!empty($filter)) {
            if (!empty($field)) {
                if (strpos(strtolower($field), 'date') !== false) {
                    // filter by date range
                    $data = $this-&gt;filterByDateRange($data, $filter, $field);
                } else {
                    // filter by column
                    $data = array_filter($data, function ($a) use ($field, $filter) {
                        return (boolean) preg_match("/$filter/i", $a[$field]);
                    });
                }

            } else {
                // general filter
                $data = array_filter($data, function ($a) use ($filter) {
                    return (boolean) preg_grep("/$filter/i", (array) $a);
                });
            }
        }

        return $data;
    }

    public function filterByDateRange($data, $filter, $field)
    {
        // filter by range
        if (!empty($range = array_filter(explode('|', $filter)))) {
            $filter = $range;
        }

        if (is_array($filter)) {
            foreach ($filter as &amp;$date) {
                // hardcoded date format
                $date = date_create_from_format('m/d/Y', stripcslashes($date));
            }
            // filter by date range
            $data = array_filter($data, function ($a) use ($field, $filter) {
                // hardcoded date format
                $current = date_create_from_format('m/d/Y', $a[$field]);
                $from    = $filter[0];
                $to      = $filter[1];
                if ($from &lt;= $current &amp;&amp; $to &gt;= $current) {
                    return true;
                }

                return false;
            });
        }

        return $data;
    }

    public function getJsonDecode(): mixed
    {
        return json_decode(file_get_contents('customers.json'), true);
    }

    /**
     * @param  array  $data
     *
     * @return array
     */
    public function reformat($data): array
    {
        return array_map(function ($item) {
            // hide credit card number
            $item['CreditCardNumber'] = '**** '.substr($item['CreditCardNumber'], -4);

            $item['CreditCardType'] = $item['CreditCardType'] === 'americanexpress' ? 'american-express' : $item['CreditCardType'];

            // reformat datetime
            $item['Datetime'] = date('d M Y, g:i a', strtotime($item['Datetime']));

            return $item;
        }, $data);
    }

    public function arraySearch($array, $keyword)
    {
        return array_filter($array, function ($a) use ($keyword) {
            return (boolean) preg_grep("/$keyword/i", (array) $a);
        });
    }

}

$api = new DataTableApi;
$api-&gt;init();</code>
</pre>
														</div>
													</div>
													<div class="tab-pane fade" id="kt_highlight_6244455240d5d" role="tabpanel">
														<div class="highlight-code">
															<pre class="language-php" style="height:400px">
<code class="language-php">&lt;?php
/**
 * class-list-util.php
 *
 * List utility class
 */

/**
 * List utility.
 *
 * Utility class to handle operations on an array of objects.
 */
class List_Util
{
    /**
     * The input array.
     *
     * @access private
     * @var array
     */
    private $input = array();

    /**
     * The output array.
     *
     * @access private
     * @var array
     */
    private $output = array();

    /**
     * Temporary arguments for sorting.
     *
     * @access private
     * @var array
     */
    private $orderby = array();

    /**
     * Constructor.
     *
     * Sets the input array.
     *
     *
     * @param  array  $input  Array to perform operations on.
     */
    public function __construct($input)
    {
        $this-&gt;output = $this-&gt;input = $input;
    }

    /**
     * Returns the original input array.
     *
     * @access public
     *
     * @return array The input array.
     */
    public function get_input()
    {
        return $this-&gt;input;
    }

    /**
     * Returns the output array.
     *
     * @access public
     *
     * @return array The output array.
     */
    public function get_output()
    {
        return $this-&gt;output;
    }

    /**
     * Filters the list, based on a set of key =&gt; value arguments.
     *
     *
     * @param  array  $args  Optional. An array of key =&gt; value arguments to match
     *                         against each object. Default empty array.
     * @param  string  $operator  Optional. The logical operation to perform. 'AND' means
     *                         all elements from the array must match. 'OR' means only
     *                         one element needs to match. 'NOT' means no elements may
     *                         match. Default 'AND'.
     *
     * @return array Array of found values.
     */
    public function filter($args = array(), $operator = 'AND')
    {
        if (empty($args)) {
            return $this-&gt;output;
        }

        $operator = strtoupper($operator);

        if (!in_array($operator, array('AND', 'OR', 'NOT'), true)) {
            return array();
        }

        $count    = count($args);
        $filtered = array();

        foreach ($this-&gt;output as $key =&gt; $obj) {
            $to_match = (array) $obj;

            $matched = 0;
            foreach ($args as $m_key =&gt; $m_value) {
                if (array_key_exists($m_key, $to_match) &amp;&amp; $m_value == $to_match[$m_key]) {
                    $matched++;
                }
            }

            if (
                ('AND' == $operator &amp;&amp; $matched == $count) ||
                ('OR' == $operator &amp;&amp; $matched &gt; 0) ||
                ('NOT' == $operator &amp;&amp; 0 == $matched)
            ) {
                $filtered[$key] = $obj;
            }
        }

        $this-&gt;output = $filtered;

        return $this-&gt;output;
    }

    /**
     * Plucks a certain field out of each object in the list.
     *
     * This has the same functionality and prototype of
     * array_column() (PHP 5.5) but also supports objects.
     *
     *
     * @param  int|string  $field  Field from the object to place instead of the entire object
     * @param  int|string  $index_key  Optional. Field from the object to use as keys for the new array.
     *                              Default null.
     *
     * @return array Array of found values. If `$index_key` is set, an array of found values with keys
     *               corresponding to `$index_key`. If `$index_key` is null, array keys from the original
     *               `$list` will be preserved in the results.
     */
    public function pluck($field, $index_key = null)
    {
        if (!$index_key) {
            /*
             * This is simple. Could at some point wrap array_column()
             * if we knew we had an array of arrays.
             */
            foreach ($this-&gt;output as $key =&gt; $value) {
                if (is_object($value)) {
                    $this-&gt;output[$key] = $value-&gt;$field;
                } else {
                    $this-&gt;output[$key] = $value[$field];
                }
            }

            return $this-&gt;output;
        }

        /*
         * When index_key is not set for a particular item, push the value
         * to the end of the stack. This is how array_column() behaves.
         */
        $newlist = array();
        foreach ($this-&gt;output as $value) {
            if (is_object($value)) {
                if (isset($value-&gt;$index_key)) {
                    $newlist[$value-&gt;$index_key] = $value-&gt;$field;
                } else {
                    $newlist[] = $value-&gt;$field;
                }
            } else {
                if (isset($value[$index_key])) {
                    $newlist[$value[$index_key]] = $value[$field];
                } else {
                    $newlist[] = $value[$field];
                }
            }
        }

        $this-&gt;output = $newlist;

        return $this-&gt;output;
    }

    /**
     * Sorts the list, based on one or more orderby arguments.
     *
     *
     * @param  string|array  $orderby  Optional. Either the field name to order by or an array
     *                                    of multiple orderby fields as $orderby =&gt; $order.
     * @param  string  $order  Optional. Either 'ASC' or 'DESC'. Only used if $orderby
     *                                    is a string.
     * @param  bool  $preserve_keys  Optional. Whether to preserve keys. Default false.
     *
     * @return array The sorted array.
     */
    public function sort($orderby = array(), $order = 'ASC', $preserve_keys = false)
    {
        if (empty($orderby)) {
            return $this-&gt;output;
        }

        if (is_string($orderby)) {
            $orderby = array($orderby =&gt; $order);
        }

        foreach ($orderby as $field =&gt; $direction) {
            $orderby[$field] = 'DESC' === strtoupper($direction) ? 'DESC' : 'ASC';
        }

        $this-&gt;orderby = $orderby;

        if ($preserve_keys) {
            uasort($this-&gt;output, array($this, 'sort_callback'));
        } else {
            usort($this-&gt;output, array($this, 'sort_callback'));
        }

        $this-&gt;orderby = array();

        return $this-&gt;output;
    }

    /**
     * Callback to sort the list by specific fields.
     *
     * @access private
     *
     * @param  object|array  $a  One object to compare.
     * @param  object|array  $b  The other object to compare.
     *
     * @return int 0 if both objects equal. -1 if second object should come first, 1 otherwise.
     * @see    List_Util::sort()
     *
     */
    private function sort_callback($a, $b)
    {
        if (empty($this-&gt;orderby)) {
            return 0;
        }

        $a = (array) $a;
        $b = (array) $b;

        foreach ($this-&gt;orderby as $field =&gt; $direction) {
            if (!isset($a[$field]) || !isset($b[$field])) {
                continue;
            }

            if ($a[$field] == $b[$field]) {
                continue;
            }

            $results = 'DESC' === $direction ? array(1, -1) : array(-1, 1);

            if (is_numeric($a[$field]) &amp;&amp; is_numeric($b[$field])) {
                return ($a[$field] &lt; $b[$field]) ? $results[0] : $results[1];
            }

            return 0 &gt; strcmp($a[$field], $b[$field]) ? $results[0] : $results[1];
        }

        return 0;
    }
}

function list_filter($list, $args = array(), $operator = 'AND')
{
    if (!is_array($list)) {
        return array();
    }

    $util = new List_Util($list);

    return $util-&gt;filter($args, $operator);
}</code>
</pre>
														</div>
													</div>
												</div>
											</div>
											<!--end::Highlight-->
										</div>
										<!--end::Code-->
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
				
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
		
		
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/custom/documentation/documentation.js"></script>
		<script src="assets/js/custom/documentation/search.js"></script>
		<script src="assets/js/custom/documentation/general/datatables/server-side.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>