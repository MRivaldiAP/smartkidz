@extends('layout.main')
@section('title')
<title> Schedule </title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Schedule</small></h3>
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
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
      @endif
      @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
      @endif
    <form action="{{url('my-booking/pay-at-counter')}}" method="post" onsubmit="return confirm('Attention : This action can not be undone, are you sure you want to continue?')" style="display:inline">
      @csrf
      <input type="text" name="kode" placeholder="Input Booking ID">
      <button class="btn btn-warning btn-sm ml-3">
        Paid at Counter
      </button>
    </form>
    <div class="row">
      
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Schedules List</h2>
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
                <a href="{{route('jadwal.create')}}" class="btn btn-success btn-sm ">
                  <i class="fa fa-plus"></i> Input Schedule
                </a>
            <table id="datatable-buttons" class="table table-light table-bordered">
              <thead style="color: #73879C">
                <tr>
                  <th>No.</th>
                  <th>Group</th>
                  <th>Departure </th>
                  <th>Starting</th>
                  <th>Airlines</th>
                  <th>Prices</th>
                  <th>Agent Commision</th>
                  <th>Allotment</th>
                  <th>Edit Limit</th>
                  <th>Registered Allotment</th>
                  <th></th>
                </tr>
              </thead>
              <tbody style="color: #73879C">  
                @foreach ($jadwal as $item)
				  @php
                
                $alt = 0;
                if(now()->gt(\Carbon\Carbon::parse($item->tanggal))){
                  $bookings = $item->booking->where('status', '<>', 'cancel')->filter(function ($booking) {
                    return $booking->paid >= $booking->total;
                  });
                  
                  foreach($bookings as $it) {
                    $alt += count(unserialize($it->dewasa)) + count(unserialize($it->cwb)) + count(unserialize($it->cwob));
                  };
                  
                } else {
                  $bookings = $item->booking->where('status', '<>', 'cancel');
                  foreach($bookings as $it) {
                    $alt += count(unserialize($it->dewasa)) + count(unserialize($it->cwb)) + count(unserialize($it->cwob)); 
                  };
                }
                @endphp
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->produk->judul}}</td>
                  <td>{{$item->tanggal}}</td>
                  <td>{{$item->starting}}</td>
                  <td>{{$item->airlines}}</td>
                  <td>{{str_replace(',','.',number_format($item->dewasa))}}</td>
                  <td>{{str_replace(',','.',number_format($item->commission))}}</td>
                  <td>{{$item->allotment}}</td>
                  <td><input class="form-control" type="date"  data-id="{{$item->id}}" name="edit_limit" id="approval" value="{{$item->edit_limit ?? ''}}" /></td>
                  <td>{{$alt}} <a href="{{url('jadwal/details/'.$item->id)}}" style="color: blue">(see details)</a></td>
                  <td>
                    <a href="{{url('jadwal/'.$item->id.'/edit')}}" role="button" class="btn btn-success btn-sm">
                      <i class="fa fa-pen"></i>Edit
                    </a>
                    <form action="{{url('jadwal/'.$item->id)}}" method="post" onsubmit="return confirm('Yakin hapus data?')" style="display:inline">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger btn-sm ml-3">
                        <i class="fa fa-trash"></i>Hapus
                      </button>
                    </form>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script>
  $(document).ready(function() {
      $(document).on('change', '#approval', function(e) {
          var id = $(this).data('id');
          var status = $(this).val();
          var token = '{{ csrf_token() }}';
          SwalDelete(id, status, token);
      });
  });
  
  function SwalDelete(id, status, token) {
      Swal.fire({
          title: 'Are you sure?',
          text: "This Change Wil Take Effect",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes',
          showLoaderOnConfirm: true,
          preConfirm: function() {
              return new Promise(function(resolve) {
                  $.ajax({
                      url: 'jadwal/edit-limit',
                      type: 'POST',
                      data: {'id' : id, 'status' : status, _token: token},
                      dataType: 'json',
                      success: function (data) { 
                          location.reload();   
                          resolve();
                      }
                  });
              });
          },
      });
  }
</script>
@endsection
