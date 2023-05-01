@extends('layouts.frontend',['title'=>'Carts'])

@section('content')
  <!-- About Start -->
  <div class="container py-5">
    <div class="row py-5">
        <h3 class="text-secondary text-center">Cart</h3>
        <div class="col-lg-12 pb-5 pb-lg-0 px-3 px-lg-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Image</th>
                         <th>Name</th>
                        <th>Quantity</th>
                         <th>Price</th>
                      <th>Action</th>
                      </tr>
                </thead>
                <tbody>
                    @forelse ($carts as $cart)
              <tr>
              <td>{{ $loop->iteration }}</td>  
              <td width="80"><a href="{{ url('/dog_images/'.$cart->attributes->image)}}" target="_blank"><img src="{{ url('/dog_images/'.$cart->attributes->image)}}" width="80"></a></td> 
               <td>{{ $cart->name }}</td>  
              <td>{{ $cart->quantity }}</td>  
              <td>₦{{ number_format($cart->price,2) }}</td>  
               
                  <td>
                	<form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" value="{{ $cart->id }}" name="id">
                       
          <button type="submit" class="btn btn-primary">Remove</button>
                    </form>
            </td>  
              </tr>    
              @empty
                  
              @endforelse
              @if($total !== 0)
              <tr>
                <td colspan="5" align="right">Total</td>
                <td colspan="2">₦{{ number_format($total,2) }}</td>
              </tr>
              @endif
                </tbody>
            </table>
            <form action="{{ route('order.save') }}" method="post">
              @csrf
              <textarea class="form-control" name="address" id="address" placeholder="Delivery Address"></textarea>
              @error('address')
              <span class="text-danger">{{ $message }}</span>
          @enderror
              <br><br>
                <input type="hidden" name="dog_id" value="">
                <button type="submit" class="btn btn-primary btn-block p-3" style="border-radius: 0;">Checkout</button>
 
            </form>
        </div>
    </div>
</div>
<!-- About End -->
@endsection