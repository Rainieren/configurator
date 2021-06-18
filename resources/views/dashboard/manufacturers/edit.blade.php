

@extends('layouts.dashboard')

@section('content')
    <manufacturer-edit-form :manufacturer="{{ $manufacturer }}"></manufacturer-edit-form>
@endsection
