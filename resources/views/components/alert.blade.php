@if (session()->has('alert'))
    @php
        $alert = session('alert');
        $type = $alert['type'];
        $message = $alert['message'];
        $bgColor = '';
        $textColor = '';
        $borderColor = '';
        $title = '';

        switch ($type) {
            case 'success':
                $bgColor = 'bg-green-100';
                $textColor = 'text-green-800';
                $borderColor = 'border-green-200';
                $title = 'Success!';
                break;
            case 'error':
                $bgColor = 'bg-red-100';
                $textColor = 'text-red-800';
                $borderColor = 'border-red-200';
                $title = 'Error!';
                break;
            case 'warning':
                $bgColor = 'bg-yellow-100';
                $textColor = 'text-yellow-800';
                $borderColor = 'border-yellow-200';
                $title = 'Warning!';
                break;
            case 'info':
            default:
                $bgColor = 'bg-blue-100';
                $textColor = 'text-blue-800';
                $borderColor = 'border-blue-200';
                $title = 'Info!';
                break;
        }
    @endphp
    <div class="absolute top-4 right-4 z-50">
        <div {{ $attributes->merge(['class' => "flex flex-col $bgColor border $borderColor $textColor px-4 py-3 rounded relative mb-4 transition duration-300 w-[300px] rounded-xl shadow-lg gap-2"]) }} role="alert">
            <strong class="text-sm font-semibold">{{ $title }}</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer hover:drop-shadow-2xl" onclick="this.parentElement.style.display='none'">
                <svg class="fill-current h-6 w-6 {{ $textColor }}" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.15a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.15 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            <small class="block sm:inline">{{ $message }}</small>
        </div>
    </div>
@endif
