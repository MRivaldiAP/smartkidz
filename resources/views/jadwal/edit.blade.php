@extends('layout.main')
@section('title')
<title> Edit Schedule</title>
@endsection

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Schedule</h3>
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
                        
                        <form class="form-horizontal form-label-left" action="{{route('jadwal.update', $jadwal->id)}}" method="post">
                            @method('put')
                            @csrf
                            <span class="section">Schedule Info</span>
                            
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Group/Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="produk_id" required>
                                        <option value="">Choose option</option>
                                        @foreach ($produk as $item)
                                        <option value="{{$item->id}}" {{$jadwal->produk_id == $item->id ? 'selected' : ''}}>{{$item->judul}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Date <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <!--<input class="form-control" type="text" name="daterange" value="$pre" />-->
                                    <input type="date" name="daterange" id="daterange" class="form-control date" value="{{$jadwal->tanggal}}">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Airlines <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="text" name="airlines"  value="{{$jadwal->airlines}}"/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Adult <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="number" name="dewasa" value="{{$jadwal->dewasa}}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Single Pax <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="number" name="single" value="{{$jadwal->single}}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Child With Bed <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="number" name="cwb" value="{{$jadwal->cwb}}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Child No Bed <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="number" name="cwob" value="{{$jadwal->cwob}}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Infant <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="number" name="infant" value="{{$jadwal->infant}}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Total Allotment <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="number" name="allotment" value="{{$jadwal->allotment}}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Min Departure<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="number" name="min_departure" value="{{$jadwal->min_departure}}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Min Deposit<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="number" name="min_deposit" value="{{$jadwal->min_deposit}}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Starting From<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="text" name="starting" value="{{$jadwal->starting}}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Agent Comission<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="number" name="commission"  value="{{$jadwal->commission}}"/>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Loyalty Point<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="number" name="point" value="{{$jadwal->point}}" />
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Status<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="status" required>
                                        <option value="">Choose option</option>
                                        <option value="open" {{$jadwal->status == 'open' ? 'selected' : ''}}>Open</option>
                                        <option value="ad" {{$jadwal->status == 'ad' ? 'selected' : ''}}>Almost Definite</option>
                                        <option value="def" {{$jadwal->status == 'def' ? 'selected' : ''}}>Definite</option>
                                        <option value="less" {{$jadwal->status == 'less' ? 'selected' : ''}}>Less Than 10</option>
                                        <option value="closed" {{$jadwal->status == 'closed' ? 'selected' : ''}}>Closed</option>
                                    </select>
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
<script>
    function myFunction() {
        document.getElementById("daterange").disabled = true;
    }
    
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
    
    var i = 0;
    function addCode() {
        ++i;
        document.getElementById("add_after_me").insertAdjacentHTML("afterend",
        '<div class="row" id="add_after_me"><div class="ln_solid"></div><div class="float-right" style="float:right"><button type="button" class="btn btn-danger my-1 remove-input-field" onclick="return this.parentNode.parentNode.remove();">Hapus</button></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Day-</label><div class="col-md-6 col-sm-6 col-xs-12"><select class="form-control" name="hari['+i+']" required><option value="">Choose option</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="lokasi" name="lokasi['+i+']" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label><div class="col-md-9 col-sm-9 col-xs-12"><textarea class="form-control" rows="3" name="deskripsi['+i+']" required></textarea></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Meal</label><div class="col-md-9 col-sm-9 col-xs-12"><p style="color: white"><input type="checkbox" name="br['+i+']" id="meal" value="breakfast"  class="flat"/> Breakfast<input type="checkbox" name="lun['+i+']" id="meal" value="lunch" class="flat" /> Lunch<input type="checkbox" name="din['+i+']" id="meal" value="dinner" class="flat" /> Dinner</p></div>  </div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Flight Detail</label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="lokasi" name="flight['+i+']" class="form-control col-md-7 col-xs-12"></div></div></div>');
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

<script>
    //$(function() {
        //$('input[name="daterange"]').daterangepicker();
        //});
        
        $('.date').datepicker({
            multidate: true,
            format: 'dd-mm-yyyy'
        });
        
</script>
    

    @endsection
    