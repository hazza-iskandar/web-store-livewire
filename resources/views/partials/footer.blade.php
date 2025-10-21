{{-- ini untuk js flowbite --}}


<script src="{{ asset('assets/js/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper/custom-swiper.js') }}"></script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const accordions = document.querySelectorAll('[data-accordion-target]')

            accordions.forEach(btn => {
                btn.addEventListener('click', function() {
                    const icon = this.querySelector('i')
                    const target = document.querySelector(this.getAttribute(
                        'data-accordion-target'))

                    // toggle rotate saat dibuka/tutup
                    if (target.classList.contains('hidden')) {
                        icon.classList.add('rotate-180')
                    } else {
                        icon.classList.remove('rotate-180')
                    }
                })
            })
        })
    </script>