<style>
    .search-ads-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin: 2rem 0;
        justify-items: center;
        width: 100%;
    }
    @media (min-width: 1024px) {
        .search-ads-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>
<div {{ $attributes->merge(['class' => 'search-ads-grid', 'style' => 'max-width: 970px;']) }}>
    <div id="admate-banner-place-468-1"></div>
    <div id="admate-banner-place-468-2"></div>
    <div id="admate-banner-place-468-3"></div>
    <div id="admate-banner-place-468-4"></div>
</div>
