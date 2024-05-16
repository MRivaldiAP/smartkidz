@extends('layout.main')
@section('title')
<title> Booking </title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3 style="font-family: 'Lucida Console'">BOOKING</small></h3>
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
            <!-- form input mask -->
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="background-color: #1D441F">
                        <h2 style="color: white">Pax Details</h2>
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
                        <form class="form-horizontal form-label-left " action="{{route('booking.step2')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div id="step-1" style="display: none">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Group <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="first-name" required="required" name="judul" value="{{$jadwal->produk->judul}}" readonly class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Schedule<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="jadwal" id="jadwal" class="form-control col-md-7 col-xs-12">
                                            @foreach ($produk->jadwal as $item)
                                            <option value="{{$item->id}}" data-cost="{{$item->dewasa}}" data-cwb="{{$item->cwb}}" data-cwob="{{$item->cwob}}" {{$id == $item->id ? 'selected' : ''}}>{{date('d M Y', strtotime($item->tanggal))}} - {{date('d M Y', strtotime($item->tanggal . ' +'.count(unserialize($produk->itinerary)).' day'))}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Adult</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input id="input1" class="form-control col-md-3 col-xs-12" type="number" name="dewasa" value="{{$dewasa}}">
                                        <div id="error-message-1" style="color: white; background: red"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Child With Bed</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input id="input2" class="form-control col-md-3 col-xs-12" type="number" name="cwb" placeholder="2 - 12 Years (Min 2 Adults)" value="{{$cwb}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Child No Bed</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input id="input3" class="form-control col-md-3 col-xs-12" type="number" name="cwob" placeholder="2 - 12 Years (Min 2 Adults)" value="{{$cwob}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Infant</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input id="input4" class="form-control col-md-3 col-xs-12" type="number" name="infant" placeholder="< 24 Months (Min 1 Adult)" value="{{$infant}}">
                                    </div>
                                </div>
                            </div>
                            <div id="step-2">
                                <div id="agent">
                                    <span class="section">Agent Info</span>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Agent Name<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="first-name" required="required" name="nama_agent" class="form-control col-md-7 col-xs-12" value="{{auth()->user()->name}}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="last-name" name="email_agent" required="required" class="form-control col-md-7 col-xs-12" value="{{auth()->user()->email}}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Phone<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="last-name" name="hp_agent" required="required" class="form-control col-md-7 col-xs-12" value="{{$user->agent->hp ?? '--'}} " disabled>
                                        </div>
                                    </div>
                                </div>
                                <div id="adult">
                                    <span class="section">Adult Customer</span>
                                    @for ($i = 0; $i < $dewasa; $i++)
                                    <div class="" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="title_dewasa[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-adult-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mr">Mr.</option>
                                                    <option value="mrs">Mrs.</option>
                                                    <option value="ms">Ms.</option>
                                                </select>
                                                <div id="error-adult-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" data-step="2" data-error-message="error-adult-nama-'+i+'" name="nama_cust_dewasa[]" required="required" class="form-control col-md-7 col-xs-12">
                                                <div id="error-adult-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                            <div id="error-message" style="color: white; background: red"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_dewasa[]"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_dewasa[]"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_dewasa[]"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Upload </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" id="last-name" name="file_dewasa[]"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="remark_dewasa[]"  class="form-control col-md-7 col-xs-12" placeholder="ex: Need wheelchair">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>  
                                    @endfor                                        
                                </div>
                                
                                @if ($cwb > 0)
                                <div id="cwb">
                                    <span class="section">Child With Bed</span>
                                    @for ($i = 0; $i < $cwb; $i++)
                                    <div class="generated-element2" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="title_cwb[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-cwb-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mstr">Mstr.</option>
                                                    <option value="miss">Miss.</option>
                                                </select>
                                                <div id="error-cwb-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="nama_cust_cwb[]" required="required" class="form-control col-md-7 col-xs-12" data-step="2" data-error-message="error-cwb-nama-'+i+'">
                                                <div id="error-cwb-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_cwb[]"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_cwb[]"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_cwb[]" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Upload </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" id="last-name" name="file_cwb[]"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="remark_cwb[]"  class="form-control col-md-7 col-xs-12" placeholder="ex: Need wheelchair">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>
                                    
                                    @endfor
                                </div>  
                                @endif
                                @if ($cwob > 0)
                                <div id="cwob">
                                    <span class="section">Child No Bed</span>
                                    @for ($i = 0; $i < $cwob; $i++)
                                    <div class="generated-element3" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="title_cwob[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-cwob-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mstr">Mstr.</option>
                                                    <option value="miss">Miss.</option>
                                                </select>
                                                <div id="error-cwob-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="nama_cust_cwob[]" required="required" class="form-control col-md-7 col-xs-12" data-step="2" data-error-message="error-cwob-nama-'+i+'">
                                                <div id="error-cwob-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_cwob[]" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_cwob[]" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_cwob[]" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Upload </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" id="last-name" name="file_cwob[]"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="remark_cwob[]"  class="form-control col-md-7 col-xs-12" placeholder="ex: Need wheelchair">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>
                                    
                                    @endfor
                                </div>
                                @endif
                                @if ($infant > 0)
                                <div id="cwob">
                                    <span class="section">Infant</span>
                                    @for ($i = 0; $i < $infant; $i++)
                                    <div class="generated-element3" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="title_infant[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-cwob-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mstr">Mstr.</option>
                                                    <option value="miss">Miss.</option>
                                                </select>
                                                <div id="error-cwob-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="nama_cust_infant[]" required="required" class="form-control col-md-7 col-xs-12" data-step="2" data-error-message="error-cwob-nama-'+i+'">
                                                <div id="error-cwob-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_infant[]" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_infant[]" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_infant[]" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Upload </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" id="last-name" name="file_infant[]"  class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="remark_infant[]"  class="form-control col-md-7 col-xs-12" placeholder="ex: Need wheelchair">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>
                                    
                                    @endfor
                                </div>
                                @endif
                                <div id="exclusion">
                                    <span class="section">Exclusion</span>
                                    @foreach ($ex_mandat as $man)
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{$man['exclusion']}} (mandatory)<span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input type="hidden" id="last-name" name="exclusion_rate[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$man['exclusion_rate']}}">
                                            <input type="hidden" id="exclusion_man" name="exclusion[]" required="required" class="form-control col-md-7 col-xs-12 exclusion-man" value="{{$man['exclusion']}}" data-rate="{{$man['exclusion_rate']}}" >
                                            <select name="exclusion[]" id="exclusion" class="form-control col-md-7 col-xs-12" disabled style="display: none;">
                                                <option value="{{$man['exclusion_rate']}}" selected>Include</option>
                                            </select>
                                            <input type="number" id="exclusion_man" name="exclusion_num[]" required="required" readonly class="form-control col-md-7 col-xs-12 exclusion-man" placeholder="Pax amount" value="{{($dewasa + $cwb + $cwob )}}">Rp {{number_format($man['exclusion_rate'])}} /Pax
                                        </div>
                                    </div>
                                    @endforeach
                                    @foreach ($ex_optional as $index => $ops)
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{$ops['exclusion']}}<span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <input type="hidden" id="last-name" name="exclusion[]" required="required" class="form-control col-md-7 col-xs-12 exclusion-ops" value="{{$ops['exclusion']}}" data-rate="{{$ops['exclusion_rate']}}">
                                            <select name="exclusion_rate[]" id="exclusion-above-{{$index}}" data-rate="{{$ops['exclusion_rate']}}" style="display: none;" class="form-control col-md-7 col-xs-12">
                                                <option value="{{$ops['exclusion_rate']}}">Include</option>
                                                <option value="0">Don't Include</option>
                                            </select>
                                            <input type="number" id="exclusion-num-{{$index}}" name="exclusion_num[]" required="required" class="form-control col-md-7 col-xs-12 exclusion-man" placeholder="Pax amount"  value="0">Rp {{number_format($ops['exclusion_rate'])}} /Pax
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    
                                    <button id="send" type="submit" class="btn btn-success">Next</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <!-- /form input mask -->
            
            <!-- form color picker -->
            <div class="col-md-4 col-sm-12 col-xs-12" style="position:sticky !important; top: 0;">
                <div class="x_panel" style="position:sticky !important">
                    <div class="x_title"  style="background-color: #1D441F">
                        <h2 style="color: white">Summary</h2>
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
                    <div class="x_content" style="position:sticky !important">
                        <br />
                        <form class="form-horizontal form-label-left">
                            
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <img src="{{asset('production/images/logo.png')}}" height="75px" style="margin-bottom: 10px" alt="">
                                <br>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Group Name</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$jadwal->produk->judul}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Date of Departure</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{date('d M Y', strtotime($jadwal->tanggal))}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Total Pax</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{($dewasa) + ($cwb) + ($cwob) + ($infant)}} Person(s)</span>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Fare Details :</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                </div>
                            </div>
                            @php
                            $tota = 0;
                            @endphp
							 @if (($dewasa) == 1)
                            <div class="form-group">
                               
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Adult Single Supplement</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(($dewasa)*$jadwal->single)}} </span>
                                </div> 
                                @php
                                $tota += ($dewasa)*$jadwal->single;
                                @endphp
							</div>
                                @endif
							<div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Adult(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(($dewasa)*$jadwal->dewasa)}} </span>
                                </div> 
                                @php
                                $tota += ($dewasa)*$jadwal->dewasa;
                                @endphp
                                
                            </div>
                            @if ($cwb > 0)
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Child w/ Bed(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(($cwb)*$jadwal->cwb)}} </span>
                                </div>
                            </div>
                            @php
                            $tota += ($cwb)*$jadwal->cwb;
                            @endphp
                            @endif
                            @if ($cwob > 0)
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Child w/o Bed(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(($cwob)*$jadwal->cwob)}} </span>
                                </div>
                            </div>
                            @php
                            $tota += ($cwob)*$jadwal->cwob;
                            @endphp
                            @endif
                            @if ($infant > 0)
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Infant(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(($infant)*$jadwal->infant)}} </span>
                                </div>
                            </div>
                            @php
                            $tota += ($infant)*$jadwal->infant;
                            @endphp
                            @endif
                            @foreach($ex_mandat as $man)
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">{{$man['exclusion']}} x{{$dewasa + $cwb + $cwob}}</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format($man['exclusion_rate'] * ($dewasa + $cwb + $cwob) )}} </span>
                                </div>
                            </div>
                            @php
                            $tota += ($man['exclusion_rate']*($dewasa + $cwb + $cwob));
                            @endphp
                            @endforeach
                            @foreach($ex_optional as $index => $ops)
                            <div class="form-group ex-below-{{$index}}" >
                                <label class="col-md-6 col-sm-3 col-xs-12"  style="">{{$ops['exclusion']}} <span id="ex-title-{{$index}}"></span></label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span id="ex-below-{{$index}}">Rp {{number_format(0)}} </span>
                                </div>
                            </div>
                           {{-- @php
                            $tota += $ops['exclusion_rate'];
                            @endphp--}}
                            @endforeach
                            <div class="form-group" style="display:none">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">TOTAL</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span id="sub-total-value">{{$tota}}</span>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">TOTAL</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span id="total-value">Rp {{number_format($tota)}}</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /form color picker -->
        </div>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // Loop through each "above" select element
                var totaValue = {{ $tota }};
                var money = new Intl.NumberFormat().format(totaValue);
                var totaText = document.getElementById('total-value');
                var material = parseInt(document.getElementById('exclusion-above-0').getAttribute('data-rate'));
                
                @foreach ($ex_optional as $index => $man)
                $("#exclusion-above-{{$index}}").change(function() {
                    // Get the selected value (0: Don't Include, > 0: Include)
                    
                    var selectedValue = parseInt($(this).val());
                    
                    // Find the corresponding "below" section based on the index
                    var exBelow = $(".ex-below-{{$index}}");
                    // Show/hide the "below" section based on the selection
                    if (selectedValue > 0) {
                        exBelow.show();
                        totaValue += material;
                        var money = new Intl.NumberFormat().format(totaValue);
                    } else {
                        exBelow.hide();
                        totaValue -= material;
                        var money = new Intl.NumberFormat().format(totaValue);
                    }
                    
                    totaText.textContent = "Rp " + money;
                    console.log(selectedValue);
                });
                
                $("#exclusion-num-{{$index}}").keyup(function() {
                    var amount = parseInt($(this).val() || 0);  // Fallback to 0 if the input is empty
                    var harga = parseInt($("#exclusion-above-{{$index}}").val());
                    var totaText = document.getElementById('total-value');
                    
                    var totalSec = amount * harga;
                    
                    // If 'prevValue' data attribute isn't set, set it to 0 (defaulting to 0)
                   
                    // Retrieve previous value for this input, defaulting to 0
                    var previousValue = parseInt($(this).data('prevValue') || 0);
                    
                    // Adjust the totaValue
                    totaValue = totaValue - (previousValue * harga) + totalSec;
                    
                    // Now, store the current amount as 'prevValue' data attribute for next time
                    $(this).data('prevValue', amount);
                    
                    var money = new Intl.NumberFormat().format(totaValue);
                    
                    var exBelow = $("#ex-below-{{$index}}");
                    var exTitle = $("#ex-title-{{$index}}");
                    exBelow.text("Rp " + new Intl.NumberFormat().format(totalSec));
                    exTitle.text("x" + amount);

                    totaText.textContent = "Rp " + money;
                    
                    console.log(totalSec);
                });
                
                
                
                //console.log(selectedValue);
                
                totaText.textContent = "Rp " + money;
                @endforeach
                
            });
        </script>
        
        
        
        
        
        
        
        
        <script>
            function submitForms() {
                // Get all form elements
                var forms = document.getElementsByTagName('form');
                
                // Submit each form
                for (var i = 0; i < forms.length; i++) {
                    forms[i].submit();
                }
            }
        </script>
        <script>
            
            var total
            let exclusMan = 0;
            let exclusOps = 0;
            
            function checkValue() {
                var input1 = document.getElementById('input1');
                var input2 = document.getElementById('input2');
                var input3 = document.getElementById('input3');
                const inputValue = parseInt(input1.value);
                const generatedElements = document.querySelectorAll('.generated-element').length;
                // Step 3
                const itemSelect = document.getElementById("jadwal");
                const defaultSelectedOption = itemSelect.options[itemSelect.selectedIndex];
                let defaultCost = defaultSelectedOption.getAttribute("data-cost");
                itemSelect.addEventListener("change", function() {
                    const selectedOption = itemSelect.options[itemSelect.selectedIndex];
                    defaultCost = selectedOption.getAttribute("data-cost");
                });
                adultCost = defaultCost * inputValue;
                
                $('#adult-cat').text('Adult x' + inputValue);
                $('#adult-fee').text('Rp ' + numberWithCommas(adultCost));
                // Step 3 End
                
                // Step 2
                if (input1.value >= 1) {
                    input4.disabled = false;
                } else {
                    input4.disabled = true;
                }
                
                if (input1.value >= 2) {
                    input2.disabled = false;
                    input3.disabled = false;
                } else {
                    input2.disabled = true;
                    input3.disabled = true;
                }
                
                if (inputValue > generatedElements) {
                    for (let i = generatedElements; i < inputValue; i++) {
                        document.getElementById('adult').insertAdjacentHTML('afterend',
                        '<div class="generated-element" id="add_after_me"><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Title <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><select name="title_dewasa['+i+']" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-adult-'+i+'"><option value="">Choose Options</option><option value="mr">Mr.</option><option value="mrs">Mrs.</option><option value="ms">Ms.</option></select><div id="error-adult-'+i+'" style="color: white; background: red"></div></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Name <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="last-name" data-step="2" data-error-message="error-adult-nama-'+i+'" name="nama_cust_dewasa['+i+']" required="required" class="form-control col-md-7 col-xs-12"><div id="error-adult-nama-'+i+'" style="color: white; background: red"></div></div><div id="error-message" style="color: white; background: red"></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Date of Birth <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="date" id="last-name" name="lahir_dewasa['+i+']" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Passport Number <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="last-name" name="passport_dewasa['+i+']" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Passport Expiration Date <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="date" id="last-name" name="exp_dewasa['+i+']" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="ln_solid"></div></div>'
                        );
                    }
                }
                // If the input value is less than the number of generated elements, remove excess elements
                else if (inputValue < generatedElements) {
                    const elementsToRemove = document.querySelectorAll('.generated-element');
                    for (let i = inputValue; i < generatedElements; i++) {
                        elementsToRemove[i].remove();
                    }
                }
                // Step 2 End
            }
            
            function checkValue2() {
                var input1 = document.getElementById('input1');
                var input2 = document.getElementById('input2');
                var input3 = document.getElementById('input3');
                const inputValue2 = parseInt(input2.value);
                const generatedElements2 = document.querySelectorAll('.generated-element2').length;
                
                // Step 3
                const itemSelect = document.getElementById("jadwal");
                const defaultSelectedOption = itemSelect.options[itemSelect.selectedIndex];
                let defaultCost = defaultSelectedOption.getAttribute("data-cwb");
                itemSelect.addEventListener("change", function() {
                    const selectedOption = itemSelect.options[itemSelect.selectedIndex];
                    defaultCost = selectedOption.getAttribute("data-cwb");
                });
                cwbCost = defaultCost * inputValue2;
                
                $('#cwb-cat').text('Child With Bed x' + inputValue2);
                $('#cwb-fee').text('Rp ' + numberWithCommas(cwbCost));
                // Step 3 End
                
                if (inputValue2 > generatedElements2) {
                    for (let i = generatedElements2; i < inputValue2; i++) {
                        document.getElementById('cwb').insertAdjacentHTML('afterend',
                        '<div class="generated-element2" id="add_after_me"><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><select name="title_cwb['+i+']" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-cwb-'+i+'"><option value="">Choose Options</option><option value="mstr">Mstr.</option><option value="miss">Miss.</option></select><div id="error-cwb-'+i+'" style="color: white; background: red"></div></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Name <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="last-name" name="nama_cust_cwb['+i+']" required="required" class="form-control col-md-7 col-xs-12" data-step="2" data-error-message="error-cwb-nama-'+i+'"><div id="error-cwb-nama-'+i+'" style="color: white; background: red"></div></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Date of Birth <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="date" id="last-name" name="lahir_cwb['+i+']" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Passport Number <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="last-name" name="passport_cwb['+i+']" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Passport Expiration Date <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="date" id="last-name" name="exp_cwb['+i+']" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="ln_solid"></div></div>'
                        );
                    }
                }
                // If the input value is less than the number of generated elements, remove excess elements
                else if (inputValue2 < generatedElements2) {
                    const elementsToRemove = document.querySelectorAll('.generated-element2');
                    for (let i = inputValue2; i < generatedElements2; i++) {
                        elementsToRemove[i].remove();
                    }
                }
            }
            
            function checkValue3() {
                var input1 = document.getElementById('input1');
                var input2 = document.getElementById('input2');
                var input3 = document.getElementById('input3');
                const inputValue3 = parseInt(input3.value);
                const generatedElements3 = document.querySelectorAll('.generated-element3').length;
                
                // Step 3
                const itemSelect = document.getElementById("jadwal");
                const defaultSelectedOption = itemSelect.options[itemSelect.selectedIndex];
                let defaultCost = defaultSelectedOption.getAttribute("data-cwob");
                itemSelect.addEventListener("change", function() {
                    const selectedOption = itemSelect.options[itemSelect.selectedIndex];
                    defaultCost = selectedOption.getAttribute("data-cwob");
                });
                cwobCost = defaultCost * inputValue3;
                
                $('#cwob-cat').text('Child No Bed x' + inputValue3);
                $('#cwob-fee').text('Rp ' + numberWithCommas(cwobCost));
                // Step 3 End
                
                if (inputValue3 > generatedElements3) {
                    for (let i = generatedElements3; i < inputValue3; i++) {
                        document.getElementById('cwob').insertAdjacentHTML('afterend',
                        '<div class="generated-element3" id="add_after_me"><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><select name="title_cwob" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-cwob-'+i+'"><option value="">Choose Options</option><option value="mstr">Mstr.</option><option value="miss">Miss.</option></select><div id="error-cwob-'+i+'" style="color: white; background: red"></div></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Name <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="last-name" name="nama_cust_cwob['+i+']" required="required" class="form-control col-md-7 col-xs-12" data-step="2" data-error-message="error-cwob-nama-'+i+'"><div id="error-cwob-nama-'+i+'" style="color: white; background: red"></div></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Date of Birth <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="date" id="last-name" name="lahir_cwob['+i+']" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Passport Number <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="text" id="last-name" name="passport_cwob['+i+']" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12" >Passport Expiration Date <span class="required">*</span></label><div class="col-md-6 col-sm-6 col-xs-12"><input type="date" id="last-name" name="exp_cwob['+i+']" required="required" class="form-control col-md-7 col-xs-12"></div></div><div class="ln_solid"></div></div>'
                        );
                    }
                }
                // If the input value is less than the number of generated elements, remove excess elements
                else if (inputValue3 < generatedElements3) {
                    const elementsToRemove = document.querySelectorAll('.generated-element3');
                    for (let i = inputValue3; i < generatedElements3; i++) {
                        elementsToRemove[i].remove();
                    }
                }
            }
            
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
            
            
            var exclusionMan = document.querySelectorAll('.exclusion-man');
            //for (let i = 0; i < exclusionMan.length; i++) {
                //document.getElementById('costy').insertAdjacentHTML('afterend',
                //'<tr style="color: white"><td id="cwob-cat" style="border:none">aa</td><td id="cwob-fee" style="border:none">bb</td></tr>');
                
                //}
                exclusionMan.forEach(function(man) {
                    exclusMan += man.getAttribute('data-rate');
                    var rate = 'Rp ' + numberWithCommas(man.getAttribute('data-rate'));
                    var exclusion = man.value;
                    document.getElementById('costy').insertAdjacentHTML('afterend',
                    '<tr style="color: white"><td id="cwob-cat" style="border:none">'+exclusion+'</td><td id="cwob-fee" style="border:none">'+rate+'</td></tr>');
                })
                
                var exclusionOps = document.querySelectorAll('.exclusion-ops');
                //for (let i = 0; i < exclusionOps.length; i++) {
                    //document.getElementById('costy').insertAdjacentHTML('afterend',
                    //'<tr style="color: white"><td id="cwob-cat" style="border:none">bb</td><td id="cwob-fee" style="border:none">cc</td></tr>');
                    
                    //}
                    exclusionOps.forEach(function(ops) {
                        exclusOps += parseInt(ops.getAttribute('data-rate'));
                        var rate = 'Rp ' + numberWithCommas(ops.getAttribute('data-rate'));
                        var exclusion = ops.value;
                        document.getElementById('costy').insertAdjacentHTML('afterend',
                        '<tr style="color: white"><td id="cwob-cat" style="border:none">'+exclusion+'</td><td id="cwob-fee" style="border:none">'+rate+'</td></tr>');
                    })
                    
                    
                </script>
                
                @endsection
                