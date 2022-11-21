@extends('layouts.admin')
@section('content')
<div class="container">
<h6 class="c-grey-900">
   Recieving
</h6>
<div class="mT-30">
    <form action="{{ route("admin.purchaser.create") }}" method="POST" enctype="multipart/form-data">
        @csrf
        
           
            <div class="row">
                    <div class="col-sm">
                     
            <label for="name">Search by Tracking</label>
            <input type="text" id="quantity" name="quantity" class="form-control"  required>
                    </div>
                    <div class="col-sm">
                    <label for="name">Search by Part Number</label>
            <input type="text" id="manufacturer" name="manufacturer" class="form-control"  required>
                    </div>
                    <div class="col-sm">
                    <label for="name">Search by Company Name</label>
                    <input type="text" name="status" class="form-control" >
                    </div>
            </div>

            <br>
            <div class="row">
                    <div class="col-sm">
                     
            <label for="name">Search by Order Date</label>
            <input type="date" id="selling_price" name="selling_price" class="form-control"  required>
                    </div>
                    <div class="col-sm">
                    <label for="name">Search by Quantity</label>
            <input type="text" id="currency" name="currency" class="form-control"  required>
                    </div>

            </div>
       
            <br>
            <div class="row">
            <div class="col-lg">
            <input class="btn btn-success" style="width:100px;" type="submit" value="Search">
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