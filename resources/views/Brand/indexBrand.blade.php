@extends('welcome')
@section('title', 'Brand')

@section('dyBody')
    <div class="content">
        <div class="container-fluid">
            @include('error.errorsMessage')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="float-left">
                                <h4 class="card-title ">Brand Table</h4>
                                <p class="card-category"> Here is the product catagory table</p>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('addbrandView') }}" data-toggle="tooltip" data-placement="top"
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
                                            Catagory Name
                                        </th>
                                        <th>
                                            Brand Name
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($brands as $item)
                                            <tr>
                                                <td>
                                                    {{ ++$i  }}
                                                </td>
                                                <td>
                                                    {{$item->catagoryName}}
                                                </td>
                                                <td>
                                                    {{$item->brandName}}
                                                </td>
                                                <td>
                                                    <a href="{{
                                                        route('updateBrandBtn',['id'=>$item->id])
                                                        }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <span class="material-icons">
                                                            create
                                                        </span>
                                                    </a>
                                                    <a href="{{
                                                        route('deleteBrandBtn',['id'=>$item->id])
                                                        }}" data-toggle="tooltip" data-placement="bottom"
                                                        onclick="warningMsg()" id="deleteBrandBtn" title="Delete">
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
        function warningMsg() {
            alert("Are you sure to delete this row?");
        }
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
@endsection
