<!-- If no products match -->
@if($products->isEmpty())
    <p style="justify-self:center; margin: 10px;">No products found. Please adjust your filters.</p>
@else
    <!-- If products match -->
    @php $displayedDrinks = []; @endphp
    @foreach ($products as $data)
        @if (!in_array($data->name, $displayedDrinks))
            <div class="product-card">
                <img src="{{ asset('assets/' . $data->image) }}" alt="Product Image">
                <div class="product-row" style="display:inline-flex">
                    <h3 class="product-title">{{ $data->name }}</h3>
                    <p class="product-price" data-gbp="{{ $data->price }}">from <span>£{{ number_format($data->price, 2) }}</span></p>   
                </div>
                <p class="product-description">{{ $data->description }}</p>
                <a href="{{ route('product-details', $data->id) }}" class="view-button">View</a>
            </div>
            @php $displayedDrinks[] = $data->name; @endphp
        @endif
    @endforeach
@endif