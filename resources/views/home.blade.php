@extends('layouts.admin')

@section('content')
<h6 class="c-grey-900">

</h6>
<div class="py-5">
    <div class="container">
      <div class="row">
        
        <div class="col-md-6">
          <div class="card">
            <div class="card-block">
              <h4 class="card-title">Total Purchasing</h4>
              <h6 class="card-subtitle text-muted">{{$totalPurchases}}</h6>
              <a href="{{route('admin.users.index')}}" class="card-link">View List</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-block">
              <h4 class="card-title">Total Recieving</h4>
              <h6 class="card-subtitle text-muted">{{$totalReceiving}}</h6>
              <a href="#" class="card-link">View List</a>
            </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
<div class="mT-30"></div>
@endsection
@section('scripts')
@parent

@endsection
