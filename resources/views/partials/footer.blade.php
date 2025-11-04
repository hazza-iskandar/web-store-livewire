{{-- ini untuk js flowbite --}}
<script src="{{ asset('assets/js/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper/custom-swiper.js') }}"></script>

{{-- midtrans payment gateaway --}}
{{-- buat production --}}
{{-- <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.midtrans_client_key') }}"></script> --}}
{{-- buat sandbox --}}
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.midtrans_client_key') }}"></script>