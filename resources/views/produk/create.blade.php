@extends('layout.main')
@section('title')
<title> Input Product</title>
@endsection

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Input Product</h3>
            </div>
            
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        
                        <form class="form-horizontal form-label-left" action="{{route('produk.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <span class="section">Product Info</span>
                            
                            <!--<div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="password" class="control-label col-md-3">Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>-->
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Group/Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="judul" class="form-control col-md-7 col-xs-12" name="judul" required="required" type="text">
                                </div>
                            </div>
							<div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Country <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="country" class="form-control col-md-7 col-xs-12" name="country" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Code <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="kode" name="kode" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Poster</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" class="form-control" name="file" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Itinerary Document</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" class="form-control" name="file_iti" >
                                </div>
                            </div>
                            <span class="section">Itinerary</span>
                            <div class="row" id="add_after_me">
                                <div class="float-right" style="float:right">
                                    <button type="button" name="add" id="add" class="btn btn-success my-4" onclick="addCode()">Add Item</button>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Day-</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="hari[]" required>
                                            <option value="">Choose option</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="lokasi" name="lokasi[]" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea class="form-control" rows="3" name="deskripsi[]" placeholder='' required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Meal</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <p style="color: white">
                                            <input type="checkbox" name="br[]" id="meal" value="breakfast"  class="flat"/> Breakfast
                                            <input type="checkbox" name="lun[]" id="meal" value="lunch" class="flat" /> Lunch
                                            <input type="checkbox" name="din[]" id="meal" value="dinner" class="flat" /> Dinner
                                        </p>
                                    </div>  
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Flight Detail</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="lokasi" name="flight[]" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                            </div>
                            <span class="section">Inclusion & Exclusion</span>
                            <div class="row">
                                <div class="col-md-12 center-margin">
                                    <div class="form-group col-md-7">
                                        <label>Inclusion</label>
                                        <textarea class="form-control" rows="3" name="inclusion" placeholder='' required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 center-margin" id="add_again">
                                    <div class="form-group col-md-3">
                                        <label>Exclusion</label>
                                        <input type="text" class="form-control" name="exclusion[]">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Exclusion Rate</label>
                                        <input type="number" class="form-control" name="exclusion_rate[]">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Exclusion Type</label>
                                        <select class="form-control" name="exclusion_type[]" required>
                                            <option value="">Choose option</option>
                                            <option value="mandatory">Mandatory</option>
                                            <option value="optional">Optional</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <button type="button" name="add" id="add" class="btn btn-success " onclick="addAgain()">Add Item</button>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary">Cancel</button>
                                    <button id="send" type="submit" class="btn btn-success">Submit</button>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">
    
    var i = 0;
    function addCode() {
        ++i;
        document.getElementById("add_after_me").insertAdjacentHTML("afterend",
        '<div class="row" id="add_after_me"><div class="ln_solid"></div><div class="float-right" style="float:right"><button type="button" class="btn btn-danger my-1 remove-input-field" onclick="return this.parentNode.parentNode.remove();">Hapus</button></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Day-</label><div class="col-md-6 col-sm-6 col-xs-12"><select class="form-control" name="hari[]" required><option value="">Choose option</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="lokasi" name="lokasi[]" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label><div class="col-md-9 col-sm-9 col-xs-12"><textarea class="form-control" rows="3" name="deskripsi[]" required></textarea></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Meal</label><div class="col-md-9 col-sm-9 col-xs-12"><p style="color: white"><input type="checkbox" name="br['+i+']" id="meal" value="breakfast"  class="flat"/> Breakfast<input type="checkbox" name="lun['+i+']" id="meal" value="lunch" class="flat" /> Lunch<input type="checkbox" name="din['+i+']" id="meal" value="dinner" class="flat" /> Dinner</p></div>  </div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Flight Detail</label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="lokasi" name="flight[]" class="form-control col-md-7 col-xs-12"></div></div></div>');
    }
    
    
</script>
<script type="text/javascript">
    
    var x = 0;
    function addAgain() {
        ++x;
        document.getElementById("add_again").insertAdjacentHTML("afterend",
        '<div class="col-md-12 center-margin add_again"><div class="form-group col-md-3"><label>Exclusion</label><input type="text" class="form-control" name="exclusion['+x+']"></div><div class="form-group col-md-4"><label>Exclusion Rate</label><input type="number" class="form-control" name="exclusion_rate['+x+']"></div><div class="form-group col-md-4"><label>Exclusion Type</label><select class="form-control" name="exclusion_type['+x+']" required><option value="">Choose option</option><option value="mandatory">Mandatory</option><option value="optional">Optional</option></select></div><div class="float-right col-md-1" ><button type="button" class="btn btn-danger my-1 remove-input-field" onclick="return this.parentNode.parentNode.remove();">Hapus</button></div></div>');
    }
    
    
</script>
@endsection
