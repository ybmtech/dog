@extends('layouts.backend',['title'=>'Dashboard'])

@section('content')
    
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $users }}</h2>
            <span class="desc">Users</span>
            <div class="icon">
                <i class="zmdi zmdi-account-o"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">Dogs</h2>
            <span class="desc">{{ $dogs }}</span>
            <div class="icon">
                <i class="fas fa-table"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $orders }}</h2>
            <span class="desc">Orders</span>
            <div class="icon">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $paid_orders }}</h2>
            <span class="desc">Paid Orders</span>
            <div class="icon">
                <i class="zmdi zmdi-money"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $breed_count }}</h2>
            <span class="desc">All Breeding</span>
            <div class="icon">
                <i class="zmdi zmdi-account-o"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">{{ $admin_breed_count }}</h2>
            <span class="desc">Admin Breeding</span>
            <div class="icon">
                <i class="zmdi zmdi-account-o"></i>
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
          
            <div class="table-responsive table-borderless table-striped table-earning">
                <table class="table">
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
                        @forelse ($order_history as $order)
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
  {{-- user data --}}
  <div class="row">
    <div class="col-xl-12">
        <!-- USER DATA-->
        <div class="user-data m-b-40">
            <h3 class="title-3 m-b-30">
                <i class="zmdi zmdi-account-calendar"></i>Latest Orders</h3>
          
            <div class="table-responsive table-borderless table-striped table-earning">
                <table class="table">
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
                        @forelse ($order_history as $order)
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
        <!-- END USER DATA-->
    </div>
  </div>

    {{-- begin Ready for veterinary DATA--}}
    <div class="row">
        <div class="col-xl-12">
            
            <div class="user-data m-b-40">
                <h3 class="title-3 m-b-30">
                    <i class="zmdi zmdi-account-calendar"></i>Dog Ready To See Veterinary Doctor </h3>
              
                <div class="table-responsive table-borderless table-striped table-earning">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Image</th>
                                 <th>Name</th>
                                 <th>Category</th>
                                 <th>Action</th>
                              </tr>
                        </thead>
                        <tbody>
                            @forelse ($vet_dogs as $dog)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td width="80"><a href="{{ url('/dog_images/'.$dog->image)}}" target="_blank"><img src="{{ url('/dog_images/'.$dog->image)}}" width="80"></a></td> 
                            <td>{{ $dog->name }}</td>
                             <td>{{ $dog->category->name }}</td>
                            <td><button id="{{ $dog->id }}" class="btn btn-primary visit">Visited</button></td>
                     
                          </tr> 
                        @empty
                            
                        @endforelse
                       
                        </tbody>
                    </table>
                </div>
               
            </div>
            <!-- END Ready for veterinary DATA-->
        </div>
      </div>
          {{-- begin Ready for breeding DATA--}}
    <div class="row">
        <div class="col-xl-12">
            
            <div class="user-data m-b-40">
                <h3 class="title-3 m-b-30">
                    <i class="zmdi zmdi-account-calendar"></i>Dog ready for breeding </h3>
              
                <div class="table-responsive table-borderless table-striped table-earning">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Image</th>
                                 <th>Name</th>
                                 <th>Category</th>
                                 <th>Action</th>
                              </tr>
                        </thead>
                        <tbody>
                            @forelse ($breed_dogs as $dog)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td width="80"><a href="{{ url('/dog_images/'.$dog->image)}}" target="_blank"><img src="{{ url('/dog_images/'.$dog->image)}}" width="80"></a></td> 
                            <td>{{ $dog->name }}</td>
                             <td>{{ $dog->category->name }}</td>
                             <td><button id="{{ $dog->id }}" class="btn btn-primary breed">Process</button></td>
                          </tr> 
                        @empty
                            
                        @endforelse
                       
                        </tbody>
                    </table>
                    
                </div>
               
            </div>
        </div>
            <!-- END Ready for breeding DATA-->
    </div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {   

    $("body").on('click','.visit', function(e) {
      $("#visitmodal").modal('show');
        let id = $(this).attr('id');
        $('#id').val(id);
    
    });

    $("body").on('click','.breed', function(e) {
      $("#breedmodal").modal('show');
        let id = $(this).attr('id');
        $('#id2').val(id);
    
    });


});
</script>


@endpush
      @push('modal')
            <!-- begin visit modal -->
			<div class="modal fade" id="visitmodal" tabindex="-1" role="dialog" aria-labelledby="visitmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="visitmodalLabel">Dog visited vetenary doctor</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								Are you sure you this dog has visited vetenary doctor?
							</p>
						</div>
						<div class="modal-footer">
                            <form method="POST" action="{{ route('dog.visited') }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary">Yes</button>
                            </form>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
							
						</div>
					</div>
				</div>
			</div>
			<!-- end visit modal  -->
           
                  <!-- begin breed modal -->
			<div class="modal fade" id="breedmodal" tabindex="-1" role="dialog" aria-labelledby="breedmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="breedmodalLabel">Process Dog For Breeding</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								Are you sure you want to proccess this dog for breeding?
							</p>
						</div>
						<div class="modal-footer">
                            <form method="POST" action="{{ route('dog.breed.process') }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="id2">
                            <button type="submit" class="btn btn-primary">Yes</button>
                            </form>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
							
						</div>
					</div>
				</div>
			</div>
			<!-- end breed modal  -->
@endpush
