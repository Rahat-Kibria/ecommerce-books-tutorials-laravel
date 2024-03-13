<ul>
    @foreach ($category_wise_products as $category_wise_product)
        @if ($category_wise_product->products->isNotEmpty())
            {{-- @foreach ($category_wise_product->products as $cat_wise_product) --}}
            {{-- {!! $category_wise_product1 = $category_wise_product->products()->paginate(9, ['*'], 'page')->withQueryString() !!} --}}
            {{-- @foreach ($category_wise_product->products()->paginate(9, ['*'], 'page')->withQueryString() as $cat_wise_product) --}}
            @foreach ($category_wise_product->products()->paginate(9)->withQueryString() as $cat_wise_product)
                <li>{{ $cat_wise_product->name }}</li>
            @endforeach
        @else
            @foreach ($category_wise_product->children as $cat_wise_product)
                @if ($cat_wise_product->products->isNotEmpty())
                    {{-- @foreach ($cat_wise_product->products as $cat_wise_prod) --}}
                    {{-- {!! $cat_wise_product1 = $cat_wise_product->products()->paginate(9, ['*'], 'page')->withQueryString() !!} --}}
                    {{-- @foreach ($cat_wise_product->products()->paginate(9, ['*'], 'page')->withQueryString() as $cat_wise_prod) --}}
                    @foreach ($cat_wise_product->products()->paginate(9)->withQueryString() as $cat_wise_prod)
                        <li>{{ $cat_wise_prod->name }}</li>
                    @endforeach
                @else
                    @foreach ($cat_wise_product->children as $cat_wise_prod)
                        @if ($cat_wise_prod->products->isNotEmpty())
                            {{-- @foreach ($cat_wise_prod->products as $cat_wise_pr) --}}
                            {{-- {!! $cat_wise_prod1 = $cat_wise_prod->products()->paginate(9, ['*'], 'page')->withQueryString() !!} --}}
                            {{-- @foreach ($cat_wise_prod->products()->paginate(9, ['*'], 'page')->withQueryString() as $cat_wise_pr) --}}
                            @foreach ($cat_wise_prod->products()->paginate(9)->withQueryString() as $cat_wise_pr)
                                <li>{{ $cat_wise_pr->name }}</li>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endif
    @endforeach
</ul>
{{-- Pagination Block --}}
@php
    // dd($category_wise_product1);
    // $category_wise_products->links();
    // $cat_wise_product1->links();
    // $cat_wise_prod1->links();
@endphp
