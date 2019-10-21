@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <br>
                <a href="{{url('/add')}}" class="btn btn-primary mb-2">Add Data</a>
                
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                @foreach ($files as $file)
                        <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$file[0]}}</td>
                        <td>{{$file[1]}}</td>
                        <td>{{$file[2]}}</td>
                        <td>{{$file[3]}}</td>
                        <td>{{$file[4]}}</td>
                        <td><img style="max-height: 100px; max-width:100px;" src="{{ asset('storage/files/' . $file[5]) }}" alt="{{$file[5]}}"></td>
                        <td>
                            <a href="{{url('edit/' . $file[0] . '/' . $file[1] . '/' . $file[2] . '/' . $file[3] . '/' . $file[4] . '/' . $file[5] . '/' . $file[6])}}" class="btn btn-warning">Edit</a>
                            <a href="{{url('delete/' . $file[5] . '/' . $file[6])}}" class="btn btn-danger">Hapus</a>
                        </td>
                        </tr>
                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
