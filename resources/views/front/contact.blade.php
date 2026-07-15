@extends('front.layout.layout')

@section('content')
<main class="max-w-container-max mx-auto px-margin-desktop pt-28">
    <!-- Hero Section -->
    <section class="py-section-gap flex flex-col items-center text-center">
        <span class="font-label-md text-label-md text-secondary tracking-widest uppercase mb-4">Get in Touch</span>
        <h1 class="font-display-lg text-display-lg text-primary mb-6">Let's Connect</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">Experience the essence of Hanah in person or reach out for bespoke consultations. Our scent specialists are at your service.</p>
    </section>

    <!-- Notifikasi Sukses Menggunakan Session Flash -->
    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-500/20 text-emerald-800 rounded-xl flex items-center gap-3 shadow-sm max-w-3xl mx-auto fade-in">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Contact Two-Column Grid -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-gutter mb-section-gap">
        <!-- Left: Info Cards -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-surface-container-low p-8 rounded-xl border border-primary/5 shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="bg-primary-container p-3 rounded-lg text-on-primary">
                        <span class="material-symbols-outlined">location_on</span>
                    </div>
                    <div>
                        <h3 class="font-label-md text-label-md text-primary mb-2">Flagship Atelier</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                            422 Scent Avenue, Suite 100<br>
                            Paris, France 75001
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-surface-container-low p-8 rounded-xl border border-primary/5 shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="bg-primary-container p-3 rounded-lg text-on-primary">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <div>
                        <h3 class="font-label-md text-label-md text-primary mb-2">Direct Communications</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">concierge@hanah.luxury</p>
                        <p class="font-body-md text-body-md text-on-surface-variant">+33 (0) 1 45 67 89 00</p>
                    </div>
                </div>
            </div>
            <div class="bg-surface-container-low p-8 rounded-xl border border-primary/5 shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="bg-primary-container p-3 rounded-lg text-on-primary">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <div>
                        <h3 class="font-label-md text-label-md text-primary mb-2">Visiting Hours</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Monday – Friday: 10:00 AM – 7:00 PM</p>
                        <p class="font-body-md text-body-md text-on-surface-variant">Saturday: 11:00 AM – 6:00 PM</p>
                    </div>
                </div>
            </div>
            <!-- Map Placeholder -->
            <div class="relative h-64 rounded-xl overflow-hidden shadow-lg border border-primary/10 group">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDxRh0zimnXltrQc11V1EJ0IdasO1Ojt6Icbtlii6IQIHGUxgLbC6Ca3mFGnUidMAgKgnvPxwG-xme6WuydQzcaUv4TJ5ZBKUMZCmuKPXOrQlel9mBQzNtlzk7rSXBYh191trUClwzZNNxdBjbxCoV0rhhTjU4BeC7lZEBQep7v-3yfDHI_-nq78QCnhWRIvWexrsh5iczYdQE2DMzZunCSSw0Z6SFoo_oZw0iIJ0f5XO11ByLyw9Z5hnUi0Y3KHLWU-ZBiUdxUGJ0">
                <div class="absolute inset-0 bg-primary/20 backdrop-grayscale-[0.5] mix-blend-multiply"></div>
                <div class="absolute bottom-4 left-4 bg-surface p-3 rounded shadow-md border border-outline-variant/30">
                    <p class="font-label-md text-label-md text-primary">Open in Google Maps</p>
                </div>
            </div>
        </div>

        <!-- Right: Contact Form -->
        <div class="lg:col-span-7 bg-surface-container-lowest p-10 rounded-xl border border-outline-variant/30 shadow-lg">
            <form action="{{ route('front.contact.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="font-label-md text-label-md text-on-surface-variant">Full Name</label>
                        <input name="name" value="{{ old('name') }}" class="w-full bg-surface border border-outline-variant/30 rounded-lg p-4 focus:ring-1 focus:ring-secondary outline-none transition-all text-sm @error('name') border-red-400 focus:ring-red-400 @enderror" placeholder="Vance" type="text">
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="font-label-md text-label-md text-on-surface-variant">Email Address</label>
                        <input name="email" value="{{ old('email') }}" class="w-full bg-surface border border-outline-variant/30 rounded-lg p-4 focus:ring-1 focus:ring-secondary outline-none transition-all text-sm @error('email') border-red-400 focus:ring-red-400 @enderror" placeholder="vance@example.com" type="email">
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-on-surface-variant">Inquiry Subject</label>
                    <div class="relative">
                        <select name="subject" class="w-full bg-surface border border-outline-variant/30 rounded-lg p-4 focus:ring-1 focus:ring-secondary outline-none transition-all text-sm appearance-none @error('subject') border-red-400 focus:ring-red-400 @enderror">
                            <option value="Bespoke Consultation" {{ old('subject') == 'Bespoke Consultation' ? 'selected' : '' }}>Bespoke Consultation</option>
                            <option value="Order Inquiries" {{ old('subject') == 'Order Inquiries' ? 'selected' : '' }}>Order Inquiries</option>
                            <option value="Press & Media" {{ old('subject') == 'Press & Media' ? 'selected' : '' }}>Press & Media</option>
                            <option value="Wholesale Partnerships" {{ old('subject') == 'Wholesale Partnerships' ? 'selected' : '' }}>Wholesale Partnerships</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">expand_more</span>
                        </div>
                    </div>
                    @error('subject')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-on-surface-variant">Your Message</label>
                    <textarea name="message" class="w-full bg-surface border border-outline-variant/30 rounded-lg p-4 focus:ring-1 focus:ring-secondary outline-none transition-all text-sm resize-none @error('message') border-red-400 focus:ring-red-400 @enderror" placeholder="How may we assist you today?" rows="6">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button class="w-full bg-secondary-container text-white py-5 rounded-lg font-button text-button shadow-md hover:shadow-xl hover:translate-y-[-2px] active:translate-y-0 transition-all duration-300 font-bold uppercase tracking-widest text-xs cursor-pointer" type="submit">
                    Send Message
                </button>
            </form>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="mb-section-gap max-w-3xl mx-auto">
        <h2 class="font-headline-md text-headline-md text-primary text-center mb-12 font-bold">Frequent Enquiries</h2>
        <div class="space-y-4">
            <div class="accordion-item border-b border-outline-variant/30">
                <button class="w-full flex justify-between items-center py-6 text-left cursor-pointer group" onclick="toggleAccordion(this)">
                    <span class="font-label-md text-label-md text-primary group-hover:text-secondary transition-colors">How can I book a bespoke fragrance consultation?</span>
                    <span class="material-symbols-outlined accordion-icon transition-transform duration-300">expand_more</span>
                </button>
                <div class="accordion-content hidden">
                    <p class="pb-6 font-body-md text-body-md text-on-surface-variant text-sm leading-relaxed">Consultations can be booked directly through our concierge service via email or by visiting our flagship atelier in Paris. Private sessions typically last 90 minutes.</p>
                </div>
            </div>
            <div class="accordion-item border-b border-outline-variant/30">
                <button class="w-full flex justify-between items-center py-6 text-left cursor-pointer group" onclick="toggleAccordion(this)">
                    <span class="font-label-md text-label-md text-primary group-hover:text-secondary transition-colors">What is the expected shipping time for premium bundles?</span>
                    <span class="material-symbols-outlined accordion-icon transition-transform duration-300">expand_more</span>
                </button>
                <div class="accordion-content hidden">
                    <p class="pb-6 font-body-md text-body-md text-on-surface-variant text-sm leading-relaxed">Our luxury bundles are carefully packed to ensure integrity. Domestic orders typically arrive within 2-4 business days, while international shipping may take 5-10 business days.</p>
                </div>
            </div>
            <div class="accordion-item border-b border-outline-variant/30">
                <button class="w-full flex justify-between items-center py-6 text-left cursor-pointer group" onclick="toggleAccordion(this)">
                    <span class="font-label-md text-label-md text-primary group-hover:text-secondary transition-colors">Do you offer international wholesale opportunities?</span>
                    <span class="material-symbols-outlined accordion-icon transition-transform duration-300">expand_more</span>
                </button>
                <div class="accordion-content hidden">
                    <p class="pb-6 font-body-md text-body-md text-on-surface-variant text-sm leading-relaxed">Hanah selectively partners with high-end boutiques and luxury department stores globally. Please select 'Wholesale Partnerships' in the contact form for our dossier.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    function toggleAccordion(element) {
        const item = element.parentElement;
        const content = item.querySelector('.accordion-content');
        const icon = item.querySelector('.accordion-icon');
        const isActive = item.classList.contains('accordion-active');
        
        // Tutup semua akordion terlebih dahulu
        document.querySelectorAll('.accordion-item').forEach(acc => {
            acc.classList.remove('accordion-active');
            const c = acc.querySelector('.accordion-content');
            if(c) c.classList.add('hidden');
            const i = acc.querySelector('.accordion-icon');
            if(i) i.classList.remove('rotate-180');
        });
        
        // Buka akordion yang diklik jika belum aktif
        if (!isActive) {
            item.classList.add('accordion-active');
            if(content) content.classList.remove('hidden');
            if(icon) icon.classList.add('rotate-180');
        }
    }
</script>
@endsection