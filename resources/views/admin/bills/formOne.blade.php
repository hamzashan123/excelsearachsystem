@extends('layouts.admin')
  
@section('content')
<div class="container">
<div class="row">
              
              <div class="col-md-12 mx-0">
                 <div class="card">
                    <div class="card-body">
                  <form id="msform" action="{{route('admin.bill.form.one.save')}}" method="post">
                      @csrf
                      
                          <div class="form-card">
                          <h3>Create New Bill</h3>

                          <div class="form-group">
                              <label for="title">Bill Title:</label>
                              <input type="text"  class="form-control" id="title" @if(isset($bill)) value="{{$bill->title}}" @endif placeholder="Enter Bill title" name="title" required>
                          </div>
                          <div class="form-group">
                              <label for="default_service">Default Service:</label>
                              <input type="text"   class="form-control" id="default_service" @if(isset($bill)) value="{{$bill->default_service}}" @endif  placeholder="Enter Service" name="default_service" required/>
                          </div>

                          <h3>Discount Types</h3>
                          @if(isset($discountTypes) && count($discountTypes) > 0 )
                          @foreach($discountTypes as $key => $discountType)
                          <div id="discount_types">
                              <div class="form-group" id="dis_type">
                                  <label for="type">Type:</label>
                                  <input type="text"  class="form-control" id="types" value="{{$discountType->type}}" placeholder="Enter type" name="types[]" required>
                              </div>
                              <div class="form-group">
                                  <label for="description">Discount:</label>
                                  <input type="number"   class="form-control" id="discount" value="{{$discountType->discount}}" placeholder="Enter discount Percentage" name="discount[]" required/>
                              </div>
                              
                            <div class="fullservice">
                                <input type="checkbox"   class="form-control " id="full_price" @if($discountType->full_price)  == true ) checked @endif name="full_price[]" />
                                <label for="description">Service on full price?</label>
                            </div>
                                
                        

                          </div>
                          @endforeach
                          @else
                          <div id="discount_types">
                              <div class="form-group" id="dis_type">
                                  <label for="type">Type:</label>
                                  <input type="text"  class="form-control" id="types"  placeholder="Enter type" name="types[]" required>
                              </div>
                              <div class="form-group">
                                  <label for="description">Discount:</label>
                                  <input type="number"   class="form-control" id="discount"  placeholder="Enter discount Percentage" name="discount[]" required/>
                              </div>
                              <div class="fullservice">
                                <input type="checkbox"   class="form-control " id="full_price" name="full_price[]" />
                                <label for="description">Service on full price?</label>
                              </div>
                          </div>
                          @endif
                          <div id="newRow"></div>
                          <div class="text-right">
                              <a  class="btn btn-success" style="color:white !important;" id="add_discount_types">Add</a>
                          </div>

                          </div>
                          @if(empty($bill))
                          <input type="submit" name="saveFormOne" class="next action-button" value="Save"/>
                          @endif
                          @if(isset($bill))
                          <!-- <input type="submit" name="updateFormOne" class="next action-button" value="Update"/> -->
                          <a href="{{route('admin.bill.form.two',[ 'bill_id' => $bill->id])}}" class="next action-button">Continue</a>
                          @endif

                      
                  </form>
                  </div>
                 </div>
              </div>
    </div>
</div>
<script>
     $(document).ready(function(){
        // Add discount rows
        $("#add_discount_types").click(function () {
            var html = '';
            html += '<div id="discount_types">';
            html += '<div class="form-group">';
            html += '<label for="type">Type: </label>';
            html += '<input type="text" name="types[]" class="form-control" placeholder="Enter Type">';
            html += '<label for="type">Discount: </label>';
            html += '<input type="text" name="discount[]" class="form-control" placeholder="Enter discount Percentage">';
            html += '<label for="type">Service on full price? </label>';
            html += '<input type="checkbox" class="form-control" id="full_price" name="full_price[]"/>';
            html += '<button id="removeRow" type="button" class="btn btn-danger" style="margin-top:10px;" >Remove</button>';
            html += '</div>';
            html += '</div>';
            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#discount_types').remove();
        });
    });
</script>
@endsection