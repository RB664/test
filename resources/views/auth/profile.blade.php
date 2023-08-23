@extends('auth.profile')

@section('content')

<div class="container">
    <img class="pfp" {{Auth::user->image}}" alt="{{Auth::user->fullname}}">
</div>

<style scoped>
    .pfp {
        width: 300px;
        height: 280px;
    }
</style>
@endsection


