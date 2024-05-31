
<th scope="col"  class="{{$class}}">
    <button class="flex items-center gap-2"  wire:click="setSortBy('{{ $colName }}')">
        {{ $displayName }}

        @if ($sortBy !== $colName)
            <img src="/images/table/sort.png" width="10" alt="sorting icons">
        @elseif ($sortDir == 'ASC')
            <img src="/images/table/desc.png" width="10" alt="ascending icon">
        @else
            <img src="/images/table/asc.png" width="10" alt="descending icon">
        @endif

    </button>
</th>
