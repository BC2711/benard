@extends('layouts.admin.main')

@section('title', 'Hero Section Management - Londa Loans')
@section('page-title', 'Hero Section Management')
@section('page-description', 'Design and customize your hero section with real-time preview')

@push('styles')
    @include('layouts.components.styles.hero-section')
@endpush

@section('content')
    <!-- Page Header -->
    @include('layouts.components.hero.page-header')

    <!-- Performance Metrics -->
    @include('layouts.components.hero.performance-metrics')

    <!-- Status Messages -->
    @include('layouts.components.ui.status-messages')

    <!-- Hero Preview -->
    @include('layouts.components.hero.preview')

    <!-- Admin Panel -->
    @include('layouts.components.hero.admin-panel')

    <!-- Toggle Admin Panel Button -->
    @include('layouts.components.hero.toggle-button')
@endsection

@push('scripts')
    @include('layouts.components.scripts.hero-section-manager')
@endpush
