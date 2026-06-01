@php
    $pageTitle = 'Success Stories';
    $pageSeo = (object) [
        'meta_title' => 'Customer Success Stories - Londa Loans',
        'meta_description' => 'Explore customer stories and the business growth supported by Londa Loans.',
    ];
@endphp
@include('components.website.header')
@include('components.website.menu')
<div class="h-20"></div>
@include('website.success-stories.index-content')
@include('components.website.footer')
@include('components.website.closing_header')
