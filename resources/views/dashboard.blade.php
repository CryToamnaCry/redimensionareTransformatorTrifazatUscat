@extends('layouts.app')
@section('content')
@include('upload.file-upload')
<x-rezultate :detalii="$detalii" />
@endsection

