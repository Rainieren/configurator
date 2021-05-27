@extends('layouts.dashboard')

@section('content')

    <product-edit-form :product="{{ $product }}"></product-edit-form>
@endsection
