<?php
/**
 * @var \Illuminate\Pagination\AbstractPaginator $paginator
 */
?>

@if ($paginator->hasPages())
    <div class="pagination">


        @foreach ($elements as $element)
            @if (is_string($element))
                <div class="pagination__link disabled">{{ $element }}</div>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <div class="pagination__link active">{{ $page }}</div>
                    @else
                        @php $url = str_replace('http:', 'https:', $url) @endphp
                        <a class="pagination__link" href="{{ $url }}" @if(isset($target)) data-target="{{ $target }}" @endif>{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

    </div>
@endif
