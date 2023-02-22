@extends('layouts.admin')
  
@section('content')

@php
    if(isset($_GET['bill_id'])){
        $bill_id = $_GET['bill_id'];
    }
@endphp
<div class="container">
<div class="row">
              
              <div class="col-md-12 mx-0">
              <div class="card">
                    <div class="card-body">
                  <form id="msform" action="{{route('admin.bill.form.two.save')}}" method="post">
                      @csrf
                                <h3>Host</h3>
                                    <input type="hidden" name="bill_id" @if(!empty($bill_id)) value="{{$bill_id}}" @endif>
                                    <div class="form-group">
                                        <label for="host_name">Name</label>
                                        <input type="text"  class="form-control" id="host_name" placeholder="Enter Host Name" name="host_name" @if(isset($host->name)) value="{{$host->name}}"  @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="deposit">Deposit:</label>
                                        <input type="text" class="form-control" id="deposit" @if(isset($host->deposit)) value="{{$host->deposit}}"  @endif placeholder="Enter Deposit" name="deposit"/>
                                    </div>

                                    <h3>Guests</h3>

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Deposit</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody id="guests_row">
                                        @if(isset($host_guests) && count($host_guests) > 0 )
                                        @foreach($host_guests as $key => $guest)
                                           @if($guest->type == 'guest') 
                                            <tr >
                                                <td> <input type="text"   class="form-control" id="guest_name" value="{{$guest->name}}" placeholder="Enter Name" name="guest_name[]"/> </td>
                                                <td> <input type="text"   class="form-control" id="guest_deposit" value="{{$guest->deposit}}" placeholder="Enter Deposit" name="guest_deposit[]"/> </td>
                                                <td> <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                            </tr>
                                           @endif 
                                        @endforeach
                                        @else
                                            <tr >
                                                <td> <input type="text"   class="form-control" id="guest_name" value="" placeholder="Enter Name" name="guest_name[]"/> </td>
                                                <td> <input type="text"   class="form-control" id="guest_deposit" value="" placeholder="Enter Deposit" name="guest_deposit[]"/> </td>
                                                <td> <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                            </tr>
                                        @endif   
                                           
                                       
                                        </tbody>
                                    </table>
                                                    <div class="text-right">
                                        <a  class="btn btn-success" style="color:white !important;" id="add_guest">Add Guest</a>
                                    </div>
                                </div>

                                <!-- <a href="{{route('admin.bill.form.one',[ 'bill_id' => $bill_id])}}" class="btn btn-secondary">Back</a> -->
                                @if(empty($host->name))
                                <input type="submit" name="saveFormTwo" class="next action-button btn btn-success" value="Continue"/>
                                @endif


                                @if(isset($host))
                                <!-- <input type="submit" name="updateFormTwo" class="next action-button btn btn-success" value="Update"/> -->
                                <a href="{{route('admin.bill.form.three',[ 'bill_id' => $bill_id])}}" class="next action-button btn btn-success">Continue</a>
                                @endif
                               
                                
                               
                                
                                

                                
                                   
                            </form>
              </div>
            </div>
              </div>
    </div>
</div>
<script>
     $(document).ready(function(){
        // // add guests
        $("#add_guest").click(function () {
            var html = '';
            html += '<tr>';
            html += '<td>';
            html += '<input type="text" class="form-control" id="guest_name" placeholder="Enter Name" name="guest_name[]"/>';
            html += '</td>';
            html += '<td>';
            html += '<input type="number"   class="form-control" id="guest_deposit" placeholder="Enter Deposit" name="guest_deposit[]"/>';
            html += '</td>';
            html += '<td>';
            html += '<a href="#" id="removeguest" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
            html += '</td>';
            html += '</tr>';
            $('#guests_row').append(html);
        });

        //remove guest rows
        $(document).on('click', '#removeguest', function () {
            $(this).closest('tr').remove();
        });
    });
</script>
@endsection