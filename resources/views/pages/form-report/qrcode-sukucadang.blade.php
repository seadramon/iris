@extends('layouts.app')
@section('pagetitle', 'Generate QR Code')

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
						<div class="card-title fs-3 fw-bolder">Generate Qr Code Suku Cadang</div>
						<!--end::Card title-->
					</div>
					<!--end::Card header-->
					<!--begin::Form-->
                    {!! Form::open(['url' => route('report.qrcode-sukucadang-pdf'), 'class' => 'form', 'id' => 'kt_project_settings_form', 'method' => 'post', 'enctype' => 'multipart/form-data', 'target' => '_blank']) !!}
						<!--begin::Card body-->
						<div class="card-body p-9">

							<div class="form-group">
								<label class="fs-6 fw-bold mt-2 mb-3">Prefix Sukucadang</label>
								{!! Form::text('prefix', null, ['class'=>'form-control', 'id'=>'prefix', false]) !!}
							</div>
						</div>
						<!--end::Card body-->
						<!--begin::Card footer-->
						<div class="card-footer d-flex justify-content-end py-6 px-9">
							<input type="submit" class="btn btn-success" id="kt_project_settings_submit" value="Download">
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