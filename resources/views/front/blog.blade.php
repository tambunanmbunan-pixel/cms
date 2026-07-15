@extends('front.layout.layout')

@section('content')
<main class="max-w-container-max mx-auto px-margin-desktop py-12 pt-28">
    <header class="mb-section-gap border-b border-outline-variant/30 pb-12">
        <h1 class="font-display-lg text-display-lg text-primary mb-4">Fragrance Journal</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl italic">An editorial exploration into the alchemy of scent, the heritage of craftsmanship, and the sensory landscape of the modern individual.</p>
    </header>

    @if($featured)
        <section class="mb-section-gap">
            <div class="relative grid grid-cols-12 gap-gutter group cursor-pointer overflow-hidden rounded-xl bg-surface-container-low border border-primary/5 shadow-sm" onclick="window.location.href='{{ route('front.blog.show', $featured->slug) }}'">
                <div class="col-span-12 lg:col-span-8 overflow-hidden h-[500px]">
                    <img alt="{{ $featured->title }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                         src="{{ filter_var($featured->image, FILTER_VALIDATE_URL) ? $featured->image : asset('admin/images/blogs/' . $featured->image) }}">
                </div>
                <div class="col-span-12 lg:col-span-4 p-12 flex flex-col justify-center">
                    <span class="text-secondary font-label-md text-label-md tracking-widest uppercase mb-4">{{ $featured->category->name ?? 'Journal' }}</span>
                    <h2 class="font-headline-lg text-headline-lg text-primary mb-6 leading-tight">
                        {{ $featured->title }}
                    </h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-8 line-clamp-4">{{ $featured->excerpt }}</p>
                    <div class="flex items-center justify-between mt-auto pt-6 border-t border-outline-variant/30">
                        <span class="font-label-md text-label-md text-on-surface-variant italic">{{ $featured->read_time }} min read</span>
                        <a class="font-button text-button text-primary flex items-center gap-2 group-hover:text-secondary transition-colors" href="{{ route('front.blog.show', $featured->slug) }}">
                            Read More <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <div class="grid grid-cols-12 gap-gutter">
        <div class="col-span-12 lg:col-span-9">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-y-16 gap-x-gutter">
                @forelse($articles as $article)
                    <article class="card-hover-effect flex flex-col bg-white border border-outline-variant/10 rounded-xl p-4 shadow-sm hover:shadow-md transition-all">
                        <div class="aspect-[4/5] overflow-hidden rounded-lg mb-6 cursor-pointer" onclick="window.location.href='{{ route('front.blog.show', $article->slug) }}'">
                            <img alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" 
                                 src="{{ filter_var($article->image, FILTER_VALIDATE_URL) ? $article->image : asset('admin/images/blogs/' . $article->image) }}">
                        </div>
                        <span class="text-secondary font-label-md text-label-md uppercase tracking-wider mb-2 text-xs font-bold">{{ $article->category->name ?? 'Journal' }}</span>
                        <h3 class="font-headline-md text-headline-md text-primary mb-3 leading-tight font-bold cursor-pointer hover:text-secondary transition-colors" onclick="window.location.href='{{ route('front.blog.show', $article->slug) }}'">
                            {{ $article->title }}
                        </h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mb-4 line-clamp-3 text-sm">{{ $article->excerpt }}</p>
                        <div class="mt-auto flex items-center justify-between pt-4 border-t border-outline-variant/10">
                            <span class="font-label-md text-label-md text-on-surface-variant opacity-70 text-xs">{{ $article->read_time }} min read</span>
                            <a href="{{ route('front.blog.show', $article->slug) }}" class="font-button text-button text-primary hover:text-secondary transition-colors underline underline-offset-4 decoration-primary/20 text-xs font-bold">Read More</a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 py-16 text-center text-on-surface-variant/70 italic">
                        <span class="material-symbols-outlined text-4xl block mb-2 text-gray-300">menu_book</span>
                        Belum ada entri jurnal yang diterbitkan untuk kategori atau pencarian ini.
                    </div>
                @endforelse
            </div>

            <div class="mt-24 flex justify-center">
                {{ $articles->links('pagination::tailwind') }}
            </div>
        </div>

        <aside class="col-span-12 lg:col-span-3 space-y-12">
            <div class="bg-surface-container-low p-8 rounded-xl border border-primary/5 shadow-sm">
                <h4 class="font-headline-md text-headline-md text-primary mb-6 text-[20px] font-bold uppercase tracking-wider">Search Journal</h4>
                <form action="{{ route('front.blog.index') }}" method="GET" class="relative">
                    <input name="search" value="{{ request('search') }}" class="w-full bg-white border border-outline-variant/30 rounded-lg py-3 px-4 pr-10 focus:ring-1 focus:ring-secondary outline-none font-body-md transition-all text-sm" placeholder="Explore topics..." type="text">
                    <button type="submit" class="absolute right-3 top-3 text-on-surface-variant hover:text-primary transition-colors">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>

            <div class="bg-white p-8 rounded-xl border border-outline-variant/10 shadow-sm">
                <h4 class="font-headline-md text-headline-md text-primary mb-6 text-[20px] font-bold uppercase tracking-wider border-b border-primary/10 pb-4">Categories</h4>
                <ul class="space-y-4">
                    <li>
                        <a class="flex justify-between items-center group {{ request('category') == '' ? 'font-bold text-secondary' : '' }}" href="{{ route('front.blog.index') }}">
                            <span class="font-body-md text-on-surface-variant group-hover:text-secondary transition-colors text-sm">All Entries</span>
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a class="flex justify-between items-center group {{ request('category') == $cat->id ? 'font-bold text-secondary' : '' }}" href="{{ route('front.blog.index', ['category' => $cat->id]) }}">
                                <span class="font-body-md text-on-surface-variant group-hover:text-secondary transition-colors text-sm">{{ $cat->name }}</span>
                                <span class="font-label-md text-on-surface-variant/40 text-xs bg-gray-50 px-2 py-0.5 rounded-full border border-gray-100">{{ sprintf('%02d', $cat->posts_count) }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-white p-8 rounded-xl border border-outline-variant/10 shadow-sm">
                <h4 class="font-headline-md text-headline-md text-primary mb-6 text-[20px] font-bold uppercase tracking-wider border-b border-primary/10 pb-4">Recent Entries</h4>
                <div class="space-y-6">
                    @foreach($recentPosts as $post)
                        <a class="flex gap-4 group" href="{{ route('front.blog.show', $post->slug) }}">
                            <div class="w-16 h-16 shrink-0 rounded overflow-hidden border">
                                <img alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ filter_var($post->image, FILTER_VALIDATE_URL) ? $post->image : asset('admin/images/blogs/' . $post->image) }}">
                            </div>
                            <div>
                                <h5 class="font-label-md text-label-md text-primary group-hover:text-secondary transition-colors leading-snug text-xs font-bold line-clamp-2">{{ $post->title }}</h5>
                                <span class="text-[10px] text-on-surface-variant/60 font-body-md block mt-1">{{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="bg-white p-8 rounded-xl border border-outline-variant/10 shadow-sm">
                <h4 class="font-headline-md text-headline-md text-primary mb-6 text-[20px] font-bold uppercase tracking-wider border-b border-primary/10 pb-4">Popular Topics</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach($categories->take(6) as $cat)
                        <a class="px-3 py-1.5 rounded-full border border-primary/10 text-on-surface-variant font-label-md text-[10px] font-bold hover:bg-primary hover:text-white transition-all uppercase tracking-wider" href="{{ route('front.blog.index', ['category' => $cat->id]) }}">
                            #{{ strtoupper($cat->name) }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="bg-primary text-on-primary p-8 rounded-xl relative overflow-hidden shadow-md">
                <div class="relative z-10">
                    <h4 class="font-headline-md text-headline-md mb-4 text-[20px] font-bold uppercase tracking-wider text-white">Join the Collective</h4>
                    <p class="font-body-md text-white/70 mb-6 text-xs leading-relaxed">Monthly dispatches on olfactive science and exclusive pre-access to limited editions.</p>
                    <input class="w-full bg-white/10 border-none rounded-lg py-3 px-4 mb-4 text-white placeholder:text-white/40 focus:ring-1 focus:ring-secondary-container text-xs outline-none" placeholder="Email Address" type="email">
                    <button class="w-full bg-secondary-container text-white font-button text-xs font-bold py-3 rounded-lg hover:brightness-110 transition-all uppercase tracking-widest shadow-md">Subscribe</button>
                </div>
                <div class="absolute -right-8 -bottom-8 opacity-10">
                    <span class="material-symbols-outlined text-[120px] text-white">mark_email_read</span>
                </div>
            </div>
        </aside>
    </div>
</main>
@endsection