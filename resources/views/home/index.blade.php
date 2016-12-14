@extends('layouts.app')

@section('body')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar</div>

                <div class="panel-body">
                    <div class="col-md-12">
                        <a href="{{ route('home.create') }}" class="btn btn-primary">Add Daftar</a>
                    </div>
                    <br>
                    <br>
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="col-md-12">
                        <table class="table table-responsive">
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Nomer tempat duduk</th>
                                <th>QR Code</th>
                                <th></th>
                            </tr>
                            	@foreach($guests as $guest)
                                <tr>
                                    <td>{{ $guest->id }}</td>
                                    <td>{{ $guest->name }}</td>
                                    <td>{{ $guest->gender }}</td>
                                    <td>{{ $guest->address }}</td>
                                    <td>{{ $guest->seat_number }}</td>
                                    <td><a href="{{ route('home.show', $guest->id) }}">QR Code</a></td>
                                    <td>
                                        <a href="{{ route('home.edit', $guest->id) }}" class="btn btn-warning">Edit</a>
                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $guest->id }}">Delete</a>

                                        <div class="modal fade" id="delete{{ $guest->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Delete List</h4>
                                              </div>
                                              <div class="modal-body">
                                                Are You Sure?
                                              </div>
                                              <div class="modal-footer">
                                                <form action="{{ route('home.destroy', $guest->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection