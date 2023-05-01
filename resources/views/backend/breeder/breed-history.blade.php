@extends('layouts.backend',['title'=>'Breed History'])

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">

            <h2 class="title-1">Breed Histories</h2>
          
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
                         <th></th>
                         <th>Image</th>
                         <th>Name</th>
                         <th>Reward</th>
                         <th>Amount Paid</th>
                         <th>Status</th>
                         <th>Reward Status</th>
                         <th>Action</th>
                      </tr>
                </thead>
                <tbody>
                    @forelse ($histories as $history)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td width="50"><a href="{{ url('/dog_images/'.$history->first_dog->image)}}" target="_blank"><img src="{{ url('/dog_images/'.$history->first_dog->image)}}" width="50"></a></td> 
                        <td>{{ $history->first_dog->name }} {{ $history->fdog_user_id==auth()->user()->id ? "(Mine)" : "" }}</td>

                        <td><span class="fas fa-arrow-right"></span></td>
                    
                        <td width="50"><a href="{{ url('/dog_images/'.$history->second_dog->image)}}" target="_blank"><img src="{{ url('/dog_images/'.$history->second_dog->image)}}" width="50"></a></td> 
                        <td>{{ $history->second_dog->name }} {{ $history->sdog_user_id==auth()->user()->id ? "(Mine)" : "" }}</td>
                        <td>{{ $history->reward }}</td>
                        <td>{{ $history->reward=="puppy" ? "-" : number_format($history->amount_paid,2) }}</td>
                        <td>{{ ucwords($history->status) }}</td>
                        <td>{{ ucwords($history->reward_status) }}</td>
                        <td>
                            @if($history->sdog_user_id==auth()->user()->id && $history->status=="pending")
                            <button class="btn btn-danger status" id="{{ $history->id }}">Breed Action</button>
                            @endif
                            @if($history->sdog_user_id==auth()->user()->id && $history->status=="accept" && $history->reward_status=="not fulfilled" )
                            <button class="btn btn-primary fulfil" id="{{ $history->id }}">Reward Fulfilled</button>
                            @endif
                            @if($history->fdog_user_id==auth()->user()->id && $history->status=="accept" && $history->reward=="payment" && $history->amount!==null && $history->amount_paid==null)
                            <a href="{{ route('reward.fee.payment',str_shuffle('0123456789').$history->id) }}" class="btn btn-primary pay" >Pay {{ number_format($history->amount,2) }}</a>
                            @endif
                            @if($history->sdog_user_id==auth()->user()->id && $history->reward=="payment" && $history->amount==null)
                            <button class="btn btn-danger primary fee" id="{{ $history->id }}">Reward Fee</button>
                          
                            @endif
                            @if($history->fdog_user_id==auth()->user()->id)
                            <button class="btn btn-warning detail" data-name="{{ $history->second_user->name }}" data-phone="{{ $history->second_user->phone }}" data-email="{{ $history->second_user->email }}">Breeder Info</button>
                            @else
                            <button class="btn btn-warning detail" data-name="{{ $history->first_user->name }}" data-phone="{{ $history->first_user->phone }}" data-email="{{ $history->first_user->email }}">Breeder Info</button>
                         
                            @endif
                        </td>
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

@push('scripts')
<script>
$(document).ready(function() {   

    $("body").on('click','.detail', function(e) {
      $("#detailmodal").modal('show');
        let name = $(this).data('name');
        let phone = $(this).data('phone');
        let email = $(this).data('email');
        $('#name').text(name);
        $('#phone').text(phone);
        $('#email').text(email);
    });

    $("body").on('click','.status', function(e) {
      $("#statusmodal").modal('show');
        let id = $(this).attr('id');
        $('#id').val(id);
    
    });

    $("body").on('click','.fulfil', function(e) {
      $("#fulfilmodal").modal('show');
        let id = $(this).attr('id');
        $('#id2').val(id);
    
    });

    $("body").on('click','.fee', function(e) {
      $("#feemodal").modal('show');
        let id = $(this).attr('id');
        $('#id3').val(id);
    
    });

    
});
</script>


@endpush
      @push('modal')
            <!-- begin detail modal -->
			<div class="modal fade" id="detailmodal" tabindex="-1" role="dialog" aria-labelledby="detailmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="detailmodalLabel">Breeder Information</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>Name: <span id="name"></span></p>
							<p>Phone: <span id="phone"></span></p>
							<p>Emai: <span id="email"></span></p>
							
						</div>
						<div class="modal-footer">
                            
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							
						</div>
					</div>
				</div>
			</div>
			<!-- end detail modal  -->
           
                  <!-- begin status modal -->
			<div class="modal fade" id="statusmodal" tabindex="-1" role="dialog" aria-labelledby="statusmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="statusmodalLabel">Change Breeding Status</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
                            <form method="POST" action="{{ route('breed.action') }}">
                                @csrf
                                @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="status">Status</label>
                                <div class="col-sm-10">
                                  <select class="form-control" name="status" id="status" required>
                                    <option value="" selected disabled>Select</option>
                                    <option value="accept">Accept</option> 
                                    <option value="reject">Reject</option> 
                                    </select>
                                 </div>
                            
                              </div>
						</div>
						<div class="modal-footer">
                                 <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary">Change</button>
                            </form>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							
						</div>
					</div>
				</div>
			</div>
			<!-- end status modal  -->

                    <!-- begin fulfil modal -->
			<div class="modal fade" id="fulfilmodal" tabindex="-1" role="dialog" aria-labelledby="fulfilmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="fulfilmodalLabel">Reward Fulfilled</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
                            <p>Are you sure the breeding reward has been fulfilled</p>
                           
						</div>
						<div class="modal-footer">
                            <form method="POST" action="{{ route('reward.fulfil') }}">
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
			<!-- end fulfil modal  -->
            <!-- begin status modal -->
			<div class="modal fade" id="feemodal" tabindex="-1" role="dialog" aria-labelledby="feemodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="feemodalLabel">Breeding Reward Fee</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
                            <form method="POST" action="{{ route('reward.fee') }}">
                                @csrf
                                @method('PUT')
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="fee">Fee</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="fee" id="fee" required>
                                  
                                 </div>
                            
                              </div>
						</div>
						<div class="modal-footer">
                                 <input type="hidden" name="id" id="id3">
                            <button type="submit" class="btn btn-primary">Set</button>
                            </form>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							
						</div>
					</div>
				</div>
			</div>
			<!-- end fee modal  -->

@endpush


    
