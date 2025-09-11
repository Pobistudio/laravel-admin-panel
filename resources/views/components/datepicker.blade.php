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
            'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ' . $class,
            'data-datepicker' => true,
            'data-options' => $options
            ]) }}
        readonly>
    <x-error-validation name="{{ $name }}"/>
</div>
