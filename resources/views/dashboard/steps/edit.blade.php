@extends('layouts.dashboard')

@section('content')
    <step-edit-form :step="{{ $step }}"></step-edit-form>
@endsection
