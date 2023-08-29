@extends('agents.inc.master')

@section('title','Dashboard')

@section('content')

<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3"><strong>Assign Permissions to Roles</strong></h1>

		<div class="card">
			@if ($message = Session::get('success'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
				<div class="alert-message">
					<strong>{{ $message }}</strong>
				</div>
			</div>
			@endif

			@if (count($errors) > 0)
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
				<div class="alert-message">
					<strong>
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</strong>
				</div>
			</div>

			@endif
			
			<form class="row g-3" action="{{route('AssignPermissionsToRoles')}}" method="post" autocomplete="off">
				@csrf
				<div class="card-body">

					<div class="form-row">
						<div class="form-group">
							<label class="block">


								<label for="validationDefault04" class="form-label">Select Role</label>
								<select class="form-select" id="validationDefault04" name="role_name" required>
									<option value="">Select an option...</option>
									@foreach ($Roles as $role)
									<option>
										{{ $role->name }}
									</option>
									@endforeach
								</select>
							</label>
						</div>

					</div>
				</div>
				<div class="card-body">

					<div class="row" id="checkboxContainer"></div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save Permission</button>
				</div>
			</form>
		</div>
</main>
@endsection