@if (\Session::has('error'))
<div class="alert alert-danger bg-danger text-white alert-dismissible fade show" role="alert">
   <i class="fas fa-exclamation-circle"></i> {!! \Session::get('error') !!}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<script>
toastError("{{ \Session::get('error') }}");
</script>
@elseif (\Session::has('success'))
<div class="alert alert-success bg-success text-white alert-dismissible fade show" role="alert">
   <i class="fas fa-check-circle"></i> {!! \Session::get('success') !!}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<script>
toastSuccess("{{ \Session::get('success') }}");
</script>
@elseif (\Session::has('warning'))
<div class="alert alert-warning bg-warning text-white alert-dismissible fade show" role="alert">
   <i class="fas fa-check-circle"></i> {!! \Session::get('warning') !!}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<script>
toastError("{{ \Session::get('warning') }}");
</script>
@elseif (\Session::has('status'))
<div class="alert alert-success bg-success text-white alert-dismissible fade show" role="alert">
   <i class="fas fa-check-circle"></i> {!!  \Session::get('status') !!}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<script>
toastError("{{ \Session::get('status') }}");
</script>
@endif
@if($errors->any())
<script>
toastError("Opps, there are some problems.");
</script>
<div class="alert alert-danger bg-danger text-white alert-dismissible fade show" role="alert">
	<i class="fas fa-exclamation-circle"></i> Opps, there are some problems.
   <hr>
   @foreach ($errors->all() as $error)
      <div>{{$error}}</div>
   @endforeach
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
@endif