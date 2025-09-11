<div {{ $attributes->merge(['class' => 'flex flex-col gap-2 p-3 rounded-lg border border-slate-300']) }}>
    <span class="text-lap-dark font-normal text-base sm:text-sm">Filter</span>
    {{ $slot }}
</div>
