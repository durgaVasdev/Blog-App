@extends('layouts.app')
@section('content')
<!--@include('include.header')-->

<div class="container">

<form  action="{{route('login')}}"  method="POST" class="ms-auto me-auto mt-auto"  style="width: 500px">
<div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email"  name="email"    class="form-control">
    
  </div>
  <div class="mb-3">
    <label  class="form-label">Password</label>
    <input type="password"   name="password"   class="form-control" >
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>


@endsection