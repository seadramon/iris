@extends('layouts.app')
@section('pagetitle', 'Cetak Report Inventory')

@section('content')
	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		
		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<!--begin::Container-->
			<div id="kt_content_container" class="container-xxl">
				<!--begin::Navbar-->
				<!--end::Navbar-->
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card header-->
					<div class="card-header">
						<!--begin::Card title-->
						<div class="card-title fs-3 fw-bolder">Cetak Report</div>
						<!--end::Card title-->
					</div>
					<!--end::Card header-->
					<!--begin::Form-->
                    {!! Form::open(['url' => route('report.age-export'), 'class' => 'form', 'id' => 'kt_project_settings_form', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
						<!--begin::Card body-->
						<div class="card-body p-9">

							<div class="form-group">
								<label class="fs-6 fw-bold mt-2 mb-3">Kode Pat</label>
								{!! Form::select('kd_pat', $pat, null, ['class'=>'form-select', 'id'=>'kd_pat', 'data-control' => 'select2']) !!}
							</div>

							<div class="form-group">
								<label class="fs-6 fw-bold mt-2 mb-3">Periode</label>
								{!! Form::text('period', null, ['class'=>'form-control periodpicker', 'id'=>'period']) !!}
							</div>
						</div>
						<!--end::Card body-->
						<!--begin::Card footer-->
						<div class="card-footer d-flex justify-content-end py-6 px-9">
							<input type="submit" class="btn btn-success" id="kt_project_settings_submit" value="Download Report">
						</div>
						<!--end::Card footer-->
					</form>
					<!--end:Form-->
				</div>
				<!--end::Card-->
			</div>
			<!--end::Container-->
		</div>
		<!--end::Post-->
	</div>
	<!--end::Content-->
@endsection

@section('extra-js')

<script type="text/javascript">

$(document).ready(function() {

$(".periodpicker").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format("YYYY"),10),
        locale: {
            format: 'MMMM-YYYY'
        }
    }
);


});
</script>
@endsection