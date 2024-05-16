    @extends('layout.main')
    @section('title')
    <title> Edit Admin </title>
    @endsection

    @section('content')
         <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
          <div style="background-color:#1D441F">
            <div  style="background-color:#1D441F; padding:20px">
              <h3 style="color:white">Edit Admin</h3>
            </div>
          </div>
       

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">

                  <form class="form-horizontal form-label-left" action="{{route('admin.update', $admin->id)}}" method="post">
					@method('patch')
                    @csrf
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" name="nama" value="{{$admin->nama}}" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Address <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="address" required="required" name="alamat" class="form-control col-md-7 col-xs-12">{{$admin->alamat}}</textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Department <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nomor_kantor" name="divisi" required="required" value="{{$admin->divisi}}" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Phone Number <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="hp" type="text" name="hp" value="{{$admin->hp}}" class="optional form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="ln_solid"></div>
					   
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Cancel</button>
                        <button id="submit-btn" type="submit" class="btn btn-success" >Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- /page content -->
    @endsection
   