{{-- ini untuk js flowbite --}}
<script>
    document.addEventListener('livewire:navigated', () => {
        if (typeof initFlowbite === 'function') initFlowbite();
    });

    document.addEventListener('livewire:update', () => {
        if (typeof initFlowbite === 'function') initFlowbite();
    });
</script>


<script src="{{ asset('assets/js/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper/custom-swiper.js') }}"></script>
