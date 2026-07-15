@extends('front.layout.layout')

@section('content')
<main>
    <section class="relative h-screen min-h-[700px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0 bg-primary-container overflow-hidden">
            <div class="absolute inset-0 opacity-40 mix-blend-overlay">
                <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDEcGEwUiiBw-7igaZ2kL9iHfaGbLeXc63J72uaCZPPbuY8dKxO6UwjegHz5xTTOlKLiSP2mesOOfIKJdMvlGr6X11kgbG62E_3W5FQgAkPdMhyXYUJ67X4D4VPK3CpqHVKrEAqWiT5gJSnyKEVxHf0YVZysEDRAZ4tkMSMqzWEdudx_nGSaoOUuD-zyt2BqRtaFBDU9YvhhXchtNmIf41TYyFQpUzftGLceQNrOdlALgrb3Kz4sgKAq88Df3r9tTY5lC1UAhH2XtU')"></div>
            </div>
        </div>
        <div class="relative z-10 px-margin-desktop max-w-container-max mx-auto w-full">
            <div class="max-w-3xl">
                <h1 class="font-display-lg text-display-lg text-surface-bright mb-6">Every Fragrance <br><span class="italic">Tells a Story</span></h1>
                <p class="font-body-lg text-body-lg text-surface-variant/80 max-w-xl leading-relaxed">Hanah was founded on a simple yet profound belief: that scent has the power to transform moments into memories. Our mission is to curate olfactory journeys that spread happiness and evoke the timeless elegance of the modern individual.</p>
            </div>
        </div>
        <div class="absolute bottom-12 left-margin-desktop animate-bounce">
            <span class="material-symbols-outlined text-surface-bright/50">arrow_downward</span>
        </div>
    </section>

    <section class="py-section-gap px-margin-desktop max-w-container-max mx-auto grid grid-cols-1 md:grid-cols-2 gap-gutter items-center">
        <div class="space-y-8">
            <div>
                <span class="text-secondary font-label-md text-label-md uppercase tracking-widest">The Origin</span>
                <h2 class="font-headline-lg text-headline-lg text-primary mt-2">Brand Story</h2>
            </div>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Born in the intersection of traditional craftsmanship and contemporary vision, Hanah emerged as a sanctuary for those who seek more than just a scent. We began as a small laboratory dedicated to capturing the ephemeral beauty of botanical essences.</p>
            <p class="font-body-lg text-body-lg text-on-surface-variant">Each bottle is a testament to our dedication to the art of perfumery, blending rare ingredients sourced from across the globe to create a symphony of notes that resonate with the soul.</p>
        </div>
        <div class="relative aspect-[4/5] rounded-xl overflow-hidden group">
            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAVnkd6YL74LzYdrzh90W6NWxe0wm-jw9svKNV5mTHP6Z0W7D16ALCc4q3LDlLj3-UL6juc2QlQGAFtex55FA-j-KFE1lamg7ZVAMhHcujdPNnMwRKfMb8x66yRQlSxIpss103uRJQ6Ei-h8e643DIy6YUpska8VqI_CiHcJMlwk8iiC9lxHNNAoAgtRGd5oA2aWJJ0Z4ntal8av-BCyagsnGnoCNettIh23jAc1CR07jWCypzqrk8FeZD4a8HbbJIklitHRAx-dC4">
            <div class="absolute inset-0 bg-primary/10 mix-blend-multiply"></div>
        </div>
    </section>

    <section class="bg-surface-container-low py-section-gap">
        <div class="px-margin-desktop max-w-container-max mx-auto grid grid-cols-1 md:grid-cols-2 gap-16">
            <div class="p-12 bg-white rounded-xl shadow-sm border border-primary/5">
                <span class="material-symbols-outlined text-secondary text-4xl mb-6">visibility</span>
                <h3 class="font-headline-md text-headline-md text-primary mb-4">Our Vision</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">To be the global benchmark for luxury lifestyle fragrances, where innovation meets heritage to inspire a more fragrant, joyous world.</p>
            </div>
            <div class="p-12 bg-primary-container text-surface rounded-xl shadow-lg">
                <span class="material-symbols-outlined text-secondary-container text-4xl mb-6">auto_awesome</span>
                <h3 class="font-headline-md text-headline-md text-surface-bright mb-4">Our Mission</h3>
                <p class="font-body-md text-body-md text-surface-variant/80">To empower self-expression through scent, ensuring every individual finds their unique olfactory signature while maintaining the highest standards of ethics and quality.</p>
            </div>
        </div>
    </section>

    <section class="py-section-gap px-margin-desktop max-w-container-max mx-auto">
        <div class="text-center mb-16">
            <h2 class="font-headline-lg text-headline-lg text-primary">Core Values</h2>
            <div class="w-24 h-1 bg-secondary-container mx-auto mt-4"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
            <div class="group p-8 text-center hover:bg-white hover:shadow-xl transition-all duration-300 rounded-xl">
                <div class="w-16 h-16 bg-surface-container-high rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-secondary-container transition-colors">
                    <span class="material-symbols-outlined text-primary group-hover:text-white transition-colors">sentiment_very_satisfied</span>
                </div>
                <h4 class="font-headline-md text-[24px] text-primary mb-3">Happiness</h4>
                <p class="font-body-md text-body-md text-on-surface-variant">Fragrance should be a source of daily delight and emotional well-being.</p>
            </div>
            <div class="group p-8 text-center hover:bg-white hover:shadow-xl transition-all duration-300 rounded-xl">
                <div class="w-16 h-16 bg-surface-container-high rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-secondary-container transition-colors">
                    <span class="material-symbols-outlined text-primary group-hover:text-white transition-colors">verified</span>
                </div>
                <h4 class="font-headline-md text-[24px] text-primary mb-3">Authenticity</h4>
                <p class="font-body-md text-body-md text-on-surface-variant">We prioritize natural ingredients and transparent sourcing above all else.</p>
            </div>
            <div class="group p-8 text-center hover:bg-white hover:shadow-xl transition-all duration-300 rounded-xl">
                <div class="w-16 h-16 bg-surface-container-high rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-secondary-container transition-colors">
                    <span class="material-symbols-outlined text-primary group-hover:text-white transition-colors">diamond</span>
                </div>
                <h4 class="font-headline-md text-[24px] text-primary mb-3">Elegance</h4>
                <p class="font-body-md text-body-md text-on-surface-variant">Sophistication in every detail, from the first note to the final bottle design.</p>
            </div>
            <div class="group p-8 text-center hover:bg-white hover:shadow-xl transition-all duration-300 rounded-xl">
                <div class="w-16 h-16 bg-surface-container-high rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-secondary-container transition-colors">
                    <span class="material-symbols-outlined text-primary group-hover:text-white transition-colors">high_quality</span>
                </div>
                <h4 class="font-headline-md text-[24px] text-primary mb-3">Quality</h4>
                <p class="font-body-md text-body-md text-on-surface-variant">Uncompromising artisanal standards and rigorous testing for lasting excellence.</p>
            </div>
        </div>
    </section>

    <section class="py-section-gap bg-primary text-white">
        <div class="px-margin-desktop max-w-container-max mx-auto">
            <div class="mb-16">
                <h2 class="font-headline-lg text-headline-lg">Our Craft</h2>
                <p class="font-body-lg text-body-lg text-surface-variant/60 mt-4">The meticulous journey from raw essence to signature scent.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="relative pl-8 border-l border-white/20">
                    <span class="absolute left-0 top-0 text-[64px] font-display-lg text-white/10 leading-none">01</span>
                    <span class="material-symbols-outlined text-secondary-container text-3xl mb-4">psychology</span>
                    <h4 class="font-headline-md text-[24px] mb-4">Conceptualization</h4>
                    <p class="font-body-md text-surface-variant/80">Identifying the emotional core of the fragrance through intensive mood-boarding and creative dialogue.</p>
                </div>
                <div class="relative pl-8 border-l border-white/20">
                    <span class="absolute left-0 top-0 text-[64px] font-display-lg text-white/10 leading-none">02</span>
                    <span class="material-symbols-outlined text-secondary-container text-3xl mb-4">science</span>
                    <h4 class="font-headline-md text-[24px] mb-4">Formulation</h4>
                    <p class="font-body-md text-surface-variant/80">Master perfumers blend essential oils and extracts in our controlled laboratory environment.</p>
                </div>
                <div class="relative pl-8 border-l border-white/20">
                    <span class="absolute left-0 top-0 text-[64px] font-display-lg text-white/10 leading-none">03</span>
                    <span class="material-symbols-outlined text-secondary-container text-3xl mb-4">calendar_month</span>
                    <h4 class="font-headline-md text-[24px] mb-4">Maceration</h4>
                    <p class="font-body-md text-surface-variant/80">The fragrance is allowed to age for several months, allowing the notes to harmonize and deepen.</p>
                </div>
            </div>
            <div class="mt-20 rounded-2xl overflow-hidden aspect-video">
                <img class="w-full h-full object-cover grayscale opacity-60" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCgxiCKCyssxPWTTD-_oi2ZzZHK5Lk2H3AUmY1e6wfafI8iWqkFso0H6TsRg_KV-5MOAtaINtkAeLL6e0Q9JyIbBJEkDEBGa0MrE2FDWvlh-RtAdKj781__lJuAbmg8ImSGur23txVRtWNvAepFIvpiNGUpfm1OJf2OuZuzBni7LcYwxbrxs9tSwUR5yhJWOao6nFKpYwJZATT1GIi2Z732qZTyF-I2eUApPHe_4DVOO3lq8h0_108x4DhJVaW51TuJPDiVS_lm8Ww">
            </div>
        </div>
    </section>

    <section class="py-section-gap px-margin-desktop max-w-container-max mx-auto">
        <div class="relative bg-primary-container rounded-[32px] p-16 overflow-hidden flex flex-col items-center text-center">
            <div class="relative z-10 max-w-2xl">
                <h2 class="font-headline-lg text-headline-lg text-surface-bright mb-6">Begin Your Scent Journey</h2>
                <p class="font-body-lg text-body-lg text-surface-variant/80 mb-10">Discover the fragrance that resonates with your personal narrative. From light florals to deep woods, happiness is just a spray away.</p>
                <a class="inline-flex items-center justify-center px-12 py-5 bg-secondary-container text-white font-button text-button rounded-full hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 active:scale-95" href="{{ url('/products') }}">
                    Explore Our Collection
                </a>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const timeline = document.querySelector('.timeline-scroll');
        if (!timeline) return;

        let isDown = false;
        let startX;
        let scrollLeft;
    
        timeline.addEventListener('mousedown', (e) => {
            isDown = true;
            timeline.classList.remove('cursor-grab');
            timeline.classList.add('cursor-grabbing');
            startX = e.pageX - timeline.offsetLeft;
            scrollLeft = timeline.scrollLeft;
        });
        
        timeline.addEventListener('mouseleave', () => {
            isDown = false;
            timeline.classList.remove('cursor-grabbing');
            timeline.classList.add('cursor-grab');
        });
        
        timeline.addEventListener('mouseup', () => {
            isDown = false;
            timeline.classList.remove('cursor-grabbing');
            timeline.classList.add('cursor-grab');
        });
        
        timeline.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - timeline.offsetLeft;
            const walk = (x - startX) * 2;
            timeline.scrollLeft = scrollLeft - walk;
        });
    });
</script>
@endsection