@extends('layout.main')
@section('title')
<title> Agent Proposal</title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Proposal List</small></h3>
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Agent Request</h2>
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
                            <a href="" class="btn btn-success btn-sm ">
                                <i class="fa fa-plus"></i>Input Data Agent
                            </a>
                        </div>
                        
                        <table id="datatable-buttons" class="table table-light table-bordered">
                            <thead style="color: #73879C">
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
									<th>Address</th>
                                    <th>Office Number</th>
									<th>Email</th>
                                    <th>PIC</th>
									<th>Designation</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody style="color: #73879C">
                                @foreach ($request as $req)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$req->nama}}</td>
									<td>{{$req->alamat}}</td>
                                    <td>{{$req->nomor_kantor}}</td>
									<td>{{$req->user->email ?? '--'}}</td>
                                    <td>{{$req->pic}}</td>
									<td>{{$req->designation}}</td>
                                    <td>{{$req->hp}}</td>
                                    <td>
                                        <select id='approval' data-id="{{$req->id}}" class="form-control">
                                            <option value="">Select Action</option>
                                            <option id="ISIN1" value="approve" style="background-color: green; color: white"><b>Approve</b></option>
                                            <option id="ISIN2" value="decline" style="background-color: red; color: white"><b>Decline</b></option>
                                        </select>
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
            text: "This Change Can't be Undone!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true,
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: 'request-agent/approval',
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
