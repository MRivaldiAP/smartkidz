@extends('layout.main')
@section('title')
<title> Invoice </title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>INVOICE</small></h3>
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
        
        <!--<button type="button" onclick="printJS('printItem', 'html')">
            Print Quotation-->
         </button>
         @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
      @endif
      @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
      @endif
<a href="{{url('my-booking/pay/'.$booking->id)}}" class="btn btn-info btn-sm ml-3">
    <i class="fa fa-note"></i>Pay
</a>
         <a href="{{url('booking/print-invoice/'.$booking->id)}}" class="btn btn-success btn-sm ">
            <i class="fa fa-note"></i>Print Quotation
          </a>
          <form action="{{url('booking/cancel/'.$booking->id)}}" method="post" onsubmit="return confirm('Attention: No refunds given for cancelled bookings. Please confirm carefully.')" style="display:inline">
            @csrf
            <button class="btn btn-danger btn-sm ml-3">
              Cancel Booking
            </button>
          </form>

        <div class="row" id="printItem">
            <!-- form input mask -->
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title" style="background-color: #1D441F">

                        <h2 style="color: white">Transaction Summary</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        @php
                            {{$counter = 1;}}
                        @endphp
                        <form class="form-horizontal form-label-left">  
                            <div class="form-group">
                                <div class="col-md-4 col-sm-9 col-xs-12">      
                                    <img src="{{asset('production/images/logo.png')}}" height="50px" style="margin-bottom: 10px" alt="">
                                </div>
                                <div class="col-md-4 col-sm-9 col-xs-12">      
                                    <div class="col-md-6 col-sm-9 col-xs-12">      
                                        <span>Booking Code</span>
                                    </div>
                                    <div class="col-md-6 col-sm-9 col-xs-12">      
                                        <span><b>{{$booking->kode_booking == '' ? '--' : $booking->kode_booking}}</b></span>
                                    </div>
                                    <div class="col-md-6 col-sm-9 col-xs-12">      
                                        <span>Status</span>
                                    </div>
                                    @if ($booking->paid == 0 || $booking->status == 'cancel')
                                    <div class="col-md-6 col-sm-9 col-xs-12">      
                                        <span style="color:red"><b>CANCELLED</b></span>
                                    </div>
                                    @elseif($booking->paid > 0 && $booking->paid < $booking->total && $booking->status != 'cancel')
                                    <div class="col-md-6 col-sm-9 col-xs-12">      
                                        <span style="color:orange"><b>HOLD</b></span>
                                    </div>
                                    @elseif($booking->paid >= $booking->total && $booking->status != 'cancel')
                                    <div class="col-md-6 col-sm-9 col-xs-12">      
                                        <span style="color:#2196F3"><b>PAID</b></span>
                                    </div>
                                    @endif
                                    <div class="col-md-6 col-sm-9 col-xs-12">      
                                        <span>Agent</span>
                                    </div>
                                    <div class="col-md-6 col-sm-9 col-xs-12">      
                                        <span style="color: white;background-color:#1D441F;padding:3px;border-radius:2px"><b>{{ucwords($agent->name)}}</b></span>
                                    </div>
                                    <div class="col-md-6 col-sm-9 col-xs-12">      
                                        <span>Created At</span>
                                    </div>
                                    <div class="col-md-6 col-sm-9 col-xs-12">      
                                        <span><b>{{date('d M Y', strtotime($booking->created_at))}}</b></span>
                                    </div>
									@if($booking->paid < $booking->total)
									<div class="col-md-6 col-sm-9 col-xs-12">      
                                        <span>Limit Payment</span>
                                    </div>
									@if(now()->gt(\Carbon\Carbon::parse($booking->jadwal->tanggal)->subDays(15)->format('Y-m-d')))
                <div class="col-md-6 col-sm-9 col-xs-12"><b> {{ \Carbon\Carbon::parse($booking->jadwal->tanggal)->subDays(15)->format('d M Y') }}
					<span style="color:orange">OVERDUE</span></b></div>
				@else
			<div class="col-md-6 col-sm-9 col-xs-12"><b> {{ \Carbon\Carbon::parse($booking->jadwal->tanggal)->subDays(15)->format('d M Y') }}
					</b></div>
				@endif
                                 @endif
                                </div>
                                <div class="col-md-1 col-sm-9 col-xs-12">      
                                 
                                </div>
                                <div class="col-md-3 col-sm-9 col-xs-12">      
                                    <h4>Agent Paid</h4>
                                    <h2><b>Rp {{number_format($booking->paid)}}</b></h2>
                                    <p style="font-style: italic">*Cummulative Payment</p>
                                </div>
                            </div> 
                        </form>
                        <div class="ln_solid"></div>         
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_title" style="background-color: #1D441F">
                        <h2 style="color: white">Pax Details</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        @php
                            {{$counter = 1;}}
                        @endphp
                        <form class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="col-md-1 col-sm-3 col-xs-12" >No</label>
                                <label class="col-md-3 col-sm-3 col-xs-12" >Name</label>
                                <label class="col-md-2 col-sm-9 col-xs-12" >Date of Birth</label>
                                <label class="col-md-2 col-sm-9 col-xs-12" >Passport Number</label>
                                <label class="col-md-2 col-sm-9 col-xs-12" >Passport Exp.</label>
                                <label class="col-md-2 col-sm-9 col-xs-12" >Remark</label>
                            </div>
                            <div class="ln_solid"></div>
                            @foreach ($dewasa as $de)
                            <div class="form-group">
                                <div class="col-md-1 col-sm-9 col-xs-12">      
                                    <span>{{$counter++}}</span>
                                </div>
                                <div class="col-md-3 col-sm-9 col-xs-12">      
                                    <span>{{ucwords($de['title'])}}. {{ucwords($de['nama'])}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['lahir'] ? date('d M Y', strtotime($de['lahir'])) : '--'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['no_passport'] ?? '-'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['exp_passport'] ?? '-'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['remark'] ?? '-'}}</span>
                                </div>
                            </div> 
                            @endforeach 
                            @if (count($cwb)>0)
                            @foreach ($cwb as $de)
                            <div class="form-group">
                                <div class="col-md-1 col-sm-9 col-xs-12">      
                                    <span>{{$counter++}}</span>
                                </div>
                                <div class="col-md-3 col-sm-9 col-xs-12">      
                                    <span>{{ucwords($de['title'])}}. {{ucwords($de['nama'])}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['lahir'] ? date('d M Y', strtotime($de['lahir'])) : '--'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['no_passport'] ?? '-'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['exp_passport'] ?? '-'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['remark'] ?? '-'}}</span>
                                </div>
                            </div> 
                            @endforeach
                            @endif
                            
                            @if (count($cwob) > 0)
                            @foreach ($cwob as $de)
                            <div class="form-group">
                                <div class="col-md-1 col-sm-9 col-xs-12">      
                                    <span>{{$counter++}}</span>
                                </div>
                                <div class="col-md-3 col-sm-9 col-xs-12">      
                                    <span>{{ucwords($de['title'])}}. {{ucwords($de['nama'])}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['lahir'] ? date('d M Y', strtotime($de['lahir'])) : '--'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['no_passport'] ?? '-'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['exp_passport'] ?? '-'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['remark'] ?? '-'}}</span>
                                </div>
                            </div> 
                            @endforeach 
                            @endif
                             
                            
                            
                            @if (count($infant) > 0)
                            @foreach ($infant as $de)
                            <div class="form-group">
                                <div class="col-md-1 col-sm-9 col-xs-12">      
                                    <span>{{$counter++}}</span>
                                </div>
                                <div class="col-md-3 col-sm-9 col-xs-12">      
                                    <span>{{ucwords($de['title'])}}. {{ucwords($de['nama'])}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['lahir'] ? date('d M Y', strtotime($de['lahir'])) : '--'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['no_passport'] ?? '-'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['exp_passport'] ?? '-'}}</span>
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12">      
                                    <span>{{$de['remark'] ?? '-'}}</span>
                                </div>
                            </div> 
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
                        <h2 style="color: white">Product & Fare Details</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
									$tot += count($dewasa)*$jadwal->dewasa;
                                } elseif (count($dewasa) > 1) {
                                    $tot += count($dewasa)*$jadwal->dewasa;
                                }
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
							<div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Adult(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($dewasa)*$jadwal->dewasa)}} </span>
                                </div> 
								</div> 
                                @elseif(count($dewasa) > 1)
							<div class="form-group">
                                <label class="col-md-6 col-sm-3 col-xs-12" style="">Adult(s)</label>
                                <div class="col-md-6 col-sm-9 col-xs-12">      
                                    <span>Rp {{number_format(count($dewasa)*$jadwal->dewasa)}} </span>
                                </div> 
								</div> 
                                @endif
                       
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
                    </div>
                </div>
            </div>
            <!-- /form color picker -->
        </div>
        
        <br>
        <br>
       
        
        
        
        
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
        