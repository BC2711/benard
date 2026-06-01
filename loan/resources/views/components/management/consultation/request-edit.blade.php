@extends('layouts.admin.main')

@section('title', 'Edit Consultation Request')
@section('page-title', 'Edit Consultation Request')
@section('page-description', 'Update customer details, booking preferences, and follow-up status.')
@section('page-icon')<i class="fas fa-calendar-pen"></i>@endsection

@section('content')
    @include('components.management.consultation.form')
@endsection
