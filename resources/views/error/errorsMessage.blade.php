@if (session('msgError'))
<div class="alert alert-warning">
    {{session('msgError')}}
    {{ session()->flush() }}
</div>
@endif
@if (session('msg'))
<div class="alert alert-success">
    {{session('msg')}}
    {{ session()->flush() }}
</div>
@endif
@if (session('msgdlt'))
<div class="alert alert-danger">
    {{session('msgdlt')}}
    {{ session()->flush() }}
</div>
@endif


    
