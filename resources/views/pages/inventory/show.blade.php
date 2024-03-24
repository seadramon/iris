@extends('layouts.app')
@section('pagetitle', 'Inventory Management')

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
						<div class="card-title fs-3 fw-bolder">View Data</div>
						<!--end::Card title-->
					</div>
					<!--end::Card header-->
					<!--begin::Form-->
					<form id="kt_project_settings_form" class="form">
					@if (isset($data))
	                    {!! Form::model($data, ['route' => ['inventory.store'], 'class' => 'form', 'id' => 'kt_project_settings_form']) !!}
	                @else
	                    {!! Form::open(['url' => route('inventory.store'), 'class' => 'form', 'id' => 'kt_project_settings_form']) !!}
	                @endif
						<!--begin::Card body-->
						<div class="card-body p-9">
							<!--begin::Row-->
							<div class="row mb-8">
								<div class="col-xl-8">
									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Codefication</label>
										{!! Form::text('no_inventaris', null, ['class'=>'form-control', 'id'=>'no_inventaris', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Name</label>
										{!! Form::text('uraian', null, ['class'=>'form-control', 'id'=>'uraian', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">IK Category</label>
										{!! Form::text('kd_alat', !empty($data->category)?$data->category->ket:null, ['class'=>'form-control', 'id'=>'kd_alat', $disabled]) !!}
									</div>	

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Brandk</label>
										{!! Form::text('kd_merk', !empty($data->brand)?$data->brand->ket:null, ['class'=>'form-control', 'id'=>'kd_merk', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Spesification</label>
										{!! Form::text('kapasitas', null, ['class'=>'form-control', 'id'=>'kapasitas', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Type</label>
										{!! Form::text('tipe', null, ['class'=>'form-control', 'id'=>'tipe', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Serial No</label>
										{!! Form::text('no_seri', null, ['class'=>'form-control', 'id'=>'no_seri', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Manufacture Year</label>
										{!! Form::text('th_pembuatan', null, ['class'=>'form-control', 'id'=>'th_pembuatan', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Acquisition Year</label>
										{!! Form::text('th_perolehan', null, ['class'=>'form-control', 'id'=>'th_perolehan', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Operation Function</label>
										{!! Form::number('operasi', null, ['class'=>'form-control', 'id'=>'operasi', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Power Function</label>
										{!! Form::number('operasi', null, ['class'=>'form-control', 'id'=>'operasi', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Total</label>
										{!! Form::number('operasi', null, ['class'=>'form-control', 'id'=>'operasi', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Safety</label>
										{!! Form::number('operasi', null, ['class'=>'form-control', 'id'=>'operasi', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Langkap</label>
										{!! Form::number('operasi', null, ['class'=>'form-control', 'id'=>'operasi', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Condition</label>
										{!! Form::number('operasi', null, ['class'=>'form-control', 'id'=>'operasi', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Status</label>
										{!! Form::select('kondisi', $status, null, ['class'=>'form-select', 'id'=>'kondisi', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">PIC</label>
										{!! Form::text('last_updated_by', $data->pic, ['class'=>'form-control', 'id'=>'last_updated_by', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Functional Placement</label>
										{!! Form::text('kd_fungsi', !empty($data->fungsi)?$data->fungsi->ket:null, ['class'=>'form-control', 'id'=>'kd_fungsi', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Location</label>
										{!! Form::select('kd_lokasi', $lokasi, null, ['class'=>'form-select', 'id'=>'kd_lokasi', $disabled]) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Remark</label>
										{!! Form::number('uraian', null, ['class'=>'form-control', 'id'=>'uraian', $disabled]) !!}
									</div>
								</div>
								
								<div class="col-xl-4">
									<div class="visible-print text-center">
										<b>{{$data->no_inventaris}}</b>
										<p>BATCHING PLANT</p>
									    {!! QrCode::size(280)->generate($data->no_inventaris); !!}
									</div>
								</div>
							</div>
							<!--end::Row-->
						</div>
						<!--end::Card body-->
						<!--begin::Card footer-->
						<div class="card-footer d-flex justify-content-end py-6 px-9">
							<a href="{{ route('inventory.index') }}" class="btn btn-light btn-active-light-primary me-2">Back</a>
							@if (!$disabled)
								<button type="submit" class="btn btn-primary" id="kt_project_settings_submit">Save Changes</button>
							@endif
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