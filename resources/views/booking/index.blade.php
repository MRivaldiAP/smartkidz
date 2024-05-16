@extends('layout.main')
@section('title')
<title> Schedule </title>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Schedule</small></h3>
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
            <h2>Filter Schedule</small></h2>
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
            <form action="{{route('booking.index')}}" method="get">
              @csrf
              <div class="row mx-2">
                <div class="form-group col-lg-3 mx-2">
                  <label class="form-label">Country</label>
                  <select name="country" id="kode" class="form-control">
                    <option value="">Choose option</option>
                    @foreach($country as $it2)
                    <option value="{{$it2}}" {{$negara == $it2 ? 'selected' : ''}}>{{$it2}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-lg-3 mx-2">
                  <label class="form-label">Month of Departure</label>
                  <select name="bulan" id="kode" class="form-control">
                    <option value="">Choose option</option>
                    @for ($i = 1; $i < 13; $i++)
                    <option value="{{$i}}" {{$bul == $i ? 'selected' : ''}}>{{$i}}</option>
                    @endfor
                  </select>
                </div>
              </div>
              <div class="row mx-2">
                <div class="form-group col-lg-3 mx-2">
                  <button type="submit" class="btn btn-success mt-3">Filter</button>
                </div>
              </div> 
            </form>
            <form action="{{route('booking.index')}}" method="get">
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
            <h2>Schedule List</small></h2>
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
              <!--<a href="{{route('jadwal.create')}}" class="btn btn-success btn-sm ">
                <i class="fa fa-plus"></i> Input Schedule-->
              </a>
            </div>
            
            <table id="datatable-buttons" class="table table-light table-bordered">
              <thead style="color:  #73879C">
                <tr>
                  <th>No.</th>
                  <th>Group</th>
                  <th>Departure </th>
                  <th>Starting</th>
                  <th>Airlines</th>
                  <th>Prices</th>
                  <th>Commision</th>
				  <th>Min. Deposit/Pax</th>
                  <th>Loyalty Point</th>
                  <th>Status</th>
                  {{--<th>Download</th>--}}
				  <th>Itinerary</th>
                </tr>
              </thead>
              <tbody style="color:  #73879C">
                @php
                    $counter = 1;
                @endphp
                @foreach ($countra as $it)
				  @php
   				$jadwala = $jadwal->filter(function ($item) use ($it) {
        			return strtolower($item->produk->country) === strtolower($it);
				  });
				@endphp
				  @if (count($jadwala) > 0)
				   <tr>
                  <td>
                    {{$counter++}}
                  </td>
                  <td><span style=" font-size:18px"> {{$it}}</span> </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
				  <td></td>
                </tr>
				  @endif
               
                @php
   				$jadwali = $jadwal->filter(function ($item) use ($it) {
        			return strtolower($item->produk->country) === strtolower($it);
				  });
				@endphp
                @foreach ($jadwali as $item)
                @php
                $iti = unserialize($item->produk->itinerary);
                $keys = array_column($iti, 'hari');
                array_multisort($keys, SORT_ASC, $iti);
                $alt = 0;
                if(now()->gt(\Carbon\Carbon::parse($item->tanggal))){
                  $bookings = $item->booking->where('status', '<>', 'cancel')->filter(function ($booking) {
                    return $booking->paid >= $booking->total;
                  });
                  
                  foreach($bookings as $it) {
                    $alt += count(unserialize($it->dewasa)) + count(unserialize($it->cwb)) + count(unserialize($it->cwob));
                  };
                  
                } else {
                  $bookings = $item->booking->where('status', '<>', 'cancel');
                  foreach($bookings as $it) {
                    $alt += count(unserialize($it->dewasa)) + count(unserialize($it->cwb)) + count(unserialize($it->cwob)); 
                  };
                }
                @endphp
                <tr>
                  <td>{{$counter++}} </td>
                  <td>{{$item->produk->judul}} </td>
                  @if (($item->allotment - $item->$alt) > 0 && $item->everyday == 'no')
                  <td>{{$item->tanggal}} <a style="color: blue" href="{{url('booking/pick/'.$item->id)}}"> (Book Now)</a></td>
                  @elseif (($item->allotment - $item->$alt) <= 0 && $item->everyday == 'no')
                  <td>{{$item->tanggal}} </td>
				  @elseif (($item->allotment - $item->$alt) > 0 && $item->everyday == 'yes')
				  <td><span style="color:red">EVERYDAY </span><a style="color: blue" href="{{url('booking/pick/'.$item->id)}}"> (Book Now)</a></td>
				  @elseif (($item->allotment - $item->$alt) <= 0 && $item->everyday == 'YES')
                  <td><span style="color:red">EVERYDAY </span> </td>
                  @endif
                  <td>{{$item->starting}}</td>
                  <td>{{$item->airlines}}</td>
                  <td>{{str_replace(',','.',number_format($item->dewasa))}}</td>
                  <td>{{str_replace(',','.',number_format($item->commission))}} </td>
				  <td>{{str_replace(',','.',number_format($item->min_deposit))}}</td>
                  <td>{{$item->point}}</td>
                 {{-- @if ($alt == 0)
                  <td style="background-color: white; color:black">Open</td>
                  @elseif (($alt > 0) && ($alt < $item->min_departure))
                  <td style="background-color: rgb(231, 121, 121); color:white">Almost Definite</td> 
                  @elseif (($alt >= $item->min_departure) && ($alt < ($item->allotment - 10)))
                  <td style="background-color: green; color:white">Definite</td> --}} {{--uncomment this--}}
                  @if (($alt >= ($item->allotment - 10)) && ($alt < ($item->allotment ))) {{--change to elseif--}}
                  <td style="background-color: rgb(0, 195, 255);color:white">{{$item->allotment - $alt}} Seats Remaining</td>
                  @elseif ($alt == $item->allotment)
                  <td style="background-color: red;color:white">Closed</td> 
				  @else {{--to be deleted--}}
				  <td style="background-color: white; color:black">Available</td>{{--to be deleted--}}
                  @endif
                  {{--<td style="color: white">
                    <a href="{{asset('poster/'.$item->produk->url_poster)}}" target="_blank" style="color: blue" download> Poster /</a>
                    <a href="{{asset('itinerary/'.$item->produk->url_iti)}}" target="_blank" style="color: blue" download> Itinerary</a>
                  </td>--}}
				  <td><p>Itinerary Detail </p>
                    @foreach ($iti as $it)
                        <p ><span>Day-{{$it['hari']}}</span><span style="color: orange"> {{$it['lokasi']}}</span></p>
                        <p>{{$it['deskripsi']}}</p>
                        <p><i class="fa fa-cutlery" style="color:#DCD02D"> </i><span style="color: #26B99A"> {{$it['breakfast'] == 'breakfast' ? 'Breakfast' : ''}}</span> <span style="color: #26B99A">{{$it['lunch'] == 'lunch' ? 'Lunch' : ''}}</span> <span style="color: #26B99A">{{$it['dinner'] == 'dinner' ? 'Dinner' : ''}}</span>
                        @if ($it['flight'] != null)
                        <i class="fa fa-plane" style="color:#DCD02D"></i> <span style="color: #26B99A">Flight Detail : {{$it['flight']}}</span></p>
                        @endif
                    @endforeach
					   <a href="{{asset('poster/'.$item->produk->url_poster)}}" target="_blank" style="color: blue" download> Poster /</a>
                    <a href="{{asset('itinerary/'.$item->produk->url_iti)}}" target="_blank" style="color: blue" download> Itinerary</a>
				  </td>
                </tr>
                @endforeach
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
