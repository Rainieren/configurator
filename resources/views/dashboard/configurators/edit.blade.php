@extends('layouts.dashboard')

@section('content')

    <configurator-edit-form :configurator="{{ $configurator }}"></configurator-edit-form>
@endsection
