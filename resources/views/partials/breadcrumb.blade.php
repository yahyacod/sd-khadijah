{{-- Pakai: @include('partials.breadcrumb', ['items' => [
    ['label' => 'Beranda', 'url' => route('home')],
    ['label' => 'Judul Sekarang', 'url' => null],
]]) --}}
<nav class="breadcrumb" aria-label="Breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
    @foreach($items as $index => $item)
        <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        @if($item['url'])
            <a itemprop="item" href="{{ $item['url'] }}"><span itemprop="name">{{ $item['label'] }}</span></a>
        @else
            <span itemprop="name" class="breadcrumb-current">{{ $item['label'] }}</span>
        @endif
            <meta itemprop="position" content="{{ $index + 1 }}" />
        </span>
        @if(!$loop->last)
            <span class="breadcrumb-sep" aria-hidden="true">/</span>
        @endif
    @endforeach
</nav>