<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

{{-- icon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- bundle --}}
<link rel="stylesheet" href="{{ asset('assets/css/swiper/swiper-bundle.min.css') }}">

{{-- tailwind --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
{{-- <link rel="stylesheet" href="{{ asset() }}">
<script src="{{ asset() }}"></script> --}}

{{-- midtrans payment gateaway --}}
{{-- buat production --}}
{{-- <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.midtrans_client_key') }}"></script> --}}
{{-- buat sandbox --}}
{{-- <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.midtrans_client_key') }}"></script> --}}
