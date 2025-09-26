@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Waktu tunda sebelum refresh (dalam milidetik). Contoh: 3000ms = 3 detik.
        const delay = 3000;

        // Simpan URL saat ini.
        const currentUrl = window.location.href;

        console.log('419 detected. Auto-refreshing in ' + (delay / 1000) + ' seconds...');

        setTimeout(function() {
            // Lakukan reload. Parameter 'true' memaksa full page reload dari server,
            // tetapi biasanya tidak diperlukan. Cukup window.location.reload()
            window.history.back();
        }, delay);
    });
</script>
