@extends('layout.main')
@section('title')
<title> My Booking </title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>My Booking</small></h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
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
            <h2>Total Bill : Rp {{str_replace(',','.',number_format($bill))}}</h2>
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
            <div class="float-right mb-3">
                <h3 style="color: #73879C"></h3>
              </div>
            
            <table id="datatable-buttons" class="table table-light table-bordered">
              <thead style="color: #73879C">
                <tr>
                  <th>No.</th>
					        <th>Booking Code</th>
                  <th>Group</th>
                  <th>Departure </th>
                  <th>Starting</th>
                  <th>Airlines</th>
                  <th>Allotment</th>
                  <th>Remaining Payment</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody style="color: #73879C">
                @foreach ($booking as $item)
                <tr>
                  <td>{{$loop->iteration}} </td>
					        <td>{{$item->kode_booking ?? '--'}} <a href="{{url('booking/invoice/'.$item->id)}}" style="color: blue">(View)</a>
                  </a></td>
                  <td>{{$item->jadwal->produk->judul}} </td>
                  <td>{{$item->jadwal->tanggal}}</td>
                  <td>{{$item->jadwal->starting}}</td>
                  <td>{{$item->jadwal->airlines}}</td>
                  <td>{{count(unserialize($item->dewasa)) + count(unserialize($item->cwb)) + count(unserialize($item->cwob))}}</td>
			  @if(now()->gt(\Carbon\Carbon::parse($item->jadwal->tanggal)->subDays(15)) && now()->lt(\Carbon\Carbon::parse($item->jadwal->tanggal)) && $item->status != 'cancel' && $item->paid < $item->total)
			  	  @if ($item->total - $item->paid > 0)
                  <td>Rp {{str_replace(',','.',number_format($item->total - $item->paid))}} <span style="color:orange"> OVERDUE </span> <a href="{{url('my-booking/pay/'.$item->id)}}" style="color: blue">(Pay)</a>
                  </td>
                  @else
                  <td>Rp {{str_replace(',','.',number_format($item->total - $item->paid))}} <span style="color:orange"> OVERDUE </span></td>
                  @endif
			  @elseif ((now()->gt(\Carbon\Carbon::parse($item->jadwal->tanggal)) && $item->paid < $item->total) || $item->status == 'cancel')
                  <td>Rp {{str_replace(',','.',number_format($item->total - $item->paid))}} <span style="color:red"> CANCELLED </span></td>
			  @else
                  @if ($item->total - $item->paid > 0)
                  <td>Rp {{str_replace(',','.',number_format($item->total - $item->paid))}} <a href="{{url('my-booking/pay/'.$item->id)}}" style="color: blue">(Pay)</a>
                  </td>
                  @else
                  <td>Rp {{str_replace(',','.',number_format($item->total - $item->paid))}}</td>
                  @endif
               @endif
                  <td>
                    <a href="{{url('my-booking/'.$item->id.'/edit')}}" role="button" class="btn btn-success btn-sm">
                      <i class="fa fa-pen"></i>Edit
                    </a>
                  </td>
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
