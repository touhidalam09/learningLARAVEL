@extends('welcome')
@section('title','Add Catagory')

@section('dyBody')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="float-left">
                            <h4 class="card-title">Updated Catagory</h4>
                            <p class="card-category">Complete tasks</p>
                        </div>
                        <div class="float-right">
                            <a href="{{url('/catagory')}}" class="btn btn-secondary btn-sm">
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{Form::open(['route' => 'updatedCatagory'])}}
                        {{Form::hidden('id',$catagorys->id)}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('catagoryName', 'Catagory Name', ['class'=>'bmd-label-floating'])}}
                                    {{ Form::text('catagoryName', $catagorys->catagoryName, ['class'=>'form-control', 'id'=>'catagoryName', 'required' => 'required', 'onblur'=>'ajaxFun()'])}}
                                    <span class="text-danger" id="ajaxValidation">
                                        @if ($errors->has('catagoryName'))
                                        {{$errors->first('catagoryName')}}
                                        @endif
                                    </span>
                                    <div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{Form::submit('Update Catagory',['id'=>'addCatagoryBtn','class'=>'btn btn-primary pull-right'])}}
                       <div class="clearfix"></div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function ajaxFun() {
        catagoryname = document.getElementById('catagoryName')

        catagoryname = catagoryname.value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("ajaxValidation").innerHTML = this.responseText;
                if (this.responseText == "Already Exit") {
                    document.getElementById("addCatagoryBtn").disabled = true;
                } else {
                    document.getElementById("addCatagoryBtn").disabled = false;
                }
            }
        };
        var url = "{{url('ajax-validation')}}"
        serverpage = url+"/"+catagoryname;
        xhttp.open("GET", serverpage, true);
        xhttp.send();
    }
</script>
@endsection
