@extends('layouts.admin')

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
                            <fieldset>
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
                                        <input type="text"  class="form-control" id="type"  placeholder="Enter type" name="type[]">
                                    </div>
                                    <div class="form-group" id="discount">
                                        <label for="description">Discount:</label>
                                        <input type="number"   class="form-control" id="discount" placeholder="Enter discount" name="discount[]"/>
                                    </div>
                                </div>
                                <div id="newRow"></div>
                                <div class="text-right">
                                    <a  class="btn btn-success" style="color:white !important;" id="add_discount_types">Add</a>
                                </div>

                                </div>
                                <input type="button" name="next" class="next action-button" value="Continue"/>
                            </fieldset>
                            <fieldset>
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
                                                <td> <input type="text"   class="form-control" id="guest_name" placeholder="Enter Name" name="guest_name[]"/> </td>
                                                <td> <input type="number"   class="form-control" id="deposit" placeholder="Enter Deposit" name="deposit[]"/> </td>
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
                            
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Are you sure you want to submit ?</h2>
                                    
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <input type="submit" name="next" class="action-button" value="Submit"/>  
                            </fieldset>
                            <fieldset>
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


<script>
    $(document).ready(function(){
    
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    
    $(".next").click(function(){
        
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        
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
        html += '<input type="text" name="type[]" class="form-control" placeholder="Enter Type">';
        html += '<label for="type">Discount: </label>';
        html += '<input type="text" name="discount[]" class="form-control" placeholder="Enter Discount">';
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
        html += '<input type="text" class="form-control" id="guest_name" placeholder="Enter Name" name="guest_name[]"/>';
        html += '</td>';
        html += '<td>';
        html += '<input type="number"   class="form-control" id="deposit" placeholder="Enter Deposit" name="deposit[]"/>';
        html += '</td>';
        html += '<td>';
        html += '<a href="#" id="removeguest" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
        html += '</td>';
        html += '</tr>';
        $('#guests_row').append(html);
    });

    $(document).on('click', '#removeguest', function () {
        $(this).closest('tr').remove();
    });
</script>
@endsection