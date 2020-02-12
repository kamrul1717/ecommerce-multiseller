@extends('layouts.app')

@section('content')

    <h2>Your Cart</h2>

    <table class="table">
        <thead>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>
                    {{ Cart::session(auth()->id())->get($item->id)->getPriceSum() }}
                </td>
                <td>
                    <form action="{{ route('cart.update', $item->id) }}">
                        <input type="number" name="quantity" value="{{ $item->quantity }}">
                        <input type="submit" value="Save">
                    </form>
                </td>
                <td>
                    <a href="{{ route('cart.destroy', $item->id) }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Price : $ {{ Cart::session(auth()->id())->getTotal() }}</h3>

    <a href="{{ route('cart.checkout') }}" class="btn btn-primary" role="button">Proceed to Checkout</a>

@endsection
