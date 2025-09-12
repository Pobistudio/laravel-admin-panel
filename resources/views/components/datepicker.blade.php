@props(['name', 'value' => null, 'options' => '[]', 'placeholder' => 'Select date', 'class' => ''])

<div class="relative">
     <div class="absolute inset-y-0 end-0 flex items-center p-3 pointer-events-none">
         <i class="ri-calendar-line"></i>
     </div>
    <input
        type="text"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'p-3 w-full bg-slate-200 border border-slate-300 rounded-lg focus:outline-slate-400 ' . $class,
            'data-datepicker' => true,
            'data-options' => $options
            ]) }}
        readonly>
    <x-error-validation name="{{ $name }}"/>
</div>
