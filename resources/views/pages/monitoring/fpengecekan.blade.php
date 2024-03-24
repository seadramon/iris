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
						<div class="card-title fs-3 fw-bolder">View Form Pengecekan</div>
						<!--end::Card title-->
					</div>
					<!--end::Card header-->
					<!--begin::Form-->
					<form id="kt_project_settings_form" class="form">
					@if (isset($data))
	                    {!! Form::model($data, ['route' => ['monitoring.store'], 'class' => 'form', 'id' => 'kt_project_settings_form']) !!}
	                @else
	                    {!! Form::open(['url' => route('monitoring.store'), 'class' => 'form', 'id' => 'kt_project_settings_form']) !!}
	                @endif
						<!--begin::Card body-->
						<div class="card-body p-9">
							<!--begin::Row-->
							<div class="row mb-8">
								<div class="col-xl-12">
									<h3>Inventaris</h3>
									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Kode</label>
										{!! Form::text('kode', !empty($inventory)?$inventory->no_inventaris:null, ['class'=>'form-control', 'id'=>'kode', 'disabled']) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Nama</label>
										{!! Form::text('kode', !empty($inventory)?$inventory->uraian:null, ['class'=>'form-control', 'id'=>'kode', 'disabled']) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Lokasi</label>
										{!! Form::text('kode', !empty($inventory->location)?$inventory->location->ket:null, ['class'=>'form-control', 'id'=>'kode', 'disabled']) !!}
									</div>
									<br>
									<h3>Pengecekan</h3>
									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Pengecekan</label>
										{!! Form::text('jenis', Str::studly($data->jenis), ['class'=>'form-control', 'id'=>'jenis', 'disabled']) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Periode</label>
										{!! Form::text('periodeval', ($data->periode == "monthly") ? getMonth($data->periode_counter) : 'Minggu ke '.$data->periode_counter, ['class'=>'form-control', 'id'=>'periodeval', 'disabled']) !!}
									</div>

									@if (count($cekdetails) > 0)
										<br>
										<h3>Pengecekan Detail</h3>

										@foreach($cekdetails as $detail)
											<div class="form-group">
												<label class="fs-6 fw-bold mt-2 mb-3">{{ $detail['parameter'] }}</label>
												{!! Form::text('nilai', $detail['nilai'], ['class'=>'form-control', 'id'=>'nilai', 'disabled']) !!}
											</div>
										@endforeach

									@endif

									<div class="row">
										<div class="col">
											<div class="form-group">
												<label class="fs-6 fw-bold mt-2 mb-3">Pelapor</label>
												{!! Form::text('pelapor', !empty($sign->pic)?$sign->pic->full_name:null, ['class'=>'form-control', 'id'=>'pelapor', 'disabled']) !!}
											</div><br>	
										</div>		
										<div class="col">
											<br>
											<!--begin::Image input-->
											<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
												<!--begin::Preview existing avatar-->
												<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('{{full_url_from_path($sign->sign_path)}}')"></div>
												<!--end::Preview existing avatar-->
											</div>
											<!--end::Image input-->
											<div class="form-text">Signatures.</div>
										</div>								
									</div>	

									<?php 
									$operator = $posisi['operator'] ?? null;
									$manajer = $posisi['manajer'] ?? null;
									?>

									@if (!empty($operator))
										<h3>Approval</h3>
										<br>
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label class="fs-6 fw-bold mt-2 mb-3">Operator</label>
													{!! Form::text('operator', !empty($operator->pic)?$operator->pic->full_name:null, ['class'=>'form-control', 'id'=> 'operator', 'disabled']) !!}
												</div><br>	
											</div>		
											<div class="col">
												<br><br>
												<!--begin::Image input-->
												<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
													<!--begin::Preview existing avatar-->
													@if (!empty($operator))
													<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('{{full_url_from_path($operator->sign_path)}}')"></div>
													@else
													<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%;"></div>
													@endif
													<!--end::Preview existing avatar-->
												</div>
												<!--end::Image input-->
												<div class="form-text">Signatures.</div>
											</div>								
										</div>

										@if (!empty($manajer))
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label class="fs-6 fw-bold mt-2 mb-3">Manajer</label>
														{!! Form::text('manajer', !empty($manajer->pic)?$manajer->pic->full_name:null, ['class'=>'form-control', 'id'=> 'manajer', 'disabled']) !!}
													</div><br>	
												</div>		
												<div class="col">
													<br><br>
													<!--begin::Image input-->
													<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
														<!--begin::Preview existing avatar-->
														@if (!empty($manajer))
														<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('{{ route('api.file.viewer', ['path' => $manajer->sign_by]) }}')"></div>
														@else
														<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%;"></div>
														@endif
														<!--end::Preview existing avatar-->
													</div>
													<!--end::Image input-->
													<div class="form-text">Signatures.</div>
												</div>								
											</div>
										@endif
									@endif
								</div>
							</div>
							<!--end::Row-->
						</div>
						<!--end::Card body-->
						<!--begin::Card footer-->
						<div class="card-footer d-flex justify-content-end py-6 px-9">
							<a href="{{ route('monitoring.index') }}" class="btn btn-light btn-active-light-primary me-2">Back</a>
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