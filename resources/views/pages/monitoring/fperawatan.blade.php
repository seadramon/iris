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
						<div class="card-title fs-3 fw-bolder">View Form Perawatan</div>
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
										{!! Form::text('kode', !empty($inventory)?$inventory->location->ket:null, ['class'=>'form-control', 'id'=>'kode', 'disabled']) !!}
									</div>
									<br>
									<h3>Perawatan</h3>
									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Pemeriksaan</label>
										{!! Form::text('pemeriksaan', null, ['class'=>'form-control', 'id'=>'pemeriksaan', 'disabled']) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Hasil Pemeriksaan</label>
										{!! Form::text('pemeriksaan_hasil', null, ['class'=>'form-control', 'id'=>'pemeriksaan_hasil', 'disabled']) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Penanganan</label>
										{!! Form::text('penanganan', null, ['class'=>'form-control', 'id'=>'penanganan', 'disabled']) !!}
									</div>
									<br>
									<h4>Suku Cadang</h4>
									@if (count($sukucadang) > 0)
										@foreach($sukucadang as $item)
										<div class="row">
											<div class="col-4">
												<div class="form-group">
													<label class="fs-6 fw-bold mt-2 mb-3">Nama</label>
													{!! Form::textarea('nama', !empty($item->material)?$item->material->kd_material.' - '.$item->material->uraian:"", ['class'=>'form-control', 'id'=>'nama', 'disabled', 'rows'=>'2']) !!}
												</div>
											</div>
											<div class="col-4">
												<div class="form-group">
													<label class="fs-6 fw-bold mt-2 mb-3">Spesifikasi</label>
													{!! Form::textarea('spesifikasi', !empty($item->material)?$item->material->spesifikasi:"", ['class'=>'form-control', 'id'=>'spesifikasi', 'disabled', 'rows'=>'2']) !!}
												</div>
											</div>
											<div class="col-1">
												<div class="form-group">
													<label class="fs-6 fw-bold mt-2 mb-3">Quantity</label>
													<?php 
													$satuan = !empty($item->material)?$item->material->satuan:"";
													?>
													{!! Form::text('qty', $item->qty.' '.$satuan, ['class'=>'form-control', 'id'=>'qty', 'disabled']) !!}
												</div>
											</div>
											<div class="col-3">
												<div class="form-group">
													<label class="fs-6 fw-bold mt-2 mb-3">Catatan</label>
													{!! Form::textarea('spesifikasi', !empty($item->catatan)?$item->catatan:"", ['class'=>'form-control', 'id'=>'catatan', 'disabled', 'rows'=>'2']) !!}
												</div>
											</div>
										</div>
										@endforeach
									@endif

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Catatan</label>
										{!! Form::text('catatan', null, ['class'=>'form-control', 'id'=>'catatan', 'disabled']) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Tanggal Lapor</label>
										{!! Form::text('created_at', null, ['class'=>'form-control', 'id'=>'created_at', 'disabled']) !!}
									</div>	

									<div class="row">
										<div class="col">
											<div class="form-group">
												<label class="fs-6 fw-bold mt-2 mb-3">Pelapor</label>
												{!! Form::text('pelapor', $sign->pic->full_name, ['class'=>'form-control', 'id'=>'pelapor', 'disabled']) !!}
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

									<h3>Approval</h3>
									@if (count($signatures) > 0)
										@foreach($signatures as $signature)
											@if(in_array($signature->posisi, ['operator', 'manajer']))
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label class="fs-6 fw-bold mt-2 mb-3">{{ ucwords($signature->posisi) }}</label>
														{!! Form::text($signature->posisi, $signature->pic->full_name, ['class'=>'form-control', 'id'=> $signature->posisi, 'disabled']) !!}
													</div><br>	
												</div>		
												<div class="col">
													<br><br>
													<!--begin::Image input-->
													<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
														<!--begin::Preview existing avatar-->
														@if ($signature->posisi == 'manajer')
														<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('{{ route('api.file.viewer', ['path' => $signature->sign_by]) }}')"></div>
														@else
														<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('{{full_url_from_path($signature->sign_path)}}')"></div>
														@endif
														<!--end::Preview existing avatar-->
													</div>
													<!--end::Image input-->
													<div class="form-text">Signatures.</div>
												</div>								
											</div>
											@endif
										@endforeach
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