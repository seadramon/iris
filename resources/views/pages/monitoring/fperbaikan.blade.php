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
						<div class="card-title fs-3 fw-bolder">View Form Perbaikan</div>
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
									<h3>Kerusakan</h3>
									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Kerusakan</label>
										{!! Form::text('kerusakan', null, ['class'=>'form-control', 'id'=>'kerusakan', 'disabled']) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Penyebab</label>
										{!! Form::text('penyebab', null, ['class'=>'form-control', 'id'=>'penyebab', 'disabled']) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Penanganan</label>
										{!! Form::text('penanganan', null, ['class'=>'form-control', 'id'=>'penanganan', 'disabled']) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Waktu Kerusakan</label>
										{!! Form::text('waktu_kerusakan', null, ['class'=>'form-control', 'id'=>'waktu_kerusakan', 'disabled']) !!}
									</div>

									<div class="form-group">
										<label class="fs-6 fw-bold mt-2 mb-3">Foto Kerusakan</label><br>
										<!--begin::Image input-->
										<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
											<!--begin::Preview existing avatar-->
											<div class="image-input-wrapper w-200px h-200px bgi-position-center" style="background-size: 75%; background-image: url('{{full_url_from_path($data->kerusakan_path)}}')"></div>
											<!--end::Preview existing avatar-->
										</div>
										<!--end::Image input-->
									</div>
									<br>

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
									$teknisi = $posisi['teknisi'] ?? null;
									?>

									@if (!empty($teknisi))
										<h3>Teknisi</h3>
										<div class="form-group">
											<label class="fs-6 fw-bold mt-2 mb-3">Prediksi</label>
											{!! Form::text('prediksi_teknisi', null, ['class'=>'form-control', 'id'=>'prediksi_teknisi', 'disabled']) !!}
										</div>

										<div class="form-group">
											<label class="fs-6 fw-bold mt-2 mb-3">Estimasi</label>
											{!! Form::text('estimasi_teknisi', null, ['class'=>'form-control', 'id'=>'estimasi_teknisi', 'disabled']) !!}
										</div>

										<?php
										$perbaikans = !empty($data->perbaikan)?explode("|", $data->perbaikan):[];
										?>
										<div class="form-group">
											<label class="fs-6 fw-bold mt-2 mb-3">Perbaikan</label>
											@if (count($perbaikans) > 0)
												@foreach($perbaikans as $perbaikan)
													<div class="form-check form-check-custom form-check-success form-check-solid form-check-sm">
													    <input class="form-check-input" type="checkbox" value="" checked id="flexCheckboxSm" disabled="true" />
													    <label class="form-check-label" for="flexCheckboxSm">
													        {{$perbaikan}}
													    </label>
													</div><br>
												@endforeach
											@endif
										</div>

										<h4>Suku Cadang</h4>
										@if (count($sukucadang) > 0)
											@foreach($sukucadang as $item)
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label class="fs-6 fw-bold mt-2 mb-3">Nama</label>
														{!! Form::textarea('nama', !empty($item->material)?$item->material->kd_material.' - '.$item->material->uraian:"", ['class'=>'form-control', 'id'=>'nama', 'disabled', 'rows'=>'2']) !!}
													</div>
												</div>
												<div class="col">
													<div class="form-group">
														<label class="fs-6 fw-bold mt-2 mb-3">Spesifikasi</label>
														{!! Form::textarea('spesifikasi', !empty($item->material)?$item->material->spesifikasi:"", ['class'=>'form-control', 'id'=>'spesifikasi', 'disabled', 'rows'=>'2']) !!}
													</div>
												</div>
												<div class="col">
													<div class="form-group">
														<label class="fs-6 fw-bold mt-2 mb-3">Quantity</label>
														<?php 
														$satuan = !empty($item->material)?$item->material->satuan:"";
														?>
														{!! Form::text('qty', $item->qty.' '.$satuan, ['class'=>'form-control', 'id'=>'qty', 'disabled']) !!}
													</div>
												</div>
												<div class="col">
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
											<label class="fs-6 fw-bold mt-2 mb-3">Pengerjaan Perbaikan</label>
											{!! Form::text('pengerjaan_perbaikan', $data->perbaikan_mulai.' s/d '.$data->perbaikan_selesai, ['class'=>'form-control', 'id'=>'pengerjaan_perbaikan', 'disabled']) !!}
										</div>	

										<div class="form-group">
											<label class="fs-6 fw-bold mt-2 mb-3">Mengganggu Produksi</label>
											{!! Form::text('mengganggu', $data->mengganggu, ['class'=>'form-control', 'id'=>'mengganggu', 'disabled']) !!}
										</div>

										<div class="row">
											<div class="col">
												<div class="form-group">
													<label class="fs-6 fw-bold mt-2 mb-3">Teknisi</label>
													{!! Form::text('teknisi', !empty($teknisi->pic)?$teknisi->pic->full_name:null, ['class'=>'form-control', 'id'=> $teknisi->posisi, 'disabled']) !!}
												</div><br>	
											</div>		
											<div class="col">
												<br><br>
												<!--begin::Image input-->
												<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
													<!--begin::Preview existing avatar-->
													@if (!empty($teknisi))
													<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('{{full_url_from_path($teknisi->sign_path)}}')"></div>
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