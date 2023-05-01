@extends('layouts.backend',['title'=>'Orders'])

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">

            <h2 class="title-1">Orders</h2>
          
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
                         <th>Category</th>
                         <th>Price</th>
                         <th>Date</th>
                      </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td width="80"><a href="{{ url('/dog_images/'.$order->dog->image)}}" target="_blank"><img src="{{ url('/dog_images/'.$order->dog->image)}}" width="80"></a></td> 
                        <td>{{ $order->dog->name }}</td>
                         <td>{{ $order->dog->category->name }}</td>
                         <td>₦{{ number_format($order->price,2) }}</td>
                         <td>{{ $order->created_at }}</td>
                      </tr> 
                    @empty
                        
                    @endforelse
                    
                  
                   
                </tbody>
            </table>
          
        </div>
    </div>
  </div>
        <!-- END order DATA-->
    </div>
  </div>
@endsection


    
