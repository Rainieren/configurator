@extends('layouts.dashboard')

@section('content')
    <div class="px-20 pt-10 pb-10">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-2xl font-bold">Create a new step</p>
            </div>
        </div>
    </div>
    <step-create-form></step-create-form>
@endsection
