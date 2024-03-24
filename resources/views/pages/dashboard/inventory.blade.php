@extends('layouts.app')
@section('pagetitle', 'Dashboard')

@section('extra-css')
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<style type="text/css">
	.charts{
	 height: 350px;
	}
</style>
@endsection
@section('content')
	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

		<!--begin::Post-->
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<!--begin::Container-->
			<div id="kt_content_container" class="container-xxl">

				<!--begin::Tables Widget 12-->
				<div class="card mb-5 mb-xl-8">
					<!--begin::Body-->
					<div class="row">
						<div class="col-lg-4">
							<div class="card-body py-3">
						    	<div id="ownership-container" class="charts">Fusion Charts will render here</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="card-body py-3">
								<div id="age-container" class="charts">Fusion Charts will render here</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="card-body py-3">
								<div id="condition-container" class="charts">Fusion Charts will render here
							</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="card-body py-3">
								<h3>Damage By Location</h3>
								<div class="form-group">
									<label class="fs-6 fw-bold mt-2 mb-3">Date Range</label>
									{!! Form::text('daterange', null, ['class'=>'form-control form-control-solid', 'id'=>'kt_daterangepicker_4']) !!}
								</div>
								<div id="damage-loc" class="chart" style="height: 400px;">Fusion Charts will render here</div>
							</div>
						</div>
					</div>
					<!--begin::Body-->
				</div>
				<!--end::Tables Widget 12-->

			</div>
			<!--end::Container-->
		</div>
		<!--end::Post-->
	</div>
	<!--end::Content-->
@endsection

@section('extra-js')
	<script type="text/javascript" src="{{ asset('assets/fusion/js/fusioncharts.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/fusion/js/themes/fusioncharts.theme.fusion.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/fusion/js/jquery-fusioncharts.min.js') }}"></script>
    <script>
    $(document).ready(function () {
    	$.get("{{ route('dashboardapi.ownership') }}", function(data, status) {
    		if (status == "success") {
    			$("#ownership-container").insertFusionCharts(data);
    		}
    	});

    	$.get("{{ route('dashboardapi.age') }}", function(data, status) {
    		if (status == "success") {
    			$("#age-container").insertFusionCharts(data);
    		}
    	});

    	$.get("{{ route('dashboardapi.condition') }}", function(data, status) {
    		if (status == "success") {
    			$("#condition-container").insertFusionCharts(data);
    		}
    	});

    	$("#kt_daterangepicker_4").change(function() {
    		getDamage();
    	});

    	function getDamage()
    	{
    		var daterange = $("#kt_daterangepicker_4").val();

    		$.ajax({
    			type:"post",
    			url: "{{ route('dashboardapi.damage-loc') }}",
    			data: {daterange : daterange, _token: "{{ csrf_token() }}"},
    			success: function(res){
    				if (res.result == 'success') {
    					$("#damage-loc").insertFusionCharts(res.data);
    				}
    			}
    		});
    	}

    	getDamage();

    	var start = moment().subtract(29, "days");
    	var end = moment();

    	function cb(start, end) {
    	    $("#kt_daterangepicker_4").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
    	}

    	$("#kt_daterangepicker_4").daterangepicker({
    	    startDate: start,
    	    endDate: end,
    	    ranges: {
    	    "Today": [moment(), moment()],
    	    // "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
    	    // "Last 7 Days": [moment().subtract(6, "days"), moment()],
    	    "This Week": [moment().startOf("week"), moment().endOf("week")],
    	    "Last 2 Weeks": [moment().subtract(2, "week"), moment()],
    	    "Last 30 Days": [moment().subtract(29, "days"), moment()],
    	    // "This Month": [moment().startOf("month"), moment().endOf("month")],
    	    "Last 6 Months": [moment().subtract(6, "month"), moment()]
    	    }
    	}, cb);

    	cb(start, end);
    });
    </script>
@endsection
