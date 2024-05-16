@extends('layout.main')
@section('title')
<title> Redeem Points </title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3> Redeem </h3>
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
@if(Session::has('error'))
    <div class="alert alert-danger mx-3 mt-3" role="alert">
        {{ Session::get('error') }}
    </div>
@endif
      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Prize List</h2>
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
				@if(auth()->user()->role == 'admin')
                <div class="float-right mb-3">
                    <a data-toggle="modal" data-target="#addPrize" class="btn btn-success btn-sm ">
                      <i class="fa fa-plus"></i>Input Data Prizes
                    </a>
                  </div>
				@endif
              <div class="row">

                @foreach ($redeem as $item)
                <div class="col-md-55">
                    <div class="thumbnail">
                      <div class="image view view-first">
                        <img style="width: 100%; display: block;" src="{{asset('prize/'.$item->url_foto)}}" alt="image" />
                        <div class="mask">
                          <p>{{$item->judul}}</p>
                        </div>
                      </div>
                      <div class="caption">
                    
                        <p style="font-size:10px">{{$item->deskripsi}}</p>
                        <span>Redeem : {{$item->point}} points</span>
                        <form action="{{route('redeem-confirmation.store')}}" method="post" onsubmit="return confirm('Yakin redeem point?')" style="display:inline">
                          @csrf
                          <input type="text" name="prize" value="{{$item->id}}" style="display:none">
                          <input type="text" name="agent" value="{{auth()->user()->id}}" style="display:none">
                          <button class="btn btn-info btn-sm ml-3" {{auth()->user()->point >= $item->point ? '' : 'disabled'}}>
                            Redeem
                          </button>
                        </form></td>
                      </div>
                    </div>
                  </div>
                @endforeach
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

<!-- modal upload -->
<div id="addPrize" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Add Prize</h4>
      </div>
      <div class="modal-body">
        <div id="testmodal" style="padding: 5px 20px;">
          <form class="form-horizontal form-label-left" action="{{route('redeem.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group" >
                <label class="col-sm-3 control-label">Product's Title</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="file" name="judul" required>
                </div>
              </div>
              <div class="form-group" >
                <label class="col-sm-3 control-label">Product's Description</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="file" name="deskripsi" required>
                </div>
              </div>
              <div class="form-group" >
                <label class="col-sm-3 control-label">Product's Points</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="file" name="point" required>
                </div>
              </div>
            <div class="form-group" >
              <label class="col-sm-3 control-label">Product's Photo</label>
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
