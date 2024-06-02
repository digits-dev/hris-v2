@props([
    'colName' => null,
    'displayName' => null,
    'sortBy' => $this->sortBy ?? null,
    'sortDir' => $this->sortDir ?? null,
    'mxAuto' => false,
])

<th {{ $attributes }} scope="col">
  <button @style(['margin:auto' => $mxAuto]) class="flex items-center gap-2"
    wire:click="setSortBy('{{ $colName }}')">
    {{ $displayName }}

    @if ($sortBy !== $colName)
      <img alt="sorting icons" src="/images/table/sort.png" width="10">
    @elseif ($sortDir == 'ASC')
      <img alt="ascending icon" src="/images/table/desc.png" width="10">
    @else
      <img alt="descending icon" src="/images/table/asc.png" width="10">
    @endif

  </button>
</th>
