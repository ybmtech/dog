@extends('layouts.backend',['title'=>'Dashboard'])

@section('content')
    
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $order }}</h2>
            <span class="desc">Order</span>
            <div class="icon">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $paid_order }}</h2>
            <span class="desc">Paid Order</span>
            <div class="icon">
                <i class="zmdi zmdi-money"></i>
            </div>
        </div>
    </div>
   
</div>

  {{-- user data --}}
  <div class="row">
    <div class="col-xl-12">
        <!-- USER DATA-->
        <div class="user-data m-b-40">
            <h3 class="title-3 m-b-30">
                <i class="zmdi zmdi-account-calendar"></i>Latest Orders</h3>
          
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Invoice No</th>
                             <th>Total</th>
                            <th>Status</th>
                             <th>Payment Status</th>
                             <th>Delivery Fee</th>
                             <th>Date</th>
                          </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>#{{ $order->invoice_no }}</td>
                        <td>₦{{ number_format($order->total,2) }}</td>
                         <td>{{ $order->status }}</td>
                         <td>{{ $order->payment_status }}</td>
                          <td>{{ $order->delivery_fee=="0.00" ? "Not Yet Set" : '₦'.number_format($order->delivery_fee,2) }}</td>
                         <td>{{ $order->created_at }}</td>
                       
                      </tr> 
                    @empty
                        
                    @endforelse
                     </tbody>
                </table>
            </div>
           
        </div>
        <!-- END USER DATA-->
    </div>
  </div>
@endsection
