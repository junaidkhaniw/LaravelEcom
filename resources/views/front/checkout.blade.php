@extends('front.master')

@section('content')

<!-- SECTION -->
<div class="section bg-light">
    <!-- container -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                @php
                    if(session('cart')) {
                        $cartSession = session('cart');
                        $cartCount = count($cartSession);
                    }
                @endphp
                <span class="badge badge-secondary badge-pill">@if (session('cart')) {{ $cartCount }} @else 0 @endif</span>
              </h4>
              <ul class="list-group mb-3">

                @php $total = 0; @endphp
                @if (session('cart'))
                    @foreach (session('cart') as $id => $products)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div style="float: left; margin-right:10px" class="col-md-2">
                                <img src="images/{{ $products['image'] }}" alt="{{ $products['name'] }}" width="50px">
                            </div>
                            <div class="col-md-10">
                                <strong class="my-0">{{ $products['name'] }} <small class="itemQuantity">{{ $products['quantity'] }}x</small></strong>
                                <small class="text-muted" style="display: block">{{ $products['details'] }}</small>
                                <span class="text-muted">${{ $products['sale_price'] * $products['quantity'] }}</span>
                            </div>
                        </li>
                        @php $total = $total + $products['sale_price'] * $products['quantity']; @endphp
                    @endforeach
                @endif

                <li class="list-group-item d-flex justify-content-between">
                  <span>Total (USD)</span>
                  <strong>${{$total}}</strong>
                </li>
              </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>

                <form action="{{ route('add_customer') }}" method="POST" class="needs-validation">
                @csrf

                    <div class="row mb-20">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" name="fname" placeholder="First Name" value="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" name="lname" placeholder="Last Name" value="">
                    </div>
                    </div>

                    <div class="row mb-20">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" value="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" name="email" placeholder="you@example.com" value="">
                        </div>
                    </div>
            
                    <div class="mb-3 mb-20">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address1" placeholder="1234 Main St">
                    </div>
            
                    <div class="mb-3 mb-20">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" name="address2" placeholder="Apartment or suite">
                    </div>
            
                    <div class="row mb-20">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" name="country">
                        <option value="">Choose...</option>
                        <option>United States</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" name="state">
                        <option value="">Choose...</option>
                        <option>California</option>
                        </select>   
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" name="zip" placeholder="Zip Code">
                    </div>
                    </div>

                    <hr class="mb-4 mb-20">

                    <h4 class="mb-3">Payment</h4>
                    <div class="d-block my-3 mb-20">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked >
                        <label class="custom-control-label" for="credit">Credit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input">
                        <label class="custom-control-label" for="debit">Debit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input">
                        <label class="custom-control-label" for="paypal">PayPal</label>
                    </div>
                    </div>
                    <div class="row mb-20">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="">
                    </div>
                    </div>
                    <div class="row mb-20">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" >
                    </div>
                    </div>

                    <hr class="mb-4">
                    
                    <button class="checkout-btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
          </div>
        
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection