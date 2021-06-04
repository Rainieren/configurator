@extends('layouts.dashboard')

@section('content')
    <div class="px-20 pt-10 pb-10">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-3xl font-bold text-gray-900">Create a new configurator</p>
            </div>
        </div>
    </div>
    <configurator-create-form></configurator-create-form>
@endsection
