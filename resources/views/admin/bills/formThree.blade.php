@extends('layouts.admin')
  
@php
    if(isset($_GET['bill_id'])){
        $bill_id = $_GET['bill_id'];
    }
@endphp

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-12 mx-0">
              
              <form id="msform" action="{{route('admin.bill.form.one.save')}}" method="post">
                  @csrf
                <div class="form-card">
                                    <!-- <center> <a href="#">Update Discount/name </a> | <a href="#">Update Guests</a> </center> -->
                                     <center> <h3 id="bill_name"> {{ $bill->title }}</h3> </center>

                                        <div class="itemsdiv">
                                            <!-- Dynamic items list here -->
                                
                                        <div class="itemslisting">
                                            <div id="itemdetails">
                                                   
                                                    @if(count($items) > 0)
                                                        @foreach($items as $item)
                                                        <!-- calculations of price and savings -->
                                                        @php
                                                            
                                                            $eachItemPrice = $item->item_price * $item->quantity;
                                                            $eachItemPercentage = ( $eachItemPrice / 100 ) * $item->item_saving;
                                                            $eachItemDiscountPrice = $eachItemPrice - $eachItemPercentage;
                                                            $serviceCharges = ( $eachItemDiscountPrice / 100 ) * $item->item_saving;

                                                        @endphp

                                                        <h4>{{$item->item_description}}</h4>
                                                        <div id="itemActionsBtns">

                                                            
                                                            @if($item->quantity > $item->itemPurchases->sum('assigned_quantity')) 
                                                            <a href="#" disabled  class="assignItem" data-assignedQuantity="{{$item->itemPurchases->sum('assigned_quantity')}}" data-itemid="{{$item->id}}" data-item_description="{{$item->item_description}}"   data-item_price="{{$item->item_price}}"  data-quantity="{{$item->quantity}}" data-category="{{$item->category}}"><i class="fas fa-tasks"></i></a>
                                                            @else
                                                            <a href="#" data-toggle="tooltip" data-placement="top" title="This item is already assigned"  data-itemid="{{$item->id}}" data-item_description="{{$item->item_description}}"   data-item_price="{{$item->item_price}}"  data-quantity="{{$item->quantity}}" data-category="{{$item->category}}"><i class="fas fa-tasks"></i></a>
                                                            @endif
                                                            
                                                            <a href="#" class="editItem" data-itemid="{{$item->id}}" data-item_description="{{$item->item_description}}"   data-item_price="{{$item->item_price}}"  data-quantity="{{$item->quantity}}" data-category="{{$item->category}}"><i class="fas fa-edit"></i></a>
                                                            <a href="{{route('admin.bills.item.delete',['id' => $item->id])}}" class="assignItem" data-itemid="" data-item_description=""   data-item_price=""  data-quantity="" data-category=""><i class="fas fa-trash"></i></a>
                                                        </div>

                                                        <p><del>£{{$eachItemPrice}}</del></p>
                                                        <p> {{$item->item_saving}} % Off</p>
                                                        <p>£{{$eachItemDiscountPrice}}</p>
                                                        @endforeach
                                                    @endif
                                                  
                                            </div>
                                            
                                            <!-- <div id="pricedetails">
                                            
                                               
                                              
                                            </div> -->
                                            
                                            
                                        </div>

                                        <!-- Dynamic host and guest list here -->
                                        <div class="hostguestlisting">
                                            
                                            @if(count($host_guests) > 0 )
                                                @foreach($host_guests as $host_guest)
                                                @if($host_guest->type == 'host')
                                                <div class="form-group hosts personData" data-hostguest_id={{$host_guest->id}} data-selected_guesthost_name={{ $host_guest->name }}>
                                                    <p>{{ $host_guest->name }}</p>
                                                    <p>£{{ -$host_guest->deposit}}</p>
                                                    </div>
                                                @else
                                                <div class="form-group guests personData" data-hostguest_id={{$host_guest->id}} data-selected_guesthost_name={{ $host_guest->name }}>
                                                    <p>{{$host_guest->name}}</p>
                                                    <p>£{{-$host_guest->deposit}}</p>
                                                </div>
                                                @endif
                                                @endforeach
                                            @endif
                                        </div>
                                       

                                       
                                        </div>
                                        <input type="button" name="btn_addItemModal"  id="btn_addItemModal" class="form-control btn btn-success" value="Add"/>

                                        <div class="totalCalculation">
                                            @if(count($items) > 0)
                                                @php
                                                    $itemsCategoryTotalPrice = 0;
                                                    $itemsCategoryTotalPercentage = 0;
                                                    $itemsCategoryDiscountedPrice = 0;
                                                @endphp
                                                @foreach($items as $item)
                                                    @php
                                                                
                                                                $eachItemPrice = $item->item_price * $item->quantity;
                                                                $eachItemPercentage = ( $eachItemPrice / 100 ) * $item->item_saving;
                                                                 
                                                                $eachItemDiscountPrice = $eachItemPrice - $eachItemPercentage;
                                                                $savingPrice = $eachItemPrice - $eachItemDiscountPrice;
                                                                if($item->full_price == true){
                                                                    
                                                                    $serviceCharges = ( $eachItemPrice / 100 ) * $bill->default_service;
                                                                }else{
                                                                    
                                                                    $serviceCharges = ( $eachItemDiscountPrice / 100 ) * $bill->default_service;
                                                                }
                                                                

                                                                $itemsCategoryTotalPrice = $itemsCategoryTotalPrice + $eachItemPrice;
                                                                $itemsCategoryTotalPercentage = $itemsCategoryTotalPercentage + $eachItemPercentage;
                                                                $itemsCategoryDiscountedPrice = $itemsCategoryDiscountedPrice + $eachItemDiscountPrice + $serviceCharges;
                                                    @endphp
                                                    <span> {{$item->category}} ({{$item->item_description}}) Total:<span> <del>£{{$eachItemPrice}} </del> £{{$eachItemDiscountPrice}}</span></span> <br>
                                                    <span> Saving :   <span>£{{$savingPrice}}</span></span><br>
                                                    <span> Service :   <span> £{{$serviceCharges}}</span></span><br>
                                                   
                                                @endforeach
                                                <strong> <span> Grand Total:  <span> £{{$itemsCategoryDiscountedPrice}}</span> </span></strong>
                                            @endif    
                                        </div>
                                        
                             </div>  
                             <br><br>
                             <!-- <a href="{{route('admin.bill.form.two',[ 'bill_id' => $bill_id])}}" class="btn btn-success">Back</a> -->
              </form>
    </div>
    </div>
</div>


<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding-left: 47px;">
            <div class="modal-header"> 
                <button type="button" class="close" id="close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <div class="row">


                    <form method="post" action="{{route('admin.bills.item.store')}}">
                         
                        @csrf
                        
                        
                        <div class="row">
                            <input type="hidden" name="bill_id" value="{{$bill_id}}" >
                            <input type="hidden" name="updateItem" id="updateItem" value="false" >
                            <div class="col-md-6">
                                <input type="text" value="" id="item_description" name="item_description" class="form-control" required placeholder="Item Description">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="item_price" name="item_price" class="form-control" required placeholder="£0.00">
                            </div>
                         
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <select name="bill_discount_types" id="bill_discount_types" class="form-control" required>
                                        <option value="">Select</option>
                                    </select>
                            </div>

                            <div class="col-md-6">
                               
                                <input type="number" id="item_discount_quantity" name="item_discount_quantity" min="1" required placeholder="Enter Quantity" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 10px !important;padding-left:0 !important;">
                            <input type="submit" id="btn_saveItem" class="btn btn-success" value="Save">
                        </div>
                    </form>

                </div>

            </div>


        </div>
    </div>
</div>

<div class="modal fade" id="assignItemModal" tabindex="-1" role="dialog" aria-labelledby="assignItemModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding-left: 47px;">
            <div class="modal-header"> 
                <button type="button" class="close" id="close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <div class="row">


                    <form method="post" action="{{route('admin.bills.item.assign')}}">
                         
                        @csrf
                    
                        <input type="hidden" name="bill_id" value="{{$bill_id}}" >
                        <input type="hidden" name="assigned_item_id" id="assigned_item_id" value="" >
                        <div class="row">
                            <h4> Item name: <span id="assignItemTitle"> ( Steak ) </span></h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <select name="host_guest_id" id="host_guest_id" class="form-control" required>
                                        
                                    </select>
                            </div>

                            <div class="col-md-6">
                                    <select name="assigned_quantity" id="assigned_quantity" class="form-control" required>
                                       
                                    </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 10px !important;padding-left:0 !important;">
                            <input type="submit" id="btn_saveItem" class="btn btn-success" value="Assign">
                        </div>
                    </form>

                </div>

            </div>


        </div>
    </div>
</div>

<div class="modal fade" id="display_host_guest_data" tabindex="-1" role="dialog" aria-labelledby="display_host_guest_data" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding-left: 47px;">
            <div class="modal-header"> 
            <h4> <span id="selected_guesthost_name"></span></h4>
                <button type="button" class="close" id="close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <div class="row">


                    <form method="post" action="{{route('admin.bills.item.assign')}}">
                         
                        @csrf
                    
                        <input type="hidden" name="bill_id" value="{{$bill_id}}" >
                        <div class="row">
                        
                        </div>
                        <div class="row personItemdata">
                           
                            <div class="col-md-6 items_name">
                              <h4>Steak</h4>
                            </div>
                            <div class="col-md-6 items_pricing">
                               <p><del>£5.0</del></p>
                               <p> 10 % Off</p>
                               <p>£2.50</p>
                            </div>
                            
                        </div>

                    </form>

                </div>

            </div>


        </div>
    </div>
</div>


<script>
        $("#btn_addItemModal").click(function () {

            
            bill_id = '<?php echo $bill_id;?>'
            $.post('{{route("admin.bills.discountTypes")}}',
            {
                        "_token": "{{ csrf_token() }}",
                        bill_id : bill_id,
            },
            function(data, status){
                    console.log(data.data);
                    $('#bill_discount_types').find('option').remove();
                    var html = '';
                    html += '<option value="" selected disabled>Select</option>';
                    $('#bill_discount_types').append(html);

                    data.data.forEach(key => {
                        var html = '';
                            html += '<option value='+key.type+'>'+key.type+'</option>';      
                        $('#bill_discount_types').append(html);
                    });
            });
            
            $('#addItemModal').modal('show');
            $('#updateItem').val(false);
            $('#btn_saveItem').show();
            $('#updateItemModalData').hide();
        });

        $(".editItem").click(function () {

            var item_id = $(this).attr('data-itemid');
            var updateITemDescription = $(this).attr('data-item_description');
            var updateItemPrice = $(this).attr('data-item_price');
            var updateITemQuantity = $(this).attr('data-quantity');
            var updateITemCategory = $(this).attr('data-category');

            $('#item_description').val(updateITemDescription);
            $('#item_price').val(updateItemPrice);
            $('#item_discount_quantity').val(updateITemQuantity);

            bill_id = '<?php echo $bill_id;?>'
            $.post('{{route("admin.bills.discountTypes")}}',
            {
                        "_token": "{{ csrf_token() }}",
                        bill_id : bill_id,
            },
            function(data, status){
                    console.log(data.data);
                    $('#bill_discount_types').find('option').remove();
                    var html = '';
                    html += '<option value="" selected disabled>Select</option>';
                    $('#bill_discount_types').append(html);

                    data.data.forEach(key => {
                        var html = '';
                            html += '<option value='+key.type+'>'+key.type+'</option>';      
                        $('#bill_discount_types').append(html);
                    });
            });

            $('#addItemModal').modal('show');
            $('#btn_saveItem').hide();
            $('#item_id').remove();
            $('#updateItem').after("<input type='hidden' name='item_id' id='item_id' value="+item_id+">");
            $('#updateItemModalData').remove();
            $('#btn_saveItem').after("<input type='submit' name='updateItemModalData' id='updateItemModalData' value='update' class='btn btn-success'>");
            $('#updateItem').val(true);
        });

        $(".assignItem").click(function () {

            var item_id = $(this).attr('data-itemid');

            $('#assigned_item_id').val(item_id);

            var assignItemTitle = $(this).attr('data-item_description');
            var assignItemPrice = $(this).attr('data-item_price');
            var itemQuantity = $(this).attr('data-quantity');
            var assignITemCategory = $(this).attr('data-category');

            var assignedQuantity = $(this).attr('data-assignedQuantity');
            
            $('#assignItemTitle').text("(" + assignItemTitle + ")");
            //$('#item_price').val(updateItemPrice);
            console.log(itemQuantity);
            console.log(assignedQuantity);
            var limit = itemQuantity - assignedQuantity;
            var selectedQuantity = 0;
            $('#assigned_quantity').find('option').remove();
            for(i = 0; i < limit; i++){
                selectedQuantity++;
                var html = '';
                html += '<option value='+selectedQuantity+'>'+selectedQuantity+'</option>';      
                $('#assigned_quantity').append(html);
            }
            
            
            bill_id = '<?php echo $bill_id;?>'
            $.post('{{route("admin.bills.hostguest")}}',
            {
                        "_token": "{{ csrf_token() }}",
                        bill_id : bill_id,
            },
            function(data, status){
            
                    $('#host_guest_id').find('option').remove();
                    var html = '';
                    html += '<option value="" selected disabled>Select</option>';
                    $('#host_guest_id').append(html);

                    data.host_guests.forEach(key => {
                        var html = '';
                            html += '<option value='+key.id+'>'+key.name+'</option>';      
                        $('#host_guest_id').append(html);
                    });
                   
                   
            });
            
            $('#assignItemModal').modal('show');
        });

        $(".personData").click(function () {
            var grandTotal = 0;
            console.log($(this).attr('data-hostguest_id'));
            var assignGuestHostName = $(this).attr('data-selected_guesthost_name');
            $('#selected_guesthost_name').text("(" + assignGuestHostName + ")");
            $('.personItemdata').empty();
            bill_id = '<?php echo $bill_id;?>'
            $.post('{{route("admin.bills.gethostguesitems")}}',
            {
                    "_token": "{{ csrf_token() }}",
                    bill_id : bill_id,
                    host_guest_id : $(this).attr('data-hostguest_id')
            },
            
            function(data, status){
                    console.log(data.data);

                    data.data.forEach(key => {

                         var eachItemPrice = key.get_items.item_price ;
                         var QuantityPrice = eachItemPrice * key.assigned_quantity;
                         //var savingPrice = eachItemPrice * key.assigned_quantity;
                         var eachItemPercentage = ( QuantityPrice / 100 ) * key.get_items.item_saving;
                         var eachItemDiscountPrice = QuantityPrice - eachItemPercentage;
                         if(key.get_items.full_price == true){
                                                                    
                            var serviceCharges = ( QuantityPrice / 100 ) * 12.5;
                        }else{
                                                                    
                            var serviceCharges = ( eachItemDiscountPrice / 100 ) * 12.5;
                        }
                         var html = '';
                            html += '<div class="col-md-6 items_name">'; 
                            html += '<h4>'+key.get_items.item_description+'</h4>'; 
                            html += '</div>';
                            html += '<div class="col-md-6 items_pricing">'; 
                            html += '<p>Each Item Price:  £'+eachItemPrice+'</p>'; 
                            html += '<p>Quantity: '+key.assigned_quantity+' </p>'; 
                            html += '<p>Total: <span> £'+QuantityPrice+' </span></p>'; 
                            html += '<p>Saving: £'+eachItemPercentage+'</p>'; 
                            html += ' <p>Service Charges: £'+serviceCharges+'</p>';
                            html += ' <p>Total After Discount: £'+eachItemDiscountPrice+'</p>';
                            
                            html += '</div>';
                            grandTotal = grandTotal +   eachItemDiscountPrice + serviceCharges;       
                        $('.personItemdata').append(html);

                    });
                    
                    var html = '';
                        html += '<div class="col-md-6 items_name">'; 
                        html += ' <p><strong> Grand Total: £'+ grandTotal +'</strong> </p>';
                        html += '</div>';

                    $('.personItemdata').append(html);
                   
            });
            
            $('#display_host_guest_data').modal('show');
        });
        

</script>
@endsection