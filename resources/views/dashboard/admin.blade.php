@extends('layout.main')
@section('title')
<title> Data Admin </title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Data Admin</small></h3>
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
            <h2>Data Admin</h2>
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
                            <a href="{{route('admin.create')}}" class="btn btn-success btn-sm ">
                                <i class="fa fa-plus"></i> Input Data Admin
                            </a>
                        </div>
            
            <table id="datatable-buttons" class="table table-light table-bordered">
              <thead style="color: #73879C">
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Address</th>
				  <th>Email</th>
                  <th>Division</th>
                  <th>Phone Number</th>
                  <th></th>
                </tr>
              </thead>
              <tbody style="color: #73879C">
                @foreach ($admin as $item)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->alamat}}</td>
				  <td>{{$item->user->email ?? '--'}}</td>
                  <td>{{$item->divisi}}</td>
                  <td>{{$item->hp}}</td>
                  <td>
                    <a href="{{url('admin/'.$item->id.'/edit')}}" role="button" class="btn btn-success btn-sm">
                      <i class="fa fa-pen"></i>Edit
                    </a>
                    <form action="{{url('admin/'.$item->id)}}" method="post" onsubmit="return confirm('Yakin hapus data?')" style="display:inline">
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
@endsection
