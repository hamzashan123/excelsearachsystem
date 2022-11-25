@extends('layouts.admin')

@section('content')
<div class="container">
<h6 class="c-grey-900">
   Recieving
</h6>
<div class="mT-30">
    <form action="{{ route("admin.reciever.search") }}" method="POST" enctype="multipart/form-data">
        @csrf
        
           
            <div class="row">
                    <div class="col-sm">
                     
            <label for="name">Search by Tracking</label>
            <input type="text" id="tracking_number" name="tracking_number" class="form-control"  >
                    </div>
                    <div class="col-sm">
                    <label for="name">Search by Part Number</label>
            <input type="text" id="part_number" name="part_number" class="form-control"  >
                    </div>
                    <div class="col-sm">
                    <label for="name">Search by Company Name</label>
                    <input type="text" id="purchased_from" name="purchased_from" class="form-control" >
                    </div>
            </div>

            <br>
            <div class="row">
                    <div class="col-sm">
                     
            <label for="name">Search by Order Number</label>
            <input type="text" id="order_number" name="order_number" class="form-control"  >
                    </div>
                    <div class="col-sm">
                    <label for="name">Search by Quantity</label>
            <input type="text" id="quantity" name="quantity" class="form-control"  >
                    </div>
                    <div class="col-sm-4">

                    <label for="name">Purchase Method*</label>
                    <select type="text" id="purchase_method" name="purchase_method" class="form-control" >
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

            </div>
       
            <br>
            <div class="row">
            <div class="col-lg">
            <!-- <input class="btn btn-success" style="width:100px;" type="submit" value="Search">s -->
            </div>
            </div>
    </form>
</div>
    <br>
    <div class="table-responsive">
        <table class=" table table-bordered table-striped table-hover datatable datatable-User" id="recDatatable">
            <thead>
                <tr>
                    <th width="10">
                        #
                    </th>
                    @if(Auth::user()->roles[0]->title == 'Reciever')
                    <th>
                        Action
                    </th>
                    @endif
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
                    @if(Auth::user()->roles[0]->title == 'Reciever')
                    <td>
                    <a class="btn btn-xs btn-info update_data" data-id="{{$purchase->id}}" href="#">
                                {{ trans('global.edit') }}
                            </a>
                    </td>
                    @endif
                    <td>
                        {{ $purchase->purchase_date ?? '' }}

                    </td>
                    <td>
                        
                        {{ \Carbon\Carbon::parse($purchase->date_recieved)->format('Y-m-d') ?? '' }}
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
                        {{ $purchase->quantity -  $purchase->quantity_recieved}}

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
            <tfoot style="visibility: hidden;">
            <tr>
                    <th style="visibility: hidden;">
                        
                    </th>
                    
                    <th style="visibility: hidden;"> 
                        
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
            </tfoot>
        </table>
    </div>
 
    
    <div class="modal fade" id="updatePurchase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.reciever.update')}}" method="post">    
                    @csrf
                <div class="row">
                   
                        <input type="hidden" id="edit_data_id" name="edit_data_id" />
                
                    <div class="col-md-6">
                        <label for="name">Date Recieved</label>
                        <input type="date" id="edit_date_recieved" name="edit_date_recieved" class="form-control" >
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
                        <label for="name">Quantity Recieved *</label>
                        <input type="text" id="edit_quantity_recieved" name="edit_quantity_recieved" class="form-control" required>
                    </div>
                    

                    <div class="col-md-6">
                    <label for="customer"> Select Status </label>

                    <select name="edit_status" id="edit_status" class="form-control" >
                       
                        <option value="Pending">Pending</option>
                        <option value="Recieved">Recieved</option>
                        <option value="Broken">Broken</option>
                    </select>

                    </div>
                    <div class="col-md-6">
                    <label for="customer"> Select Qualtiy </label>

                    <select name="edit_quality" id="edit_quality" class="form-control" >
                        <option value="Good">Good</option>
                        <option value="Bad">Bad</option>
                        <option value="Faulty">Faulty</option>
                      
                    </select>

                    </div>
                   
                    <div class="col-md-12">
                        <label for="name">Notes</label>
                        <textarea name="editnotes"  id="editnotes" class="form-control"></textarea>
                    </div>
                    <br>
                    <div class="col-md-12" style="margin-top:20px;">
                      
                        <input type="submit" class="btn btn-primary" value="Submit">
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

   

    // $('#recDatatable tfoot th').each(function () {
    //     var title = $(this).text();
    //     $(this).html('<input type="text" placeholder=" ' + title.trim() + '" />');
    // });
    // var table = $('#recDatatable').DataTable();
 
    // Event listener to the two range filtering inputs to redraw on input


    $(document).on("click", ".update_data", function(e) { 
        var rowid = $(this).attr('data-id');
        console.log(rowid);
        $.ajax({
            url: "{{route('admin.reciever.edit')}}",
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
                jQuery('#edit_date_recieved').val(responData.date_recieved);
                jQuery('#edit_order_number').val(responData.order_number);
                jQuery('#edit_serial_number').val(responData.serial_number);
                jQuery('#edit_tracking_number').val(responData.tracking_number);
                jQuery('#edit_quantity_recieved').val(responData.quantity_recieved);
                jQuery('#edit_purchased_from').val(responData.purchased_from);
                jQuery('#edit_company_purchased_from').val(responData.company_purchased_from);
                jQuery('#edit_quantity_missing').val(responData.quantity_missing);
                jQuery('#edit_quality').val(responData.quality);
                jQuery('#edit_status').val(responData.status);
                jQuery('#edit_purchase_method').val(responData.purchase_method);
                jQuery('#editnotes').val(responData.notes);

                //$('#edit_date_recieved').datepicker("setDate", new Date(2022,9,03) );
                jQuery('#updatePurchase').modal('show');
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
    $('.datatable-User:not(.ajaxTable)').DataTable({
         buttons: dtButtons ,
         initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;
 
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
        
    })
    
    $('#tracking_number , #part_number , #purchased_from , #order_number , #quantity , #purchase_method').on( 'keyup change', function () {
        
        var tracking_number = $('#tracking_number').val();
        var part_number = $('#part_number').val();
        var purchased_from = $('#purchased_from').val();
        var order_number = $('#order_number').val();
        var quantity = $('#quantity').val();
        var purchase_method = $('#purchase_method').val();
        console.log(this.value);
        console.log('purchase_method' ,purchase_method);
        console.log(  $($.fn.dataTable.tables(true)).DataTable().column( 18 ));
        $($.fn.dataTable.tables(true)).DataTable()
        .column(4).search(order_number)
        .column(5).search(part_number)
        .column(9).search( purchase_method )
        .column(10).search( quantity )
        .column(18).search( tracking_number )
        .column(20).search( purchased_from )
        .draw();
    } );
    




    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });






})


</script>
@endsection