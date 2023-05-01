@extends('layouts.backend',['title'=>'Order Item'])

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">

            <h2 class="title-1">Orders #{{ $orders->invoice_no }}</h2>
          
        </div>
    </div>
</div>
  {{-- order data --}}
  <div class="row m-t-25">
    <div class="col-sm-12">
        <div class="table-responsive table--no-card m-b-30">
            <table class="table table-borderless table-striped table-earning" id="example">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Image</th>
                         <th>Name</th>
                        <th>Quantity</th>
                         <th>Price</th>
                      </tr>
                </thead>
                <tbody>
                    @forelse ($orders->order_items as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td width="80"><a href="{{ url('/dog_images/'.$order->dog->image)}}" target="_blank"><img src="{{ url('/dog_images/'.$order->dog->image)}}" width="80"></a></td> 
                        <td>{{ $order->dog->name }}</td>
                         <td>{{ $order->quantity }}</td>
                         <td>₦{{ number_format($order->price,2) }}</td>
                      </tr> 
                    @empty
                        
                    @endforelse
                    
                    <tr>
                        <td colspan="4" align="right">Sub Total</td>
                        <td>₦{{ number_format($orders->total,2) }}</td>
                    </tr>

                    <tr>
                        <td colspan="4" align="right">Delivery Fee</td>
                        <td>₦{{ number_format($orders->delivery_fee,2) }}</td>
                    </tr>

                    <tr>
                        <td colspan="4" align="right">Total</td>
                        <td>₦{{ number_format($orders->total + $orders->delivery_fee,2) }}</td>
                    </tr>

                    <tr>
                        <td colspan="4" align="right">Status</td>
                        <td>{{ strtoupper($orders->payment_status) }}</td>
                    </tr>
                   
                </tbody>
            </table>
            @if($orders->payment_status=="not paid")
            @if($orders->status=="processing")
            <form action="{{ route('order.payment') }}" method="POST">
                @csrf
                <input type="hidden" name="invoice_no" value="{{ $orders->invoice_no }}">
                <button  type="submit" class="btn btn-primary float-right">Pay</button>
            </form>
            @else
             <h4>Order Delivery Fee Not Yet Set</h4>
            @endif
            @endif
        </div>
    </div>
  </div>
        <!-- END order DATA-->
    </div>
  </div>
@endsection


    
