@extends('layouts.userpage')
@section('pageTitle', 'Reciept')
@section('content')<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="invoice printableArea">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
          <span class="text-danger"><small class="font-weight-600">Receipt ID: <span style="color:blue">{{ $receipt->consignment_id }}</span> 
          <small class="pull-right">Date Generated: {{ \Carbon\Carbon::createFromTimeStamp(strtotime($receipt->created_at))->toFormattedDateString() }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row align-items-center invoice-info">
        <div class="col-md-6 invoice-col">
          From:<br>
          <address>
            <strong class="text-info">{{ $receipt->sender_name }}</strong><br><br>
            Address: <b>{{ $receipt->sender_address }}</b><br><br>
            Phone: <b>{{ $receipt->sender_phone }}</b><br><br>
            Email: <b>{{ $receipt->sender_email }}</b>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-md-6 invoice-col">
          To:<br>
          <address>
            <strong class="text-primary">{{ $receipt->reciever_name }}</strong><br>
            Address: <b>{{ $receipt->reciever_address }}</b><br><br>
            Phone: <b>{{ $receipt->reciever_phone }}</b><br><br>
            Email: <b>{{ $receipt->reciever_email }}</b>
          </address>
        </div>
        <!-- /.col -->
        <div class="col invoice-col">
    			<div class="invoice-details row no-margin bg-dark">
    			  <div class="col-md-6 col-lg-3"><b>Consignment ID:</b>{{ $receipt->consignment_id }}</div>
    			  <div class="col-md-6 col-lg-3"><b>Generated by:</b> {{ $receipt->sender_state_represenative_name  }} Reperesentative</div>
    			  <div class="col-md-6 col-lg-3"><b>Email:</b> {{ $receipt->sender_state_represenative_email  }}</div>
    			  <div class="col-md-6 col-lg-3"><b>Phone:</b> {{ $receipt->sender_state_represenative_phone  }}</div>
    			</div>
    		</div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr class="bg-pale-dark">
              <th>Item</th>
              <th>Description</th>
              <th class="text-right">Category</th>
              <th class="text-right">Weight</th>
              <th class="text-right">Size</th>
              <th class="text-right">Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>{{ $receipt->title }}</td>
              <td>
               {{ $receipt->description }}
                
              </td>
              <td>{{ $receipt->consignment_id }}</td>
              <td class="text-right">{{ $cattitle }}</td>
              <td class="text-right">{{ $weightname }}</td>
              <td class="text-right">{{ $sizename }}</td>
              <td class="text-right">
                @if($receipt->payment_status==0)
                  @if($receipt->price==NULL)
                    N {{ $totalprice }} <a class="btn btn-info" href="#" data-toggle="modal" data-target="#pricemodal">Edit Price</a>
                  @else
                   N {{$receipt->price}} <a class="btn btn-info"  href="#" data-toggle="modal" data-target="#pricemodal">Edit Price</a>
                  @endif
                @else
                  N {{$receipt->price}}
                @endif
               </td>

              
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>

      <hr>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-12">
          <button id="print" class="btn btn-warning pull-right" type="button" style="float: right;"> <span><i class="fa fa-print"></i> Print</span> </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

@endsection