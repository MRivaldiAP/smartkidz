@extends('layout.main')
@section('title')
<title> Edit My Booking </title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit My Booking</small></h3>
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
                        <form class="form-horizontal form-label-left fow" action="{{route('my-booking.update', $booking->id)}}" method="post" enctype="multipart/form-data">
                            @method('put')                            
                            @csrf
                          
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
                                            <input type="text" id="last-name" name="hp_agent" required="required" class="form-control col-md-7 col-xs-12" value="{{$user->agent->hp}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div id="adult">
                                    <span class="section">Adult Customer</span>
                                    @foreach ($dewasa as $de)
                                    <div class="" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                @if (now()->gt($jadwal->edit_limit) && auth()->user()->role != 'admin')
                                                <input type="text" id="last-name" name="title_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['title']}}" readonly>
                                                @else
                                                <select name="title_dewasa[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-adult-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mr" {{$de['title'] == 'mr' ? 'selected' : ''}}>Mr.</option>
                                                    <option value="mrs" {{$de['title'] == 'mrs' ? 'selected' : ''}}>Mrs.</option>
                                                    <option value="ms" {{$de['title'] == 'ms' ? 'selected' : ''}}>Ms.</option>
                                                </select>
                                                <div id="error-adult-'+i+'" style="color: white; background: red"></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" data-step="2" data-error-message="error-adult-nama-'+i+'" name="nama_cust_dewasa[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$de['nama']}}" {{now()->gt($jadwal->edit_limit) && auth()->user()->role != 'admin' ? 'readonly' : ''}}>
                                                <div id="error-adult-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                            <div id="error-message" style="color: white; background: red"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}" {{now()->gt($jadwal->edit_limit) && auth()->user()->role != 'admin' ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}" {{now()->gt($jadwal->edit_limit) && auth()->user()->role != 'admin' ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}" {{now()->gt($jadwal->edit_limit) && auth()->user()->role != 'admin' ? 'readonly' : ''}}>
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
                                                <input type="text" id="last-name" name="remark_dewasa[]"  class="form-control col-md-7 col-xs-12" placeholder="ex: Need wheelchair" value="{{$de['remark'] ?? ''}}" {{now()->gt($jadwal->edit_limit) && auth()->user()->role != 'admin' ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>  
                                    @endforeach                                        
                                </div>
                                
                                @if (count($cwb) > 0)
                                <div id="cwb">
                                    <span class="section">Child With Bed</span>
                                    @foreach ($cwb as $de)
                                    <div class="generated-element2" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                @if (now()->gt($jadwal->edit_limit))
                                                <input type="text" id="last-name" name="title_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['title']}}" readonly>
                                                @else
                                                <select name="title_cwb[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-cwb-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mstr" {{$de['title'] == 'mstr' ? 'selected' : ''}}>Mstr.</option>
                                                    <option value="miss" {{$de['title'] == 'miss' ? 'selected' : ''}}>Miss.</option>
                                                </select>
                                                <div id="error-cwb-'+i+'" style="color: white; background: red"></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="nama_cust_cwb[]" required="required" class="form-control col-md-7 col-xs-12" data-step="2" data-error-message="error-cwb-nama-'+i+'" value="{{$de['nama']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                                <div id="error-cwb-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_cwb[]" class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
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
                                                <input type="text" id="last-name" name="remark_cwb[]"  class="form-control col-md-7 col-xs-12" placeholder="ex: Need wheelchair" value="{{$de['remark'] ?? ''}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>
                                    
                                    @endforeach
                                </div>  
                                @endif
                                @if (count($cwob) > 0)
                                <div id="cwob">
                                    <span class="section">Child No Bed</span>
                                    @foreach ($cwob as $de)
                                    <div class="generated-element3" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                @if (now()->gt($jadwal->edit_limit))
                                                <input type="text" id="last-name" name="title_cwob[]"  class="form-control col-md-7 col-xs-12" value="{{$de['title']}}" readonly>
                                                @else
                                                <select name="title_cwob[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-cwob-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mstr" {{$de['title'] == 'mstr' ? 'selected' : ''}}>Mstr.</option>
                                                    <option value="miss" {{$de['title'] == 'miss' ? 'selected' : ''}}>Miss.</option>
                                                </select>
                                                <div id="error-cwob-'+i+'" style="color: white; background: red"></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="nama_cust_cwob[]" required="required" class="form-control col-md-7 col-xs-12" data-step="2" data-error-message="error-cwob-nama-'+i+'" value="{{$de['nama']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                                <div id="error-cwob-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_cwob[]" class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_cwob[]" class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_cwob[]" class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
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
                                                <input type="text" id="last-name" name="remark_cwob[]"  class="form-control col-md-7 col-xs-12" placeholder="ex: Need wheelchair" value="{{$de['remark'] ?? ''}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>
                                    
                                    @endforeach
                                </div>
                                @endif
                                @if (count($infant) > 0)
                                <div id="cwob">
                                    <span class="section">Infant</span>
                                    @foreach ($infant as $de)
                                    <div class="generated-element3" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                @if (now()->gt($jadwal->edit_limit))
                                                <input type="text" id="last-name" name="title_infant[]"  class="form-control col-md-7 col-xs-12" value="{{$de['title']}}" readonly>
                                                @else
                                                <select name="title_infant[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-cwob-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mstr" {{$de['title'] == 'mstr' ? 'selected' : ''}}>Mstr.</option>
                                                    <option value="miss" {{$de['title'] == 'miss' ? 'selected' : ''}}>Miss.</option>
                                                </select>
                                                <div id="error-cwob-'+i+'" style="color: white; background: red"></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="nama_cust_infant[]" required="required" class="form-control col-md-7 col-xs-12" data-step="2" data-error-message="error-cwob-nama-'+i+'" value="{{$de['nama']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                                <div id="error-cwob-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_infant[]" class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_infant[]" class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_infant[]" class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
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
                                                <input type="text" id="last-name" name="remark_infant[]"  class="form-control col-md-7 col-xs-12" placeholder="ex: Need wheelchair" value="{{$de['remark'] ?? ''}}" {{now()->gt($jadwal->edit_limit) ? 'readonly' : ''}}>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>
                                    
                                    @endforeach
                                </div>
                                @endif
                                <div id="exclusion">
                                    <span class="section">Exclusion</span>
                                    @foreach ($exclusion as $man)
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{$man['nama']}} (mandatory)<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="hidden" id="last-name" name="exclusion_rate[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$man['harga']}}">
                                            <input type="hidden" id="exclusion_man" name="exclusion[]" required="required" class="form-control col-md-7 col-xs-12 exclusion-man" value="{{$man['nama']}}" data-rate="{{$man['harga']}}" >
                                            <select name="exclusion[]" id="exclusion" class="form-control col-md-7 col-xs-12" disabled>
                                                <option value="{{$man['harga']}}" selected>{{$man['harga'] == 0 ? 'Not Included' : 'Included'}}</option>
                                            </select>
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
                                    <span>{{count($dewasa) + count($cwb) + count($cwob) + count($infant)}} Person(s)</span>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            {{--<div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Fare Details :</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                </div>
                            </div>
                            <div class="form-group">
                                @if (count($dewasa) == 1)
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Adult Single Pax</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($dewasa)*$jadwal->single)}} </span>
                                </div> 
                                @elseif(($dewasa) > 1)
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Adult(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($dewasa)*$jadwal->dewasa)}} </span>
                                </div> 
                                @endif
                            </div>
                            @if (count($cwb) > 0)
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Child w/ Bed(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($cwb)*$jadwal->cwb)}} </span>
                                </div>
                            </div>
                            @endif
                            @if (count($cwob) > 0)
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Child w/o Bed(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($cwob)*$jadwal->cwob)}} </span>
                                </div>
                            </div>
                            @endif
                            @if (count($infant) > 0)
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Infant(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($infant)*$jadwal->infant)}} </span>
                                </div>
                            </div>
                            @endif--}}
                            
                        </form>
                    </div>
                </div>
            </div>
            <!-- /form color picker -->
        </div>
    </div>
</div>
<!-- /page content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
        </script>
        
        @endsection
        