@extends('layouts.admin')
@section('content')

<div class="container">
    <h6 class="c-grey-900">
        Purchasing
    </h6>
    <div class="mT-30">
        <form action="{{ route("admin.purchaser.create") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-10">
                    <label for="customer"> Select Customer* </label>
                    <select name="customer_name" id="customer_name" class="form-control select2">

                    <option value=""> Select Option </option>
                    @if(Session::has('created_customer'))
                    @php 
                        $cus_data = Session::get('created_customer');
                        
                       @endphp
                    <option value="{{$cus_data->id}}" selected>{{ $cus_data->first_name }} {{ $cus_data->last_name}}</option>
                    @endif
                        @foreach($customers as $id => $customer)
                        
                        <option value="{{ $customer->first_name }} {{ $customer->last_name}}">{{ $customer->first_name }} {{ $customer->last_name}}</option>
                        @endforeach
                   
                    </select>

                </div>
                <div class="col-md-2 create">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Create
                    </button>
                </div>


            </div>
            <br>
            <div class="row">
                <div class="col-sm">

                    <label for="name">Add Part Number*</label>
                    <input type="text" id="part_number" name="part_number" class="form-control" required>
                </div>
                <div class="col-sm">
                    <label for="name">Date Purchased*</label>
                    <input type="date" id="purchase_date" name="purchase_date" class="form-control" required>
                </div>
                <div class="col-sm">
                    <label for="name">Cost*</label>
                    <input type="text" id="cost" name="cost" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm">

                    <label for="name">Quantity*</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" required>
                </div>
                <div class="col-sm">
                    <label for="name">Search or Add Manufacturer</label>
                    <input type="text" id="manufacturer" name="manufacturer" class="form-control" >
                </div>
                <div class="col-sm">
                    <label for="name">Status*</label>
                    <input type="text" name="status" class="form-control" value="pending" disabled>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-sm">

                    <label for="name">Selling Price</label>
                    <input type="text" id="selling_price" name="selling_price" class="form-control" >
                </div>
                <div class="col-sm">
                    <label for="name">Currency</label>
                    <input type="text" id="currency" name="currency" class="form-control" >
                </div>
                <div class="col-sm">
                    <label for="name">Tracking Number</label>
                    <input type="text" id="tracking_number" name="tracking_number" class="form-control" >
                </div>
                
            </div>

            <br>
            <div class="row">
                <div class="col-sm">

                    <label for="name">Description</label>
                    <input type="text" id="description" name="description" class="form-control" >
                </div>
                <div class="col-sm">
                    <label for="name">Notes</label>
                    <input type="text" id="notes" name="notes" class="form-control" >
                </div>
                <div class="col-sm">
                    <label for="name">Expected Delivery</label>
                    <input type="date" id="expected_delivery" name="expected_delivery" class="form-control" >
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">

                    <label for="name">Purchase Method*</label>
                    <select type="text" id="purchase_method" name="purchase_method" class="form-control" required>
                        <option value="eBay"> eBay</option>
                        <option value="Website"> Website</option>
                        <option value="BACS"> BACS</option>
                        <option value="Paypal"> Paypal</option>
                        <option value="Cash"> Cash</option>
                        <option value="Whatsapp"> Whatsapp</option>
                        <option value="Email"> Email</option>
                        <option value="Alibaba"> Alibaba</option>
                        <option value="Ali Express"> Ali Express</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="name">Order Number</label>
                    <input type="text" id="order_number" name="order_number" class="form-control" >
                </div>
               
            </div>

            <br>
            <div class="row">
                <div class="col-lg">
                    <input class="btn btn-success" style="width:100px;" type="submit" value="Add">
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="table-responsive">
        <table class=" table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
                <tr>
                    <th width="10">
                        #
                    </th>
                    <th>
                        Action
                    </th>
                    <th>
                        Purchase Date
                    </th>
                    <th>
                        Date Recieved
                    </th>
                    <th>
                        Order Number
                    </th>
                    <th>
                        Part Number
                    </th>
                    <th>
                        Manufacturer
                    </th>
                    <th>
                        Cost Price
                    </th>
                    <th>
                        Purchased From
                    </th>
                    <th>
                        Purchased Method
                    </th>
                    <th>
                        Quantity Ordered
                    </th>
                        
                    <th>
                        Quantity Recieved
                    </th>
                    <th>
                        Missing Qty
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Quality
                    </th>
                    <th>
                        Selling Price
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        Serial Number
                    </th>
                    <th>
                        Tracking Number
                    </th>
                    <th>
                        Purchase Currency
                    </th>
                    <th>
                        Company Purchased From
                    </th>
                    <th>
                        Notes
                    </th>
                    <th>
                        Expected Delivery
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $key => $purchase)
                <tr data-entry-id="{{ $purchase->id }}">
                    <td>

                    </td>
                    <td>
                    <a class="btn btn-xs btn-info update_purchase" data-id="{{$purchase->id}}" href="#">
                                {{ trans('global.edit') }}
                            </a>
                    </td>
                    <td>
                        {{ $purchase->purchase_date ?? '' }}

                    </td>
                    <td>
                        {{ $purchase->date_recieved ?? '' }}

                    </td>
                    <td>
                        {{ $purchase->order_number ?? '' }}

                    </td>
                    <td>
                        {{ $purchase->part_number ?? '' }}

                    </td>
                    <td>
                        {{ $purchase->manufacturer ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->cost ?? '' }}

                    </td>
                    <td>
                        {{ $purchase->purchased_from ?? '' }}

                    </td>
                    <td>
                        {{ $purchase->purchase_method ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->quantity ?? '' }}

                    </td>
                    <td>
                        {{ $purchase->quantity_recieved ?? '' }}

                    </td>
                    <td>
                        {{ $purchase->quantity_missing ?? '' }}

                    </td>
                    
                    <td>
                        {{ $purchase->status ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->quality ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->selling_price ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->description ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->serial_number ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->tracking_number ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->currency ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->company_purchased_from ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->notes ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->expected_delivery ?? '' }}
                    </td>
                    

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.purchaser.createcustomer')}}" method="post">    
                    @csrf
                <div class="row">
                    <div class="col-md-6">

                        <label for="name">First Name*</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Last Name*</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Gender</label>
                        <select name="gender" id="gender" class="form-control" >
                            <option value="" selected>Select Gender</option>
                            <option value="male" >Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Email</label>
                        <input type="email" id="email" name="email" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="name">Phone</label>
                        <input type="tel" id="phone" name="phone" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="name">Address</label>
                        <input type="text" id="address" name="address" class="form-control" >
                    </div>
                    <div class="col-md-12">
                        <label for="name">Company</label>
                        <input type="text" id="company" name="company" class="form-control" >
                    </div>
                    <div class="col-md-12">
                        <label for="name">VAT Number</label>
                        <input type="text" id="vat_number" name="vat_number" class="form-control" >
                    </div>
                    <div class="col-md-12">
                        <label for="name">Notes</label>
                        <textarea name="notes" class="form-control"></textarea>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px !important;">
                      
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
                </form>
            </div>
            
            
        </div>
    </div>
</div>


<!-- Purchase edit modal -->
<div class="modal fade" id="updatePurchaseData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.purchaser.update')}}" method="post">    
                    @csrf
                <div class="row">
                   
                    <input type="hidden" id="edit_data_id" name="edit_data_id" />
                
                    
                    <div class="col-md-6">
                        <label for="name">Part Number</label>
                        <input type="text" id="edit_part_number" name="edit_part_number" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="name">Date Purchased</label>
                        <input type="date" id="edit_date_purchased" name="edit_date_purchased" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="name">Cost </label>
                        <input type="text" id="edit_cost" name="edit_cost" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="name">Quantity </label>
                        <input type="text" id="edit_quantity" name="edit_quantity" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="name">Manufacturer </label>
                        <input type="text" id="edit_manufacturer" name="edit_manufacturer" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="name">Selling Price </label>
                        <input type="text" id="edit_selling_price" name="edit_selling_price" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="name">Currency </label>
                        <input type="text" id="edit_currency" name="edit_currency" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="name">Tracking Number </label>
                        <input type="text" id="edit_tracking_number" name="edit_tracking_number" class="form-control" >
                    </div>
                    
                    <div class="col-md-6">
                        <label for="name">Order Number</label>
                        <input type="text" id="edit_order_number" name="edit_order_number" class="form-control" >
                    </div>

                    <div class="col-md-6">
                        <label for="name">Serial Number</label>
                        <input type="text" id="edit_serial_number" name="edit_serial_number" class="form-control" >
                    </div>
                   
                    <div class="col-md-6">
                        <label for="name">Description</label>
                        <input type="text" id="edit_description" name="edit_description" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="name">Expected Delivery</label>
                        <input type="date" id="edit_expected_delivery" name="edit_expected_delivery" class="form-control" >
                    </div>
                    <div class="col-md-6">
                        <label for="name">Notes</label>
                        <input type="text" id="edit_notes" name="edit_notes" class="form-control" >
                    </div>
                   
                    <div class="col-sm-6">

                    <label for="name">Purchase Method</label>
                    <select  id="edit_purchase_method" name="edit_purchase_method" class="form-control" >
                        <option value="eBay"> eBay</option>
                        <option value="Website"> Website</option>
                        <option value="BACS"> BACS</option>
                        <option value="Paypal"> Paypal</option>
                        <option value="Cash"> Cash</option>
                        <option value="Whatsapp"> Whatsapp</option>
                        <option value="Email"> Email</option>
                        <option value="Alibaba"> Alibaba</option>
                        <option value="Ali Express"> Ali Express</option>
                    </select>
                    </div>

                
                    <br>
                    <div class="col-md-12" style="margin-top:20px;">
                      
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </div>
                </form>
            </div>
            
            
        </div>
    </div>
    </div>
@endsection
@section('scripts')
@parent
<script>
$(document).ready(function(){

    $(document).on("click", ".update_purchase", function(e) { 
        var rowid = $(this).attr('data-id');
        console.log(rowid);
        $.ajax({
            url: "{{route('admin.purchaser.edit')}}",
            type: "get", //send it through get method
            data: { 
                id: rowid, 
            },
            success: function(response) {
                console.log(response.data[0]);
                console.log(response.status);
                var responData = response.data[0];
                console.log(responData.tracking_number);
                if(response.status == 200)
             {
                console.log("rww",rowid);
                jQuery('#edit_data_id').val(rowid);
                
                jQuery('#edit_part_number').val(responData.part_number);
                jQuery('#edit_date_purchased').val(responData.purchase_date);
                jQuery('#edit_cost').val(responData.cost);
                jQuery('#edit_quantity').val(responData.quantity);
                jQuery('#edit_manufacturer').val(responData.manufacturer);
                jQuery('#edit_currency').val(responData.currency);
                jQuery('#edit_selling_price').val(responData.selling_price);
                jQuery('#edit_order_number').val(responData.order_number);
                jQuery('#edit_serial_number').val(responData.serial_number);
                jQuery('#edit_tracking_number').val(responData.tracking_number);
                jQuery('#edit_purchase_method').val(responData.purchase_method);
                jQuery('#edit_description').val(responData.description);
                jQuery('#edit_expected_delivery').val(responData.expected_delivery);
                jQuery('#edit_notes').val(responData.notes);

                //$('#edit_date_recieved').datepicker("setDate", new Date(2022,9,03) );
                jQuery('#updatePurchaseData').modal('show');
                //window.location = "/userData";
             }
            },
            error: function(xhr) {
                //Do Something to handle error
            }
        });
       
	}); 
});

    </script>
<script>
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('user_delete')
        let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.users.massDestroy') }}",
            className: 'btn-danger',
            action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ trans('
                        global.datatables.zero_selected ') }}')

                    return
                }

                if (confirm('{{ trans('
                        global.areYouSure ') }}')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            },
                            method: 'POST',
                            url: config.url,
                            data: {
                                ids: ids,
                                _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            order: [
                [1, 'desc']
            ],
            pageLength: 100,
        });
        $('.datatable-User:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script>
@endsection