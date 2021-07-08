@extends('welcome')
@section('title', 'Catagory')

@section('dyBody')
    <div class="content">
        <div class="container-fluid">
            @include('error.errorsMessage')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="float-left">
                                <h4 class="card-title ">Customers List</h4>
                                <p class="card-category">Add, Delete & Update Customers</p>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('createNewCustomer') }}" data-toggle="tooltip" data-placement="top"
                                    title="Add">
                                    <span class="material-icons bg-light">
                                        add_circle
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Customer Name
                                        </th>
                                        <th>
                                            Customer Email
                                        </th>
                                        <th>
                                            Catagory
                                        </th>
                                        <th>
                                            Brand
                                        </th>
                                        <th>
                                            Image
                                        </th>
                                        <th>
                                            PDF
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($customers as $item)
                                            <tr>
                                                <td>
                                                    {{ ++$i }}
                                                </td>
                                                <td>
                                                    {{ $item->customer_Name }}
                                                </td>
                                                <td>
                                                    {{ $item->customer_Email }}
                                                </td>
                                                <td>
                                                    {{ $item->catagory_name }}
                                                </td>
                                                <td>
                                                    {{ $item->Brand_name }}
                                                </td>
                                                <td>
                                                    {{ $item->image }}
                                                </td>
                                                <td>
                                                    {{ $item->pdf }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('editCustomer',['id'=>$item->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <span class="material-icons">
                                                            create
                                                        </span>
                                                    </a>
                                                    <a href="{{ route('deleteCustomer',['id'=>$item->id]) }}" data-toggle="tooltip" data-placement="bottom"
                                                        id="deleteBrandBtn" title="Delete">
                                                        <span class="material-icons">
                                                            delete_forever
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
@endsection
