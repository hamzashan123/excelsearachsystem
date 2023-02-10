@extends('layouts.admin')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                
  
                <div class="card-body">
                    
                    <h3>View My Bills</h3>
                    <a href="{{route('admin.bills.create')}}" class="btn btn-success pull-right mb-5">Create New Bill</a>
  
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bills as $bill)
                            <tr>
                                <th scope="row">{{$bill->id}}</th>
                                <td>{{$bill->title}}</td>
                                <td><a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection