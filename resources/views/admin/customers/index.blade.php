@extends('layouts.admin')
@section('content')
<div class="container">
    <h6 class="c-grey-900">
        Customers
    </h6>
    
    <br>
    <div class="table-responsive">
        <table class=" table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
                <tr>
                    <th width="10">
                        #
                    </th>
                    <th>
                        Firstname
                    </th>
                    <th>
                        Lastname
                    </th>
                    <th>
                        Gender
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Phone
                    </th>
                    <th>
                        Address
                    </th>
                    <th>
                        Company
                    </th>
                    <th>
                        Notes
                    </th>
                    

                </tr>
            </thead>
            <tbody>
                @foreach($customers as $key => $customer)
                <tr data-entry-id="{{ $customer->id }}">
                    <td>

                    </td>
                    <td>
                        {{ $customer->first_name ?? '' }}

                    </td>
                    <td>
                        {{ $customer->last_name ?? '' }}

                    </td>
                    <td>
                        {{ $customer->gender ?? '' }}

                    </td>
                    <td>
                        {{ $customer->email ?? '' }}

                    </td>
                    <td>
                        {{ $customer->phone ?? '' }}
                    </td>
                    <td>
                        {{ $purchase->address ?? '' }}

                    </td>
                    <td>
                        {{ $purchase->company ?? '' }}

                    </td>
                    <td>
                        {{ $purchase->notes ?? '' }}
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
                        <label for="name">Gender*</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="" selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Email*</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Phone*</label>
                        <input type="tel" id="phone" name="phone" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Address*</label>
                        <input type="text" id="address" name="address" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label for="name">Company*</label>
                        <input type="text" id="company" name="company" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label for="name">Notes*</label>
                        <textarea name="notes" class="form-control"></textarea>
                    </div>
                    <div class="col-md-12">
                      
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