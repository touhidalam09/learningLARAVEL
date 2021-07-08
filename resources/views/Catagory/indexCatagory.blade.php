@extends('welcome')
@section('title','Catagory')

@section('dyBody')
<div class="content">
    <div class="container-fluid">
        @include('error.errorsMessage')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="float-left">
                            <h4 class="card-title ">Catagory Table</h4>
                            <p class="card-category"> Here is the product catagory table</p>
                        </div>
                        <div class="float-right">
                            <a href="{{route('addCatagoryView')}}" data-toggle="tooltip" data-placement="top" title="Add">
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
                                    Catagory
                                </th>
                                <th>
                                    Action
                                </th>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach($catagorys as $catagory)

                                    <tr>
                                        <td>
                                            {{ ++$i }}
                                        </td>
                                        <td>
                                            {{$catagory->catagoryName}}
                                        </td>
                                        <td>
                                            <a href="{{
                                               route('updateCatagoryById',['id'=>$catagory->id])
                                               }}"
                                               data-toggle="tooltip" data-placement="top" title="Edit">
                                                <span class="material-icons">
                                                    create
                                                </span>
                                            </a>
                                            <a href="{{
                                               route('deleteCatagory',['id'=>$catagory->id])
                                               }}" data-toggle="tooltip" data-placement="bottom" onclick="warningMsg()" id="deleteCatagroyBtn" title="Delete">
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
    function warningMsg(){
        confirm("Are you sure to delete this row?");
    }
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>
@endsection