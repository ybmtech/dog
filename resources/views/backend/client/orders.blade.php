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
                        <th>Invoice No</th>
                         <th>Total</th>
                        <th>Status</th>
                         <th>Payment Status</th>
                         <th>Delivery Fee</th>
                         <th>Date</th>
                      <th>Action</th>
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
                         <td>
                            <a href="{{ route('order.items',$order->invoice_no) }}" class="btn btn-warning">Details</a>
                           @if($order->status=="pending" || $order->status=="processing")
                            <button class="btn btn-danger deleterow" id="{{ $order->id }}">Cancel</button>
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
        <!-- END ORDER DATA-->
    </div>
  </div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
      
    $('#example').DataTable();
    
    $("body").on('click','.deleterow', function(e) {
      $("#deletemodal").modal('show');
        let id = $(this).attr('id');
        $('#id').val(id);
    
    });


});
</script>


@endpush
@push('modal')
            <!-- begin cancel modal -->
			<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="deletemodalLabel">Cancel Order</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								Are you sure you want to cancel this order
							</p>
						</div>
						<div class="modal-footer">
                            <form method="POST" action="{{ route('order.cancel') }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-primary">Yes</button>
                            </form>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
							
						</div>
					</div>
				</div>
			</div>
			<!-- end cancel modal  -->
           
                
@endpush

