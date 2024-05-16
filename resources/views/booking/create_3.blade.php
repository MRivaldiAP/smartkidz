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
                <h3>Booking</small></h3>
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
        
        <!-- <div class="row">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                    <div class="x_title">
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
                        
                    </div>
                </div>
            </div>
        </div>-->
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
                        <form class="form-horizontal form-label-left">
                            <span class="section">Adult Customer</span>
                            @foreach ($dewasa as $de)
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="font-size:16px; background-color:#1D441F;color:white;border-radius:12px">{{ucwords($de['title'])}}. {{ucwords($de['nama'])}}</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Date of Birth</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['lahir'] ? date('d M Y', strtotime($de['lahir'])) : '--'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Passport Number</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['no_passport'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Passport Expiration Date</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['exp_passport'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Remark</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['remark'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="ln_solid"></div> 
                            @endforeach 
                            @if (count($cwb)>0)
                            <span class="section">Child Customer</span>
                            @foreach ($cwb as $de)
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="font-size:16px; background-color:#1D441F;color:white;border-radius:12px">{{ucwords($de['title'])}}. {{ucwords($de['nama'])}}</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Date of Birth</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['lahir'] ? date('d M Y', strtotime($de['lahir'])) : '--'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Passport Number</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['no_passport'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Passport Expiration Date</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['exp_passport'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Remark</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['remark'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="ln_solid"></div> 
                            @endforeach
                            @endif
                            
                            @if (count($cwob) > 0)
                            @foreach ($cwob as $de)
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="font-size:16px; background-color:#1D441F;color:white;border-radius:12px">{{ucwords($de['title'])}}. {{ucwords($de['nama'])}}</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Date of Birth</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['lahir'] ? date('d M Y', strtotime($de['lahir'])) : '--'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Passport Number</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['no_passport'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Passport Expiration Date</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['exp_passport'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Remark</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['remark'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="ln_solid"></div> 
                            @endforeach 
                            @endif
                            
                            
                            
                            @if (count($infant) > 0)
                            <span class="section">Infant Customer</span>
                            @foreach ($infant as $de)
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="font-size:16px; background-color:#1D441F;color:white;border-radius:12px">{{ucwords($de['title'])}}. {{ucwords($de['nama'])}}</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Date of Birth</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['lahir'] ? date('d M Y', strtotime($de['lahir'])) : '--'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Passport Number</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['no_passport'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Passport Expiration Date</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['exp_passport'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Remark</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>{{$de['remark'] ?? '-'}}</span>
                                </div>
                            </div>
                            <div class="ln_solid"></div> 
                            @endforeach 
                            @endif
                            
                        </form>
                        <div class="ln_solid"></div>         
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
                            
                            <!--<div class="col-md-12 col-sm-12 col-xs-12">
                                <img src="{{asset('production/images/logo.png')}}" height="50px" style="margin-bottom: 10px;margin-left:auto;margin-right:auto;display:block" alt="">
                                <br>
                            </div>-->
                            
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
                                    <span>{{(count($dewasa)) + count($cwb) + count($cwob) + count($infant)}} Person(s)</span>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            @php
                            $tot = 0;
                            if (count($dewasa) == 1) {
                                $tot += count($dewasa)*$jadwal->single;
                            }
                                $tot += count($dewasa)*$jadwal->dewasa;
                            
                            
                            @endphp
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Fare Details :</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                </div>
                            </div>
							 @if (count($dewasa) == 1)
                            <div class="form-group">
                               
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Adult Single Pax</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($dewasa)*$jadwal->single)}} </span>
                                </div> 
								</div> 
                               @endif
								<div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Adult(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($dewasa)*$jadwal->dewasa)}} </span>
                                </div> 
                                
                                
                            </div>
                            @if (count($cwb) > 0)
                            @php
                            $tot += count($cwb)*$jadwal->cwb;
                            @endphp
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Child w/ Bed(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($cwb)*$jadwal->cwb)}} </span>
                                </div>
                            </div>
                            @endif
                            @if (count($cwob) > 0)
                            @php
                            $tot += count($cwob)*$jadwal->cwob;
                            @endphp
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Child w/o Bed(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($cwob)*$jadwal->cwob)}} </span>
                                </div>
                            </div>
                            @endif
                            @if (count($infant) > 0)
                            @php
                            $tot += count($infant)*$jadwal->infant;
                            @endphp
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Infant(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($infant)*$jadwal->infant)}} </span>
                                </div>
                            </div>
                            @endif
                            @foreach ($exclusion as $excl)
                            @if (isset($excl['jumlah']))
                            @php
                            $tot += ($excl['harga']*$excl['jumlah']);
                            @endphp
                            @else 
                            @php
                            $tot += $excl['harga'];
                            @endphp
                            @endif
                            
                            <div class="form-group">
                                @if (isset($excl['jumlah']))
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">{{$excl['nama']}} x{{$excl['jumlah']}}</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format($excl['harga']*$excl['jumlah'])}} </span>
                                </div>
                                @else
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">{{$excl['nama']}}</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format($excl['harga'])}} </span>
                                </div>
                                @endif
                                
                            </div>
                            @endforeach
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">TOTAL</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format($tot)}} </span>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Agent Comm. X {{count($dewasa) + count($cwb) + count($cwob)}} Altmt.</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span style="color: red">- Rp {{number_format(((count($dewasa) + count($cwb) + count($cwob)) * $jadwal->commission))}} </span>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Total Payment</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span style="background-color:#1D441F; color:white ;padding:5px;border-radius:5px;font-size:16px">Rp {{number_format($tot - ((count($dewasa) + count($cwb) + count($cwob)) * $jadwal->commission))}} </span>
                                    
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal form-label-left fow" action="{{route('booking.step3')}}" method="post">
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
                                        <input id="input1" class="form-control col-md-3 col-xs-12" type="number" name="dewasa" value="{{count($dewasa)}}">
                                        <div id="error-message-1" style="color: white; background: red"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Child With Bed</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input id="input2" class="form-control col-md-3 col-xs-12" type="number" name="cwb" placeholder="2 - 12 Years (Min 2 Adults)" value="{{count($cwb)}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Child No Bed</label>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <input id="input3" class="form-control col-md-3 col-xs-12" type="number" name="cwob" placeholder="2 - 12 Years (Min 2 Adults)" value="{{count($cwob)}}">
                                    </div>
                                </div>
                            </div>
                            <div id="step-2" style="display: none">
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
                                    <div class="generated-element" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="title_dewasa[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-adult-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mr" {{$de['title'] == 'mr' ? 'selected' : ''}}>Mr.</option>
                                                    <option value="mrs" {{$de['title'] == 'mrs' ? 'selected' : ''}}>Mrs.</option>
                                                    <option value="ms" {{$de['title'] == 'ms' ? 'selected' : ''}}>Ms.</option>
                                                </select>
                                                <div id="error-adult-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" data-step="2" data-error-message="error-adult-nama-'+i+'" name="nama_cust_dewasa[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$de['nama']}}">
                                                <div id="error-adult-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                            <div id="error-message" style="color: white; background: red"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Passport </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="url_passport_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['url_passport']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="remark_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['remark']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>   
                                    @endforeach
                                    
                                </div>
                                <div id="cwb">
                                    <span class="section">Child With Bed</span>
                                    @foreach ($cwb as $de)
                                    <div class="generated-element" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="title_cwb[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-adult-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mstr" {{$de['title'] == 'mstr' ? 'selected' : ''}}>Mr.</option>
                                                    <option value="miss" {{$de['title'] == 'miss' ? 'selected' : ''}}>Mrs.</option>
                                                </select>
                                                <div id="error-adult-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" data-step="2" data-error-message="error-adult-nama-'+i+'" name="nama_cust_cwb[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$de['nama']}}">
                                                <div id="error-adult-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                            <div id="error-message" style="color: white; background: red"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Passport </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="url_passport_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['url_passport']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="remark_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['remark']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>   
                                    @endforeach
                                </div>
                                <div id="cwob">
                                    <span class="section">Child No Bed</span>
                                    @foreach ($cwob as $de)
                                    <div class="generated-element" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="title_cwob[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-adult-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mstr" {{$de['title'] == 'mstr' ? 'selected' : ''}}>Mr.</option>
                                                    <option value="miss" {{$de['title'] == 'miss' ? 'selected' : ''}}>Mrs.</option>
                                                </select>
                                                <div id="error-adult-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" data-step="2" data-error-message="error-adult-nama-'+i+'" name="nama_cust_cwob[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$de['nama']}}">
                                                <div id="error-adult-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                            <div id="error-message" style="color: white; background: red"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_cwob[]"  class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_cwob[]"  class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Passport </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="url_passport_cwob[]"  class="form-control col-md-7 col-xs-12" value="{{$de['url_passport']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="remark_cwob[]"  class="form-control col-md-7 col-xs-12" value="{{$de['remark']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_cwob[]"  class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>   
                                    @endforeach
                                </div>
                                <div id="infant">
                                    <span class="section">Infant</span>
                                    @foreach ($infant as $de)
                                    <div class="generated-element" id="add_after_me">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="title_infant[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-adult-'+i+'">
                                                    <option value="">Choose Options</option>
                                                    <option value="mstr" {{$de['title'] == 'mstr' ? 'selected' : ''}}>Mr.</option>
                                                    <option value="miss" {{$de['title'] == 'miss' ? 'selected' : ''}}>Mrs.</option>
                                                </select>
                                                <div id="error-adult-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" data-step="2" data-error-message="error-adult-nama-'+i+'" name="nama_cust_infant[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$de['nama']}}">
                                                <div id="error-adult-nama-'+i+'" style="color: white; background: red"></div>
                                            </div>
                                            <div id="error-message" style="color: white; background: red"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="lahir_infant[]"  class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="passport_infant[]"  class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Passport </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="url_passport_infant[]"  class="form-control col-md-7 col-xs-12" value="{{$de['url_passport']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="remark_infant[]"  class="form-control col-md-7 col-xs-12" value="{{$de['remark']}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="date" id="last-name" name="exp_infant[]"  class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}">
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                    </div>   
                                    @endforeach
                                </div>
                                <div id="exclusion">
                                    <span class="section">Exclusion</span>
                                    @foreach ($exclusion as $excl)
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{$excl['nama']}} (mandatory)<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="hidden" id="last-name" name="exclusion_rate[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$excl['harga']}}">
                                            <input type="hidden" id="last-name" name="exclusion_num[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$excl['jumlah']}}">
                                            <input type="hidden" id="exclusion_man" name="exclusion[]" required="required" class="form-control col-md-7 col-xs-12 exclusion-man" value="{{$excl['nama']}}"  >
                                            <select name="exclusion[]" id="exclusion" class="form-control col-md-7 col-xs-12" disabled>
                                                <option value="{{$excl['harga']}}" selected>Include</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="middle-name" class="col-md-6 col-sm-3 col-xs-12" >Input Your Deposit Nominal</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">
                                    <input id="input1" class="form-control col-md-12 col-xs-12" placeholder="min. {{ number_format($jadwal->min_deposit * (count($dewasa) + count($cwb) + count($cwob))) }}" type="number" name="deposit" min="{{ $jadwal->min_deposit * (count($dewasa) + count($cwb) + count($cwob)) }}" required>
                                    <div id="error-message-1" style="color: white; background: red"></div>
                                </div>
                            </div>
                            <input type="hidden" id="last-name" name="total" required="required" class="form-control col-md-7 col-xs-12" value="{{($tot - ((count($dewasa) + count($cwb) + count($cwob)) * $jadwal->commission))}}">
                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-6">
                                    <button id="send" type="submit" class="btn btn-success">Continue to Payment</button>
                                </div>
                            </div>
                            
                            <!-- End SmartWizard Content -->
                            
                        </form>
                    </div>
                </div>
            </div>
            <!-- /form color picker -->
        </div>
        
        <br>
        <br>
        {{--<form class="form-horizontal form-label-left fow" action="{{route('booking.step3')}}" method="post">
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
                        <input id="input1" class="form-control col-md-3 col-xs-12" type="number" name="dewasa" value="{{count($dewasa)}}">
                        <div id="error-message-1" style="color: white; background: red"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Child With Bed</label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input id="input2" class="form-control col-md-3 col-xs-12" type="number" name="cwb" placeholder="2 - 12 Years (Min 2 Adults)" value="{{count($cwb)}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Child No Bed</label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input id="input3" class="form-control col-md-3 col-xs-12" type="number" name="cwob" placeholder="2 - 12 Years (Min 2 Adults)" value="{{count($cwob)}}">
                    </div>
                </div>
            </div>
            <div id="step-2" style="display: none">
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
                    <div class="generated-element" id="add_after_me">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="title_dewasa[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-adult-'+i+'">
                                    <option value="">Choose Options</option>
                                    <option value="mr" {{$de['title'] == 'mr' ? 'selected' : ''}}>Mr.</option>
                                    <option value="mrs" {{$de['title'] == 'mrs' ? 'selected' : ''}}>Mrs.</option>
                                    <option value="ms" {{$de['title'] == 'ms' ? 'selected' : ''}}>Ms.</option>
                                </select>
                                <div id="error-adult-'+i+'" style="color: white; background: red"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" data-step="2" data-error-message="error-adult-nama-'+i+'" name="nama_cust_dewasa[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$de['nama']}}">
                                <div id="error-adult-nama-'+i+'" style="color: white; background: red"></div>
                            </div>
                            <div id="error-message" style="color: white; background: red"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" id="last-name" name="lahir_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="passport_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Passport </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="url_passport_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['url_passport']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="remark_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['remark']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" id="last-name" name="exp_dewasa[]"  class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                    </div>   
                    @endforeach
                    
                </div>
                <div id="cwb">
                    <span class="section">Child With Bed</span>
                    @foreach ($cwb as $de)
                    <div class="generated-element" id="add_after_me">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="title_cwb[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-adult-'+i+'">
                                    <option value="">Choose Options</option>
                                    <option value="mstr" {{$de['title'] == 'mstr' ? 'selected' : ''}}>Mr.</option>
                                    <option value="miss" {{$de['title'] == 'miss' ? 'selected' : ''}}>Mrs.</option>
                                </select>
                                <div id="error-adult-'+i+'" style="color: white; background: red"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" data-step="2" data-error-message="error-adult-nama-'+i+'" name="nama_cust_cwb[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$de['nama']}}">
                                <div id="error-adult-nama-'+i+'" style="color: white; background: red"></div>
                            </div>
                            <div id="error-message" style="color: white; background: red"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" id="last-name" name="lahir_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="passport_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Passport </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="url_passport_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['url_passport']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="remark_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['remark']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" id="last-name" name="exp_cwb[]"  class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                    </div>   
                    @endforeach
                </div>
                <div id="cwob">
                    <span class="section">Child No Bed</span>
                    @foreach ($cwob as $de)
                    <div class="generated-element" id="add_after_me">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="title_cwob[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-adult-'+i+'">
                                    <option value="">Choose Options</option>
                                    <option value="mstr" {{$de['title'] == 'mstr' ? 'selected' : ''}}>Mr.</option>
                                    <option value="miss" {{$de['title'] == 'miss' ? 'selected' : ''}}>Mrs.</option>
                                </select>
                                <div id="error-adult-'+i+'" style="color: white; background: red"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" data-step="2" data-error-message="error-adult-nama-'+i+'" name="nama_cust_cwob[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$de['nama']}}">
                                <div id="error-adult-nama-'+i+'" style="color: white; background: red"></div>
                            </div>
                            <div id="error-message" style="color: white; background: red"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" id="last-name" name="lahir_cwob[]"  class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="passport_cwob[]"  class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Passport </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="url_passport_cwob[]"  class="form-control col-md-7 col-xs-12" value="{{$de['url_passport']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="remark_cwob[]"  class="form-control col-md-7 col-xs-12" value="{{$de['remark']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" id="last-name" name="exp_cwob[]"  class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                    </div>   
                    @endforeach
                </div>
                <div id="infant">
                    <span class="section">Infant</span>
                    @foreach ($infant as $de)
                    <div class="generated-element" id="add_after_me">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="title_infant[]" id="title_dewasa" class="form-control col-md-7 col-xs-12" required data-step="2" data-error-message="error-adult-'+i+'">
                                    <option value="">Choose Options</option>
                                    <option value="mstr" {{$de['title'] == 'mstr' ? 'selected' : ''}}>Mr.</option>
                                    <option value="miss" {{$de['title'] == 'miss' ? 'selected' : ''}}>Mrs.</option>
                                </select>
                                <div id="error-adult-'+i+'" style="color: white; background: red"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" data-step="2" data-error-message="error-adult-nama-'+i+'" name="nama_cust_infant[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$de['nama']}}">
                                <div id="error-adult-nama-'+i+'" style="color: white; background: red"></div>
                            </div>
                            <div id="error-message" style="color: white; background: red"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" id="last-name" name="lahir_infant[]"  class="form-control col-md-7 col-xs-12" value="{{$de['lahir']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Number </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="passport_infant[]"  class="form-control col-md-7 col-xs-12" value="{{$de['no_passport']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Passport </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="url_passport_infant[]"  class="form-control col-md-7 col-xs-12" value="{{$de['url_passport']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="remark_infant[]"  class="form-control col-md-7 col-xs-12" value="{{$de['remark']}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Passport Expiration Date </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" id="last-name" name="exp_infant[]"  class="form-control col-md-7 col-xs-12" value="{{$de['exp_passport']}}">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                    </div>   
                    @endforeach
                </div>
                <div id="exclusion">
                    <span class="section">Exclusion</span>
                    @foreach ($exclusion as $excl)
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{$excl['nama']}} (mandatory)<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="hidden" id="last-name" name="exclusion_rate[]" required="required" class="form-control col-md-7 col-xs-12" value="{{$excl['harga']}}">
                            <input type="hidden" id="exclusion_man" name="exclusion[]" required="required" class="form-control col-md-7 col-xs-12 exclusion-man" value="{{$excl['nama']}}"  >
                            <select name="exclusion[]" id="exclusion" class="form-control col-md-7 col-xs-12" disabled>
                                <option value="{{$excl['harga']}}" selected>Include</option>
                            </select>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div id="step-5">
                <div class="form-group">
                    <label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12" style="font-size:16px">Input Your Deposit Nominal</label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input id="input1" class="form-control col-md-3 col-xs-12" type="number" name="deposit" min="{{$jadwal->min_deposit}}" required>
                        <div id="error-message-1" style="color: white; background: red"></div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="last-name" name="total" required="required" class="form-control col-md-7 col-xs-12" value="{{($tot - ((count($dewasa) + count($cwb) + count($cwob)) * $jadwal->commission))}}">
            <div class="form-group">
                <div class="col-md-3 col-md-offset-4">
                    <button id="send" type="submit" class="btn btn-success">Continue to Payment</button>
                </div>
            </div>
            
            <!-- End SmartWizard Content -->
            
        </form>--}}
        
        
        
        
    </div>
</div>
<!-- /page content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        