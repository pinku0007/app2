@extends('admin.includes.masterpage-admin')

@section('content')
</style>
<div class="d-flex align-items-center mb-4">
	<a href="{!! url('brand') !!}" class="d-sm-inline-block btn btn-secondary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white"></i></a>
	<h1 class="h3 mx-2 mb-0 text-gray-800">
      Add Service
    </h1>
</div>
 

<div class="clearfix"></div>
	<div id="response" class="col-md-12">
		@if(Session::has('message'))
			<div class="alert alert-success alert-dismissable">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ Session::get('message') }}
			</div>
		@endif
		@if(Session::has('error'))
			<div class="alert alert-danger alert-dismissable">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ Session::get('error') }}
			</div>
		@endif
	</div>
<form method="POST" action="{{ url('service/store') }}" class="form-horizontal">
	{{csrf_field()}}
	<div class="row small-spacing">
		
		<div class="col-lg-6 col-xs-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold">VIN : </h6>
				</div>
				<div class="card-body">
				<input type="text" name="car_vin" class="form-control" placeholder="Enter VIN" required>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-xs-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold">Customer Name : </h6>
				</div>
				<div class="card-body">
				<input type="text" name="customer_name"  autocomplete="off" class="form-control" value="" placeholder="Customer Name" required>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-xs-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold">Mechanic Name : </h6>
				</div>
				<div class="card-body">
				<input type="text" name="mechanic_name"  autocomplete="off" class="form-control" value="" placeholder="Mechanic Name" required>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-xs-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold">Service Type : </h6>
				</div>
				<div class="card-body">
				<input type="text" name="service_type" class="form-control" placeholder="Service Type" required>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-xs-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold">Date of service : </h6>
				</div>
				<div class="card-body">
				<input type="date" name="date_of_service" class="form-control" placeholder="Date of service" required>
				</div>
			</div>
		</div>
	</div>
	<div class="row small-spacing">
		<div class="col-lg-6 col-xs-12">
			<div class="card shadow mb-4">
				<div class="card-body">
					<button name="addProduct_btn" type="submit" class="btn  form-control btn-success add-product_btn text-black">Save </button>
				</div>
			</div>
		</div>
	</div>
</form>
@stop
@section('footer')
<script>
	$('#brand').change(function (){
		console.log($(this).val());
		$.ajax({
				url:"{{route('get_models')}}",
				data:{value:$(this).val()},
				cache:false,
				success:function (response){
					$('#model').html(response);
				}
			})
	});
</script>
@stop
