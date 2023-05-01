@extends('layouts.backend',['title'=>'Payment History'])

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Payment Histories</h2>
          
        </div>
    </div>
</div>
  {{-- payment data --}}
  <div class="row m-t-25">
    <div class="col-sm-12">
        <div class="table-responsive table--no-card m-b-30">
            <table class="table table-borderless table-striped table-earning" id="example">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                         <th>Reference No</th>
                        <th>Amount</th>
                        <th>Type</th>
                    <th>Date</th>
                       </tr>
                </thead>
                <tbody>
                    @forelse ($histories as $history)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $history->user->name }}</td>
                        <td>{{ $history->reference_no }}</td>
                        <td>₦{{ number_format($history->amount,2) }}</td>
                         <td>{{ $history->type }}</td>
                         <td>{{ $history->created_at }}</td>
                          
                      </tr> 
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
  </div>
        <!-- END Payment DATA-->
    </div>
  </div>
@endsection

