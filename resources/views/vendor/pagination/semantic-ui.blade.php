@if ($paginator->hasPages())
<div class="ui pagination menu" role="navigation">

    @if ($paginator->onFirstPage())
    <a class="icon item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"> <i
            class="left chevron icon"></i> </a>
    @else
    <a class="icon item" href="{{ $paginator->previousPageUrl() }}" rel="prev"
        aria-label="@lang('pagination.previous')"> <i class="left chevron icon"></i> </a>
    @endif

    @foreach ($elements as $element)

    @if (is_string($element))
    <a class="icon item disabled" aria-disabled="true">{{ $element }}</a>
    @endif

    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <a class="item active" href="{{ $url }}" aria-current="page">{{ $page }}</a>
    @else
    <a class="item" href="{{ $url }}">{{ $page }}</a>
    @endif
    @endforeach
    @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <a class="icon item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"> <i
            class="right chevron icon"></i> </a>
    @else
    <a class="icon item disabled" aria-disabled="true" aria-label="@lang('pagination.next')"> <i
            class="right chevron icon"></i> </a>
    @endif
</div>
@endif