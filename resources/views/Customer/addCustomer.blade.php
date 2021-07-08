@extends('welcome')
@if (isset($uc))
@section('title', 'Updated Customer')
@else
@section('title', 'Add Customer')
@endif

@section('dyBody')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="float-left">
                            @if (isset($uc))
                            <h4 class="card-title">{{ __('Update Customer Table') }}</h4>
                            @else
                            <h4 class="card-title">{{ __('Customer Table') }}</h4>
                            <p class="card-category">{{ __('Add, Edit, Update Customers') }}</p>
                            @endif
                        </div>
                        <div class="float-right">
                            <a href="{{ url('/customers') }}" class="btn btn-secondary btn-sm">
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (isset($uc))
                        {!! Form::model($uc, ['route' => 'updateCustomer', 'id' => 'formUpdatesubmit', 'method' => 'PATCH', 'files' => true]) !!}
                        {{ Form::hidden('id', $uc->id) }}
                        @csrf
                        @else
                        {!! Form::open(['route' => 'storeCustomer', 'id' => 'formsubmit', 'method' => 'POST', 'files' => true]) !!}
                        @csrf
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('customerName', Lang::get('Customer Name'), ['class' => 'bmd-label-floating']) }}
                                    {{ Form::text('customer_Name', null, ['class' => 'form-control', 'id' => 'customerName', 'required' => 'required']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('customerEmail', Lang::get('Email'), ['class' => 'bmd-label-floating']) }}
                                    {{ Form::email('customer_Email', null, ['class' => 'form-control', 'id' => 'customerEmail', 'required' => 'required']) }}
                                    <span class="text-danger" id="ajaxValidation">
                                        @if ($errors->has('customer_Email'))
                                        {{ $errors->first('customer_Email') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('catagoryList', Lang::get('Select Catagory')) !!}
                                    {!! Form::select('catagory_List', $catagories, null, ['class' => 'form-control js-source-states', 'id' => 'catagoryListID', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('brandId', Lang::get('Select Brand')) }}
                                    {!! Form::select('brandId_Id', isset($uc)?$brands:[], null, ['class' => 'js-source-states form-control', 'id' => 'brandId', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="py-3">
                                    {!! Form::label('image', Lang::get('Upload Profile Picture')) !!}
                                    {!! Form::file('image', ['class' => 'form-control-file', 'id' => 'image', 'alt' => 'No image', 'accept' => 'image/jpeg,image/x-png', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="py-3">
                                    {!! Form::label('pdf', Lang::get('Upload Document --- Formate pdf')) !!}
                                    {!! Form::file('pdf', ['class' => 'form-control-file', 'id' => 'pdf', 'accept' => 'application/pdf', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                        @if (isset($uc))
                        {!! Form::submit(Lang::get('Update Customer'), ['id' => 'updatedCustomerBtn', 'class' => 'btn btn-primary pull-right']) !!}
                        @else
                        {!! Form::submit(Lang::get('Add Customer'), ['id' => 'addCustomerBtn', 'class' => 'btn btn-primary pull-right']) !!}

                        @endif
                        <div class="clearfix"></div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('custom-sricpt')
<script>
    $(document).ready(function () {
        $("#catagoryListID").on('change', function () {

            //Dynamic Dependent DropDown START
            //Catagory Select Than Brand item show other wise not showing
            var catagoryList = document.getElementById("catagoryListID").value;
            var brandIdSelectList = document.getElementById("brandId");

            $("#brandId").empty();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var brandsObjList = JSON.parse(this.responseText);
                    for (const [key, value] of Object.entries(brandsObjList)) {
                        var option = document.createElement("option");
                        option.value = key;
                        option.text = value;
                        brandIdSelectList.appendChild(option);
                    }
                }
            };
            var url = "{{ url('ajax-catogry-brand') }}";
            var serverpage = url + "/" + catagoryList;
            xhttp.open("GET", serverpage, true);
            xhttp.send();
        });
        //Dynamic Dependent DropDown END


    });

</script>
@endsection
