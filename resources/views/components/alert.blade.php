@if (session()->has('alert'))
    @php
        $alert = session('alert');
        $type = $alert['type'];
        $message = $alert['message'];
        $bgColor = '';
        $textColor = '';
        $borderColor = '';
        $bgPing = '';
        $title = '';

        switch ($type) {
            case 'success':
                $bgColor = 'bg-green-100';
                $textColor = 'text-green-800';
                $borderColor = 'border-green-200';
                $bgPing = 'bg-green-800';
                $title = 'Success!';
                break;
            case 'error':
                $bgColor = 'bg-red-100';
                $textColor = 'text-red-800';
                $borderColor = 'border-red-200';
                $bgPing = 'bg-red-800';
                $title = 'Error!';
                break;
            case 'warning':
                $bgColor = 'bg-yellow-100';
                $textColor = 'text-yellow-800';
                $borderColor = 'border-yellow-200';
                $bgPing = 'bg-yellow-800';
                $title = 'Warning!';
                break;
            case 'info':
            default:
                $bgColor = 'bg-blue-100';
                $textColor = 'text-blue-800';
                $borderColor = 'border-blue-200';
                $bgPing = 'bg-blue-800';
                $title = 'Info!';
                break;
        }
    @endphp
    <div class="absolute top-4 right-4 z-50 animation-in-down">
        <div {{ $attributes->merge(['class' => "flex flex-col $bgColor border $borderColor $textColor px-4 py-3 rounded relative mb-4 transition duration-300 w-[250px] sm:w-[300px] rounded-xl shadow-lg gap-2"]) }} role="alert" id="alert-{{ uniqid() }}">
            <span class="relative flex size-3">
                <span class="absolute inline-flex h-full w-full animate-ping rounded-full {{ $bgPing }} opacity-75"></span>
                <span class="relative inline-flex size-3 rounded-full {{ $bgPing }}"></span>
            </span>
            <strong class="text-sm font-semibold">{{ $title }}</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer hover:drop-shadow-2xl" onclick="closeAlert(this.parentElement.id)">
                <svg class="fill-current h-6 w-6 {{ $textColor }}" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.15a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.15 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            <small class="block sm:inline">{{ $message }}</small>
        </div>
    </div>
@endif
