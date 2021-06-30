@extends('layouts.app')
@section('content')
    <div class="flex justify-center">
        <div class="bg-white p-6 rounded-lg w-8/12">
            <x-post :post="$post" />
        </div>
    </div>
@endsection