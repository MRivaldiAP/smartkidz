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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title text-white" style="background-color: #1D441F">
                        <h2 style="color: white">Choose Your Destination and Pax <small style="color: white"></small></h2>
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
                        <p>A special prize bed intended for a child is only available for purchase for the third person.</p>
                        <p>The infant package can only be purchased when accompanied by at least one adult purchase.</p>
                        <br>
                        <form class="form-horizontal form-label-left fow" action="{{route('booking.store')}}" method="post">
                            @csrf
                            <div id="" class="form_wizard wizard_horizontal">
                                <div id="step-1">
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
                                                @php
                                                $alt = 0;
                                                if(now()->gt(\Carbon\Carbon::parse($item->tanggal)->subDays(3))){
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
                                                <option value="{{$item->id}}" {{$alt >= $item->allotment ? 'disabled' : ''}} data-cost="{{$item->dewasa}}" data-cwb="{{$item->cwb}}" data-cwob="{{$item->cwob}}" {{$id == $item->id ? 'selected' : ''}}>{{date('d M Y', strtotime($item->tanggal))}} - {{date('d M Y', strtotime($item->tanggal . ' +'.(count(unserialize($produk->itinerary)) - 1).' day'))}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Adult</label>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <input id="input1" class="form-control col-md-3 col-xs-12" type="number" oninput="checkValue()" name="dewasa" placeholder=">12 Years" required data-step="1" data-error-message="error-message-1" >
                                            <div id="error-message-1" style="color: white; background: red"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Child With Bed</label>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <input id="input2" class="form-control col-md-3 col-xs-12" type="number" oninput="checkValue2()" name="cwb" placeholder="2 - 12 Years (Min 2 Adults)" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Child No Bed</label>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <input id="input3" class="form-control col-md-3 col-xs-12" type="number" oninput="checkValue3()" name="cwob" placeholder="2 - 12 Years (Min 2 Adults)" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Infant</label>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <input id="input4" class="form-control col-md-3 col-xs-12" type="number" name="infant" placeholder="< 24 Months (Min 1 Adult)" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                      <button id="send" type="submit" class="btn btn-success">Next</button>
                                    </div>
                                  </div>
                            <!-- End SmartWizard Content -->
                        </form>
                        
                        
                    </div>
                </div>
            </div>
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
            