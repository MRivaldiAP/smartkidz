@extends('layout.main')
@section('title')
<title> Sales Report </title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Report</small></h3>
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
            
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Filter Report</small></h2>
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
                        <br />
                        <form action="{{route('report.index')}}" method="get">
                            @csrf
                            <div class="row mx-2">
                                <div class="form-group col-lg-3 mx-2">
                                    <label class="form-label">Creation From</label>
                                    <input type="date" id="last-name" name="cr_from"  class="form-control col-md-7 col-xs-12" value="{{$inputStartDate ?? ''}}">
                                </div>
                                <div class="form-group col-lg-3 mx-2">
                                    <label class="form-label">To</label>
                                    <input type="date" id="last-name" name="cr_to"  class="form-control col-md-7 col-xs-12" value="{{$inputEndDate ?? ''}}">
                                </div>
                            </div>
                            <div class="row mx-2">
                                <div class="form-group col-lg-3 mx-2">
                                    <label class="form-label">Start Journey From</label>
                                    <input type="date" id="last-name" name="st_from"  class="form-control col-md-7 col-xs-12" value="{{$startJourney ?? ''}}">
                                </div>
                                <div class="form-group col-lg-3 mx-2">
                                    <label class="form-label">To</label>
                                    <input type="date" id="last-name" name="st_to"  class="form-control col-md-7 col-xs-12" value="{{$endJourney ?? ''}}">
                                </div>
                            </div>
                            <div class="row mx-2">
                                <div class="form-group col-lg-3 mx-2">
                                    <button type="submit" class="btn btn-success mt-3">Filter</button>
                                </div>
                            </div> 
                        </form>
                        <form action="{{route('report.index')}}" method="get">
                            @csrf
                            <div class="form-group" style="display:none">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="reset" value="reset">
                                </div>
                            </div>
                            <div class="row mx-2">
                                <div class="form-group col-lg-3 mx-2">
                                    <button type="submit" class="btn btn-success mt-3">Reset Filter</button>
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Sales Report</h2>
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
                                    <th>Travel Agent</th>
                                    <th>Sales </th>
                                    <th>Quantity</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody style="color: #73879C">
								
                                @foreach ($agent as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->where('id', $item[0]->user_id)->first()->name}}</td>
                                    <td>Rp {{number_format($summedAgent[$item[0]->user_id])}}</td>
                                    <td>{{$item->count()}}</td>
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
