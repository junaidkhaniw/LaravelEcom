@extends('front.master')

@section('content')

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
            <div class="CartContainer">
                <div class="Header">
                    <h3 class="Heading">Shopping Cart</h3>
                    <a href="{{ route('remove_all_in_cart') }}">Remove All</a>
                </div>

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @php $total = 0; @endphp
                @if (session('cart'))    
                    @foreach (session('cart') as $id => $product)
                        <div class="Cart-Items">
                            <div class="image-box">
                                <img src="images/{{$product['image']}}" height="120px" />
                            </div>
                            <div class="about">
                                <h1 class="title">{{$product['name']}}</h1>
                                <h3 class="subtitle">{{$product['details']}}</h3>
                            </div>
                            <div class="counter">
                                {{-- <div class="btn">+</div>
                                <div class="count">2</div>
                                <div class="btn">-</div> --}}
                                {{-- <label>Quantity</label> --}}
                                <form action="{{ route('update_cart', [$id]) }}" method="GET">
                                    <input type="number" name="quantity" value="{{ $product['quantity'] }}" min="1" style="width: 80px; margin-right: 5px;" />
                                    <button>Update</button>
                                </form>
                                
                            </div>
                            <div class="prices">
                                <div class="amount">${{$product['sale_price']*$product['quantity']}}</div>
                                <div class="save">
                                    {{-- <a href="{{ route('save_for_later_in_cart') }}">Save for later</a> --}}
                                </div>
                            
                                <a href="{{ route('remove_product_from_cart', [$id]) }}">Remove</a>
                            </div>
                        </div>
                        @php $total = $total + $product['sale_price'] * $product['quantity']; @endphp
                    @endforeach
                @endif

                <hr> 
                <div class="Checkout-Sec">
                    <div class="checkout">
                        <div class="total">
                            <div>
                                <div class="Subtotal">Sub-Total</div>
                                @php
                                    if(session('cart')) {
                                        $cartSession = session('cart');
                                        $cartCount = count($cartSession);
                                    }
                                @endphp
                                <div class="items">@if (session('cart')) {{ $cartCount }} @else 0 @endif items</div>
                            </div>
                            <div class="total-amount">${{$total}}</div>
                        </div>
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <button class="button">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection