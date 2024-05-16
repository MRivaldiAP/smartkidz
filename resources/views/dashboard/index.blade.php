@extends('layout.main')
@section('title')
<title> Dashboard </title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-calculator"></i></div>
            <div class="count">{{count($bookings)}}</div>
            <h3>Month's Booking</h3>
            
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-comments-o"></i></div>
            <div class="count">{{$tot}}</div>
            <h3>Waiting for Payment</h3>
            
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-gears"></i></div>
            <div class="count">{{count($cancel)}}</div>
            <h3>Cancelled Booking</h3>
            
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-check-square-o"></i></div>
            <div class="count">{{($tat)}}</div>
            <h3>Completed Booking</h3>
            
          </div>
        </div>
      </div>
    
    <div class="clearfix"></div>
    
    <div class="row">
      @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
      @endif
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>Active Reservation</h3>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-buttons" class="table table-light table-bordered">
              <thead style="color: #73879C">
                <tr>
                  <th>No.</th>
					@if(auth()->user()->role == 'admin')
					<th>Agent</th>
					<th>Booking Date</th>
					@endif
                  <th>Book Code</th>
                  <th>Group </th>
                  <th>Flight</th>
                  <th>Date</th>
                  <th>Limit Payment</th>
					<th>Action</th>
					<th></th>
                </tr>
              </thead>
              <tbody style="color: #73879C">
            @foreach ($active as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
				@if(auth()->user()->role == 'admin')
				@php
				$agent = $user->where('id', $item->user_id)->first();
				@endphp
					<td>{{$agent->name}}</td>
				<td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}</td>
					@endif
                <td>{{$item->kode_booking ?? '--'}} <a href="{{url('booking/invoice/'.$item->id)}}" style="color: blue">(View)</a></td>
                <td>{{$item->jadwal->produk->judul ?? '--'}}</td>
                <td>{{$item->jadwal->airlines}}</td>
                <td>{{$item->jadwal->tanggal}}</td>
				@if(now()->gt(\Carbon\Carbon::parse($item->jadwal->tanggal)->subDays(15)->format('Y-m-d')) && $item->paid < $item->total)
                <td>{{ \Carbon\Carbon::parse($item->jadwal->tanggal)->subDays(15)->format('Y-m-d') }}
					<span style="color:orange">OVERDUE</span></td>
				@elseif($item->paid >= $item->total)
				<td style="color:#2196F3">PAID
					</td>
				@else
			<td>{{ \Carbon\Carbon::parse($item->jadwal->tanggal)->subDays(15)->format('Y-m-d') }}
					</td>
				@endif
				<td>
                    <a href="{{url('my-booking/'.$item->id.'/edit')}}" role="button" class="btn btn-success btn-sm">
                      <i class="fa fa-pen"></i>Edit
                    </a>
                  </td>
				<td></td>
              </tr>
				  
            @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<!-- modal upload -->
<div id="upload" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Import Data</h4>
      </div>
      <div class="modal-body">
        <div id="testmodal" style="padding: 5px 20px;">
          <form class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group" >
              <label class="col-sm-3 control-label">Pilih File</label>
              <div class="col-sm-9">
                <input type="file" class="form-control" id="file" name="file" >
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary antosubmit">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /modal upload -->
@endsection
