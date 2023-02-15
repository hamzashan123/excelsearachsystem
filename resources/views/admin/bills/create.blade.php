﻿@extends('layouts.admin')

<link rel="stylesheept" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >

@section('content')
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
        
            <div class="card px-0 pt-30 pb-0 mt-3 mb-3">
                <div class="row">
              
                    <div class="col-md-12 mx-0">
                    
                        <form id="msform" action="{{route('admin.bills.store')}}" method="post">
                            @csrf
                            <!-- progressbar -->
                           
                            <!-- fieldsets -->
                            <fieldset id="fieldsetone">
                                <div class="form-card">
                                <h3>Create New Bill</h3>

                                <div class="form-group">
                                    <label for="title">Bill Title:</label>
                                    <input type="text"  class="form-control" id="title" placeholder="Enter Bill title" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="default_service">Default Service:</label>
                                    <input type="number"   class="form-control" id="default_service" placeholder="Enter Service" name="default_service"/>
                                </div>

                                <h3>Discount Types</h3>
                                <div id="discount_types">
                                    <div class="form-group" id="dis_type">
                                        <label for="type">Type:</label>
                                        <input type="text"  class="form-control" id="types"  placeholder="Enter type" name="types">
                                    </div>
                                    <div class="form-group" id="discount">
                                        <label for="description">Discount:</label>
                                        <input type="number"   class="form-control" id="discount" placeholder="Enter discount" name="discount"/>
                                    </div>
                                </div>
                                <div id="newRow"></div>
                                <div class="text-right">
                                    <a  class="btn btn-success" style="color:white !important;" id="add_discount_types">Add</a>
                                </div>

                                </div>
                                <input type="button" name="next" class="next action-button" value="Continue"/>
                            </fieldset>

                            <fieldset id="fieldsettwo">
                                <div class="form-card">
                                <h3>Host</h3>

                                    <div class="form-group">
                                        <label for="host_name">Name</label>
                                        <input type="text"  class="form-control" id="host_name" placeholder="Enter Host Name" name="host_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="deposit">Deposit:</label>
                                        <input type="number" class="form-control" id="deposit" placeholder="Enter Deposit" name="deposit"/>
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
                                        
                                            <tr >
                                                <td> <input type="text"   class="form-control" id="guest_name" placeholder="Enter Name" name="guest_name"/> </td>
                                                <td> <input type="number"   class="form-control" id="guest_deposit" placeholder="Enter Deposit" name="guest_deposit"/> </td>
                                                <td> <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                            </tr>
                                           
                                           
                                       
                                        </tbody>
                                    </table>
                                                    <div class="text-right">
                                        <a  class="btn btn-success" style="color:white !important;" id="add_guest">Add Guest</a>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <input type="button" name="next" class="next action-button" value="Continue"/>
                                
                            </fieldset>
                            
                            <fieldset id="fieldsetthree">
                             <div class="form-card">
                                    <center> <a href="#">Update Discount/name </a> | <a href="#">Update Guests</a> </center>
                                      <h3>Test</h3>

                                        <div class="itemsdiv">
                                        <div class="itemslisting">
                                            
                                        </div>
                                        <div class="hostguestlisting">
                                            <div class="form-group hosts">

                                                <p>Adrian</p>
                                                <p>£0.00</p>
                                                
                                            </div>
                                            <div class="form-group guests">

                                                <p>Tam</p>
                                                <p>£-20.00</p>

                                            </div>
                                        </div>
                                       

                                    <input type="button" name="btn_addItemModal"  id="btn_addItemModal" class="form-control btn btn-success" value="Add"/> 
                                </div>
                             </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <input type="button" name="next" class="next action-button" value="Continue"/>
                                
                            </fieldset>

                            <fieldset id="fieldsetfour">
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Are you sure you want to submit ?</h2>
                                    
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <input type="submit" name="next" class="action-button" value="Submit"/>  
                            </fieldset>

                            <fieldset id="fieldsetfive">
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Success !</h2>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>You Have Successfully Signed Up</h5>
                                        </div>
                                    </div>
                                </div>
                                 
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
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


                    <form method="post" action="">
                         
                        @csrf
                        
                        
                        <div class="row">

                            <div class="col-md-6">
                                <input type="text" value="" id="item_description" name="item_description" class="form-control" required placeholder="Item Description">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="item_price" name="item_price" class="form-control" required placeholder="£0.00">
                            </div>
                         
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                   
                                    <select name="bill_discount_types" id="bill_discount_types" class="form-control">
                                        <option value="">Select</option>
                                    </select>
                            </div>

                            <div class="col-md-6">
                               
                                <input type="number" id="block" name="block" min="1" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 10px !important;padding-left:0 !important;">
                            <input type="button" id="btn_saveItem" class="btn btn-success" value="Save">
                            <input type="button" id="btn_cancel" class="btn btn-secondary" value="Cancel">
                        </div>
                    </form>

                </div>

            </div>


        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
    
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var bill_id;
    var selectedDiscountType;
    var discountValue;
    
    $(".next").click(function(){
        
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        
        saveBill(current_fs.attr('id'));
        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    });
    
    function saveBill(current_fs){
        //console.log(current_fs);
        if(current_fs == 'fieldsetone'){
            var title = $('#title').val();
            var default_service = $('#default_service').val();
            var types = [];
            var discounts = [];

            $("input[name='types']").each(function() {
                types.push($(this).val());
            });
            $("input[name='discount']").each(function() {
                discounts.push($(this).val());
            });

            $.post('{{route("admin.bills.store")}}',
            {
                    "_token": "{{ csrf_token() }}",
                    fieldset: 'one',
                    title: title,
                    default_service: default_service,
                    type: types,
                    discount: discounts,

            },
            function(data, status){
                if(data.success == true){
                    bill_id = data.bill_id;
                    // set the item in localStorage
                    localStorage.removeItem("bill_id");
                    localStorage.setItem('bill_id', bill_id);
                    console.log(data.bill_id);
                }else{
                    alert('something went wrong!');
                }
                
                
                    //alert("Data: " + data + "\nStatus: " + status);
            });
        }

        if(current_fs == 'fieldsettwo'){
            var host_name = $('#host_name').val();
            var deposit = $('#deposit').val();
            var guests = [];
            var guest_deposits = [];

            $("input[name='guest_name']").each(function() {
                guests.push($(this).val());
            });
            $("input[name='guest_deposit']").each(function() {
                guest_deposits.push($(this).val());
            });
            console.log('BillId', bill_id);
            console.log('guests', guests);
            console.log('guest_deposits', guest_deposits);
            $.post('{{route("admin.bills.store")}}',
                {
                    "_token": "{{ csrf_token() }}",
                    fieldset: 'two',
                    bill_id : bill_id,
                    host_name: host_name,
                    deposit: deposit,
                    guests: guests,
                    guest_deposits: guest_deposits,

                },
            function(data, status){
                console.log(data);
                    //alert("Data: " + data + "\nStatus: " + status);
            });
        }
        
    }

    $(".previous").click(function(){
        
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            
            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            
            //show the previous fieldset
            previous_fs.show();
        
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;
        
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({'opacity': opacity});
                }, 
                duration: 600
            });
        });
    
        $('.radio-group .radio').click(function(){
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
        });
        
        $(".submit").click(function(){
            return false;
        })
        
    });

    // Add discount rows
    $("#add_discount_types").click(function () {
        var html = '';
        html += '<div id="discount_types">';
        html += '<div class="form-group">';
        html += '<label for="type">Type: </label>';
        html += '<input type="text" name="types" class="form-control" placeholder="Enter Type">';
        html += '<label for="type">Discount: </label>';
        html += '<input type="text" name="discount" class="form-control" placeholder="Enter Discount">';
        html += '<button id="removeRow" type="button" class="btn btn-danger" style="margin-top:10px;" >Remove</button>';
        html += '</div>';
        html += '</div>';
        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#discount_types').remove();
    });

    // add guests
    $("#add_guest").click(function () {
        var html = '';
        html += '<tr>';
        html += '<td>';
        html += '<input type="text" class="form-control" id="guest_name" placeholder="Enter Name" name="guest_name"/>';
        html += '</td>';
        html += '<td>';
        html += '<input type="number"   class="form-control" id="guest_deposit" placeholder="Enter Deposit" name="guest_deposit"/>';
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


    //select and get discount by changing item
    $('#bill_discount_types').change( function () {
        selectedDiscountType = $(this).val();
        bill_id = localStorage.getItem('bill_id');
        console.log('billid in discount',bill_id);
        
        $.post('{{route("admin.bills.discountTypes")}}',
            {
                    "_token": "{{ csrf_token() }}",
                    bill_id : bill_id,
                    type : selectedDiscountType
            },
        function(data, status){
                console.log(data.data);
                discountValue = data.data.discount;
                    //alert("Data: " + data + "\nStatus: " + status);
        });
    });

    $("#btn_addItemModal").click(function () {

        bill_id = localStorage.getItem('bill_id');
        $.post('{{route("admin.bills.discountTypes")}}',
            {
                    "_token": "{{ csrf_token() }}",
                    bill_id : bill_id,
            },
        function(data, status){
                console.log(data.data);
                $('#bill_discount_types').find('option').remove();
                data.data.forEach(key => {
                    
                    var html = '';
                        html += '<option value='+key.type+'>'+key.type+'</option>';      
                    $('#bill_discount_types').append(html);
                 // console.log(key); // 👉️ name, country
                });
                
                
                    //alert("Data: " + data + "\nStatus: " + status);
        });
        $('#addItemModal').modal('show'); 
    });
    // add item in list
    $("#btn_saveItem").click(function () {
        //alert("asdasd");
        var item_description = $('#item_description').val();
        var item_price = $('#item_price').val();
        var item_discount_type = $('#item_discount_type').val();
        var item_discount_quantity = $('#item_discount_quantity').val();
        discountValue = discountValue;
        var percentage = Math.round(((item_price / discountValue) * 100)) +"%";
        console.log(percentage);
        

        var html = '';
        html += '<div id="itemdetails">';
        html += '<h4>'+item_description+'</h4>';
        html += '<p>Click to update</p>';
        html += '</div>';

        html += '<div id="pricedetails">';
        html += '<p><del>£'+item_price+'</del></p>';
        html += '<p> '+percentage +' Off</p>';
        html += '<p>£'+item_price+'</p>';
        html += '</div>';
            
        $('.itemslisting').append(html);
        //$("#addItemModal").modal('hide');
        $('#addItemModal').modal('toggle');
        document.getElementById('close-modal').click();
    });


</script>
@endsection