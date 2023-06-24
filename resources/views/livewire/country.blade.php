<div wire:init="loadCountry">
    @foreach ($country as $key => $item)
        <span class="badge badge-pill badge-primary">{{ $item->name }}</span>
    @endforeach
</div>
