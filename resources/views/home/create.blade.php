@extends('layouts.app')

@section('body')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <div class="panel panel-default">
                <div class="panel-heading">Add list</div>
                <div class="panel-body">
                	@if (count($errors) > 0)
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('home.store') }}">
                    	{{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-2 control-label">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Jenis Kelamin</label>
                            <div class="col-md-10">
								<select class="form-control" name="gender">
									<option value="L">Laki-Laki</option>
									<option value="P">Perempuan</option>
								</select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Alamat</label>
                            <div class="col-md-10">
								<textarea class="form-control" name="address">{{ old('address') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nomer Kursi</label>
                            <div class="col-md-10">
								<input type="number" class="form-control" name="seat_number" value="{{ old('seat_number') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Qr Code</label>
                            <div class="col-md-10">
								<input type="number" class="form-control" name="qr_code" value="{{ rand('1000000', '9999999') }}" readonly="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection