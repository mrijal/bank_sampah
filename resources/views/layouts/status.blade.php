@if (session()->has('success'))
    <div class="alert alert-success mt2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{session('success')}}
    </div>
@elseif (session()->has('error'))
<div class="alert alert-danger mt2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{session('error')}}
</div>
@elseif ($errors->any())
<div class="alert alert-danger mt2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    Masukkan Data dengan Benar
</div>
@endif