@extends('layouts.app')
@section('pagetitle', 'Used Material')

@section('extra-css')
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
					List Permintaan Sukucadang</h1>
					<!--end::Heading-->
					<!--begin::Block-->
					<div class="py-5">
						<!--begin::Card-->
						<div class="card card-p-0 card-flush">
							<!--begin::Card header-->
							<div class="card-header align-items-center py-5 gap-2 gap-md-5">
								<!--begin::Card toolbar-->
								<div class="card-toolbar flex-row-fluid justify-content-end gap-5">
									<!--begin::Group actions-->
								    <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
								        <div class="fw-bolder me-5">
								            <span class="me-2" data-kt-docs-table-select="selected_count"></span> Selected
								        </div>
								    </div>
								    <!--end::Group actions-->

									<!--begin::Export dropdown-->
									<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_tambah_permintaan">
									Tambah Permintaan</button>
									<!--end::Export dropdown-->
								</div>
								<!--end::Card toolbar-->
							</div>
							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body">
								<!--begin::Table-->
								<table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="tb_permintaan_sc">
									<thead>
										<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase">
											<th class="w-10px pe-2">
									            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
									                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#tb_permintaan_sc .form-check-input" value="1"/>
									            </div>
									        </th>
											<th>Kode</th>
											<th>Nama</th>
											<th>Spek</th>
											<th>Jumlah</th>
											<th>Catatan</th>
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

<!--begin::Modal - Create Api Key-->
<div class="modal fade" id="modal_tambah_permintaan" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header" id="modal_tambah_permintaan_header">
				<!--begin::Modal title-->
				<h2>Tambah Permintaan</h2>
				<!--end::Modal title-->
				<!--begin::Close-->
				<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
					<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
					<span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
							<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
						</svg>
					</span>
					<!--end::Svg Icon-->
				</div>
				<!--end::Close-->
			</div>
			<!--end::Modal header-->
			<!--begin::Form-->
			<form method="post" id="modal_tambah_permintaan_form" class="form" action="{{ route('usedmaterial.store') }}">
				<input type="hidden" name="kd_material" id="kd_material_id">
				<!--begin::Modal body-->
				<div class="modal-body px-lg-10">
					<!--begin::Scroll-->
					<div class="scroll-y me-n7 pe-7" id="modal_tambah_permintaan_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modal_tambah_permintaan_header" data-kt-scroll-wrappers="#modal_tambah_permintaan_scroll" data-kt-scroll-offset="300px">
						<div id="inputmaterial"></div>
					</div>
					<!--end::Scroll-->
				</div>
				<!--end::Modal body-->

				<!--begin::Modal footer-->
				<div class="modal-footer flex-right">
					<button type="submit" id="modal_tambah_permintaan_submit" class="btn btn-primary">
						<span class="indicator-label">Submit</span>
						<span class="indicator-progress">Please wait...
						<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
					</button>
				</div>
				<!--end::Modal footer-->
			</form>
			<!--end::Form-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
<!--end::Modal - Create Api Key-->
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
	        dt = $("#tb_permintaan_sc").DataTable({
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
	            select: {
	                style: 'multi',
	                selector: 'td:first-child input[type="checkbox"]',
	                className: 'row-selected'
	            },
	            ajax: "{{ route('usedmaterial.data') }}",
	            columns: [
	                {data: 'fullname', name: 'fullname', defaultContent: '-', orderable: false, searchable: false},
	                {data: 'kd_material', name: 'kd_material', defaultContent: '-'},
	                {data: 'material.uraian', name: 'uraian', defaultContent: '-', orderable: false, searchable: false},
	                {data: 'material.spesifikasi', name: 'spesifikasi', defaultContent: '-'},
	                {data: 'jumlah', name: 'jumlah', defaultContent: '-'},
	                {data: 'catatan', name: 'catatan', defaultContent: '-'},
	                {data: 'menu', orderable: false, searchable: false}
	            ],
	            columnDefs: [
	            	{
	            	    targets: 0,
	            	    orderable: false,
	            	    render: function (data) {
	            	        return `
	            	            <div class="form-check form-check-sm form-check-custom form-check-solid">
	            	                <input class="form-check-input" type="checkbox" value="${data}" />
	            	            </div>`;
	            	    }
	            	}
	            ],
	        });

	        table = dt.$;

	        dt.on('draw', function () {
	            initToggleToolbar();
	            toggleToolbars();
	            KTMenu.createInstances();
	        });
	    }

	    // Init toggle toolbar
	    var initToggleToolbar = function () {
	        // Toggle selected action toolbar
	        // Select all checkboxes
	        const container = document.querySelector('#tb_permintaan_sc');
	        const checkboxes = container.querySelectorAll('[type="checkbox"]');

	        let i = 0;
	        // Toggle delete selected toolbar
	        checkboxes.forEach(c => {
	            // Checkbox on click event
	            c.addEventListener('click', function () {
	                setTimeout(function () {
	                    toggleToolbars();
	                }, 50);
	            });
	        });
	    }

	    // Toggle toolbars
    	var toggleToolbars = function () {
	        // Define variables
	        const container = document.querySelector('#tb_permintaan_sc');
        	const toolbarSelected = document.querySelector('[data-kt-docs-table-toolbar="selected"]');
        	const selectedCount = document.querySelector('[data-kt-docs-table-select="selected_count"]');

	        // Select refreshed checkbox DOM elements
	        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

	        // Detect checkboxes state & count
	        let checkedState = false;
	        let count = 0;
	        let checkedVal = '';
	        $("#inputmaterial").html("");

	        // Count checked boxes
	        allCheckboxes.forEach(c => {
	            if (c.checked) {
	            	checkedVal += c.value + ','; 
	                checkedState = true;
	                count++;
	            }
	        });

	        if (checkedVal) {
	        	let arrCekVal = checkedVal.split(",");
	        	$("#inputmaterial").html("");

	        	let i = 0;
	        	arrCekVal.forEach(c => {
	        		if (c) {
	        			let tmp = c.split("#");
	        			if (tmp[1]) {
	        				let html = "<div class='row'>" +
	        					"<div class='row'>" +
		        					"<div class='col-lg-9'><div class='form-group'>" +
		        						"<input type='hidden' name='permintaan[" + i + "][id_material]'" + "value='" + tmp[0] + "'>" + "<label class='fs-6 fw-bold mt-2 mb-3'>" +  tmp[1] + "</label>" +
										"<select class='form-select select2kodelini' data-control='select2' data-dropdown-parent='#modal_tambah_permintaan' data-placeholder='Pilih Kodelini' data-allow-clear='true' name='permintaan[" + i + "][kd_lini]'>" +
										"</select>"+
									"</div></div>" + 

									"<div class='col-lg-3'><div class='form-group'>" +
		        						"<label class='fs-6 fw-bold mt-2 mb-3'>Qty</label>" +
										"<input type='number' name='permintaan[" + i + "][qty]' class='form-control'>"
									"</div></div>" + 
								"</div>" +
							"</div>";

							$("#inputmaterial").append(html);
							i++;
	        			}
	        		}
	        	});

	        	$(".select2kodelini").select2({
	        		ajax: {
		                url: '/usedmaterial/kodelini',
		                dataType: 'json',
		                data: function (params) {
		                    return {
		                        q: $.trim(params.term)
		                    };
		                },
		                processResults: function (data) {
		                    return {
		                        results: data
		                    };
		                },
		                cache: true
		            }
	        	});
	        }

	        // Toggle toolbars
	        if (checkedState) {
	            selectedCount.innerHTML = count;
	            $("#kd_material_id").val(checkedVal);
	            toolbarSelected.classList.remove('d-none');
	        } else {
	            toolbarSelected.classList.add('d-none');
	        }
	    }
		    
	    // Public methods
	    return {
	        init: function () {
	            initDatatable();
	            initToggleToolbar();
	        }
	    }
	}();

	// On document ready
	KTUtil.onDOMContentLoaded(function () {
	    KTDatatablesServerSide.init();
	});

	$('body').on('click', '.delete', function () {
		if (confirm("Delete Record?") == true) {
			var kd_tipe_pc = $(this).data('id');

			// ajax
			$.ajax({
				type:"post",
				url: "{{ url('usedmaterial.data/destroy') }}",
				data: {kd_tipe_pc : kd_tipe_pc, _token: "{{ csrf_token() }}"},
				success: function(res){
					if (res.result == 'success') {
						flasher.success("Data telah berhasil dihapus!");

						$('#tb_permintaan_sc').DataTable().ajax.url("{{ route('usedmaterial.data') }}").load();
					}
				}
			});
		}
	});

	$("#modal_tambah_permintaan_form").submit(function(event) {
		event.preventDefault();
		$("#modal_tambah_permintaan_submit").attr("data-kt-indicator", "on");

		let data = $(this).serialize();

		$.ajax({
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    type:"post",
			url: "{{ route('usedmaterial.store') }}",
			data: data,
			success: function(res) {
				$("#modal_tambah_permintaan_submit").removeAttr("data-kt-indicator");

				$('#modal_tambah_permintaan').modal('toggle');
				flasher.success("Permintaan berhasil ditambahkan!");
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$("#modal_tambah_permintaan_submit").removeAttr("data-kt-indicator");

		    	$('#modal_tambah_permintaan').modal('toggle');
		    	flasher.error("Permintaan gagal ditambahkan!");
		    }
		})
	});

	$(".datepicker").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"),10),
        locale: {
            format: 'YYYY-MM-DD'
        }
    });


</script>
@endsection