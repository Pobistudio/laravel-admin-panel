@props(['name'])
@error($name)
    <small class="block mt-1 text-red-500 pl-2">{{ $message }}</small>
@enderror
