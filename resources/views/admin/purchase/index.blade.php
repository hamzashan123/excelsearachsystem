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
            <label for="customer"> Add Customers*
              
            <select name="customer" id="customer" class="form-control select2"  required>
                @foreach($customers as $id => $customer)
                    <option value="{{ $customer->id }}">{{ $customer->first_name }} {{  $customer->last_name}}</option>
                @endforeach
            </select>
           
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Create 
                </button>
            </div>
           
            
            </div>
            <br>
            <div class="row">
                    <div class="col-sm">
                     
            <label for="name">Add Part Number*</label>
            <input type="text" id="part_number" name="part_number" class="form-control"  required>
                    </div>
                    <div class="col-sm">
                    <label for="name">Date Purchased*</label>
            <input type="date" id="purchase_date" name="purchase_date" class="form-control"  required>
                    </div>
                    <div class="col-sm">
                    <label for="name">Cost*</label>
            <input type="text" id="cost" name="cost" class="form-control"  required>
                    </div>
            </div>
            <br>
            <div class="row">
                    <div class="col-sm">
                     
            <label for="name">Quantity*</label>
            <input type="number" id="quantity" name="quantity" class="form-control"  required>
                    </div>
                    <div class="col-sm">
                    <label for="name">Search or Add Manufacturer*</label>
            <input type="text" id="manufacturer" name="manufacturer" class="form-control"  required>
                    </div>
                    <div class="col-sm">
                    <label for="name">Status*</label>
                    <input type="text" name="status" class="form-control" value="pending" disabled>
                    </div>
            </div>

            <br>
            <div class="row">
                    <div class="col-sm">
                     
            <label for="name">Selling Price*</label>
            <input type="text" id="selling_price" name="selling_price" class="form-control"  required>
                    </div>
                    <div class="col-sm">
                    <label for="name">Currency*</label>
            <input type="text" id="currency" name="currency" class="form-control"  required>
                    </div>
                    <div class="col-sm">
                    <label for="name">Tracking Number*</label>
            <input type="text" id="tracking_number" name="tracking_number" class="form-control"  required>
                    </div>
            </div>

            <br>
            <div class="row">
                    <div class="col-sm">
                     
            <label for="name">Description*</label>
            <input type="text" id="description" name="description" class="form-control"  required>
                    </div>
                    <div class="col-sm">
                    <label for="name">Notes*</label>
            <input type="text" id="notes" name="notes" class="form-control"  required>
                    </div>
                    <div class="col-sm">
                    <label for="name">Expected Delivery*</label>
            <input type="date" id="expected_delivery" name="expected_delivery" class="form-control"  required>
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
                    Customer Name
                </th>
                <th>
                    Part Number
                </th>
                <th>
                    Purchase Date
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Manufacturer
                </th>
               
                <th>
                    Status
                </th>
                <th>
                Selling Price
                </th>
                <th>
                Currency
                </th>
                <th>
                Tracking Number
                </th>
                <th>
                Description
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
                        {{ $purchase->customer_name ?? '' }}
                        
                    </td>
                    <td>
                        {{ $purchase->part_number ?? '' }}
                        
                    </td>
                    <td>
                        {{ $purchase->purchase_date ?? '' }}
                       
                    </td>
                    <td>
                        {{ $purchase->cost ?? '' }}
                       
                    </td>
                    <td>
                        {{ $purchase->quantity ?? '' }}
                       
                    </td>
                    <td>
                        {{ $purchase->manufacturer ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->status ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->selling_price ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->currency ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->tracking_number ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->description ?? '' }}
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
      <div class="row">
                    <div class="col-md-6">
                     
            <label for="name">First Name*</label>
            <input type="text" id="first_name" name="first_name" class="form-control"  required>
                    </div>
                    <div class="col-md-6">
                    <label for="name">Last Name*</label>
                        <input type="text" id="last_name" name="last_name" class="form-control"  required>
                    </div>
                    <div class="col-md-6">
                    <label for="name">Gender*</label>
                    <select name="gender" id="gender" class="form-control"  required>
                            <option value="" selected>Select Gender</option>  
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                    </select>
                    </div>
                    <div class="col-md-6">
                    <label for="name">Email*</label>
                        <input type="email" id="email" name="email" class="form-control"  required>
                    </div>
                    <div class="col-md-6">
                    <label for="name">Phone*</label>
                        <input type="tel" id="phone" name="phone" class="form-control"  required>
                    </div>
                    <div class="col-md-6">
                    <label for="name">Address*</label>
                        <input type="text" id="address" name="address" class="form-control"  required>
                    </div>
                    <div class="col-md-12">
                    <label for="name">Company*</label>
                        <input type="text" id="company" name="company" class="form-control"  required>
                    </div>
                    <div class="col-md-12">
                    <label for="name">Notes*</label>
                        <textarea name="notes" class="form-control"></textarea>
                    </div>
            </div>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
@parent
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
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})


</script>
@endsection