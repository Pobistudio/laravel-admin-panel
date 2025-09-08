@props([
    'showButtonAdd' => true,
    'buttonAddText' => 'Tambah',
    'routeButtonAdd',
    'data'
])

<div class="flex flex-col gap-3 p-2">
    @if ($showButtonAdd)
        <div class="flex w-full justify-start">
            <a href="{{ $routeButtonAdd }}" class="p-3 bg-lap-navy text-white text-sm font-normal rounded-lg hover:bg-lap-dark hover:drop-shadow-2xl transition-all delay-150 cursor-pointer">{{ $buttonAddText }}</a>
        </div>
    @endif
    {{ $slot }}
    {{ $data->table() }}
</div>
@push('scripts')
    {{ $data->scripts(attributes: ['type' => 'module']) }}
@endpush
