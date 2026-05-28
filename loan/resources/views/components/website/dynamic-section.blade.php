@php
    $component = $cmsSection->component ?: 'website.content-block';
    $view = str_starts_with($component, 'components.')
        ? $component
        : 'components.' . $component;
@endphp

@if (view()->exists($view))
    @include($view, [
        'cmsSection' => $cmsSection,
        'sectionContent' => $cmsSection->content ?? [],
        'sectionSettings' => $cmsSection->settings ?? [],
    ])
@else
    @include('components.website.content-block', [
        'cmsSection' => $cmsSection,
        'sectionContent' => $cmsSection->content ?? [],
        'sectionSettings' => $cmsSection->settings ?? [],
    ])
@endif
