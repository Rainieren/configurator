@extends('layouts.dashboard')

@section('content')
    <div class="border-b px-5 py-3 bg-white">
        <div class="flex">
            <div class="w-1/2 flex items-center">
                <p class="text-xl">Create a new step</p>
            </div>
        </div>
    </div>
    <step-create-form></step-create-form>
@endsection
