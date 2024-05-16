@extends('layout.main')
@section('title')
<title> Allotment Details - {{$produk->judul}} Departure : {{$jadwal->tanggal}} </title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Allotment Details - {{$produk->judul}} Departure : {{$jadwal->tanggal}}</small></h3>
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
    <form action="{{url('booking/invoice/xxx')}}" method="post" onsubmit="return confirm('Attention : This action can not be undone, are you sure you want to continue?')" style="display:inline">
      @csrf
		@method('get')
      <input type="text" name="kode" placeholder="Input Booking ID">
      <button class="btn btn-danger btn-sm ml-3">
        Cancel Booking
      </button>
    </form>
    <div class="row">
      @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
      @endif
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
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
				  <th>Booking ID</th>
                  <th>Agent</th>
                  <th>Title </th>
                  <th>Name</th>
                  <th>Birth</th>
                  <th>Passport</th>
                  <th>Passport Expiration</th>
                  <th>Status</th>
				  <th>Remark</th>
                  <th>Type</th>
                  <th></th>
                </tr>
              </thead>
              <tbody style="color: #73879C">
                @foreach ($list as $item)
                <tr>
                  <td>{{$loop->iteration}}</td>
				  <td>{{$item['kode'] ?? '--'}}</td>
                  <td>{{$item['agent']}}</td>
                  <td>{{$item['title']}}</td>
                  <td>{{$item['nama']}}</td>
                  <td>{{$item['lahir']}}</td>
				  <td>{{$item['no_passport']}} 
					  @if(isset($item['url_passport']))
					  <a href="{{asset('foto-passport/'.$item['url_passport'])}}"><span style="color:blue">(view)</span></a>
					  @else
					  N/A
					  @endif
				  </td>
                  <td>{{$item['exp_passport']}}</td>
                  <td style="background-color:{{$item['status'] == 'Payment Completed' ? 'green' : 'red'}};color:white">{{$item['status']}}</td>
				  <td>{{$item['remark']}}</td>
                  <td>{{$item['type']}}</td>
                  <td>
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
