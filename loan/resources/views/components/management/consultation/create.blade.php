@extends('layouts.admin.main')

@section('title', 'Create Consultation Request')
@section('page-title', 'Create Consultation Request')
@section('page-description', 'Add a customer consultation request and send the standard email notifications.')
@section('page-icon')<i class="fas fa-calendar-plus"></i>@endsection

@section('content')
    @include('components.management.consultation.form')
@endsection
