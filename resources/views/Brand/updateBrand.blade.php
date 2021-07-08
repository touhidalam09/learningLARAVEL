@extends('welcome')
@section('title', 'Add Brand')

@section('dyBody')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="float-left">
                                <h4 class="card-title">Updated Brand</h4>
                                <p class="card-category">Complete tasks</p>
                            </div>
                            <div class="float-right">
                                <a href="{{ url('/brand') }}" class="btn btn-secondary btn-sm">
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ Form::open(['route' => 'updateBrand', 'id'=>'updatedFormId']) }}
                            {{ Form::hidden('id', $brand->id) }}
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        {{ Form::label('catagory', 'Catagory') }}

                                        {{ Form::select('catagoryId', $catagories, $brand->catagoryId, ['placeholder' => '-- -- --Choose Catagory-- -- --',
                                                'class' => 'js-states form-control',
                                                'id' => 'catagoryId',
                                                'required' => 'required',
                                                'onkeyup' => 'ajaxFun()',
                                            ]) }}

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('brandName', 'Brand Name', ['class' => 'bmd-label-floating']) }}
                                        {{ Form::text('brandName', $brand->brandName, ['class' => 'form-control', 'id' => 'brandName', 'required' => 'required', 'onkeyup' => 'ajaxFun()']) }}
                                        <span class="text-danger" id="ajaxValidation">
                                            @if ($errors->has('brandName'))
                                                {{ $errors->first('brandName') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        {{ Form::checkbox('agree', 'valueAgree', false, ['required' => 'required']) }}
                                        {{ Form::label('agree', 'Agree With US ?') }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::button('Update Brand', ['id' => 'updatedbrandBtn', 'class' => 'btn btn-primary pull-right']) }}
                            <div class="clearfix"></div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('brand.script.scriptForUpdate')
@endsection
