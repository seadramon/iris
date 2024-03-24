@extends('layouts.app')

@section('extra-css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		
	<!--begin::Post-->
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<!--begin::Container-->
		<div id="kt_content_container" class="container-xxl">
			<div class="card card-xl-stretch mb-5 mb-xl-8">
				<div class="card-header">
					<h3 class="card-title">View Checklist Perawatan Detail</h3>
				</div>
				<div class="card-body">
                <table class="table table-rounded table-row-bordered border gy-7 gs-7" id="tabel_item_pc">
					<tbody class="fw-bold text-gray-600">
						<tr>
                            <td style="width: 25%;"><b>Nama Checklist Perawatan</b></td>
                            <td style="width: 75%;">{{ $data->assigns->form_checklist->nama ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td style="width: 25%;"><b>Tanggal Submit</b></td>
                            <td  style="width: 75%;">{{ date('d-m-Y',strtotime($data->created_at)) }}</td>
                        </tr>

                        <tr>
                            <td style="width: 25%;"><b>Created By</b></td>
                            <td style="width: 75%;">{{ $data->personal->first_name }} {{ $data->personal->last_name }}</td>
                        </tr>

                        <tr>
                            <td style="width: 25%;"><b>Detail</b></td>
                            <td  style="width: 75%;"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table table-row-dashed table-row-gray-500 gy-7">
                                    <thead style="border-bottom: 0.5px solid grey;">
                                        <th>Parameter</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                        <th>Gambar</th>
                                    </thead>
                                    @foreach($data->detail as $row)
                                    <tr>
                                        <td style="width: 25%; vertical-align: middle;">{{ $row->nama }}</td>
                                        <td style="width: 25%; vertical-align: middle;">{{ $row->value }}</td>
                                        <td style="width: 25%; vertical-align: middle;">{{ $row->keterangan }}</td>
                                        <td style="width: 25%;">
                                            @if($row->foto != null)
                                                <img style="width: 100%; height:auto;" src="{{ route('api.file.viewer', ['path' => str_replace('/', '|', $row->foto)]) }}" />
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>

					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('extra-js')
	<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
@endsection