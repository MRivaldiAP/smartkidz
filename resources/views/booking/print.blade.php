<!DOCTYPE html>
<html lang="en" >
<head>
    <style>
        #invoice{
            padding: 30px;
        }
        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }
        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }
        .invoice .company-details {
            text-align: right
        }
        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }
        .invoice .contacts {
            margin-bottom: 20px
        }
        .invoice .invoice-to {
            text-align: left
        }
        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }
        .invoice .invoice-details {
            text-align: right
        }
        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }
        .invoice main {
            padding-bottom: 50px
        }
        .invoice main .thanks {
            margin-top: -125px;
            font-size: 1.4em;
            margin-bottom: 50px
        }
		.invoice main .thankso {
            margin-top: -35px;
            font-size: 1.6em;
            margin-bottom: 0
        }
		.invoice main .thanksi {
            
            font-size: 1.0em;
            margin-bottom: 50px
        }
        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }
        .invoice main .notices .notice {
            font-size: 1.2em
        }
        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }
        .invoice table td,.invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }
        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }
        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }
        .invoice table .qty,.invoice table .total,.invoice table .unit {
            text-align: right;
            font-size: 12px
        }
        .invoice table .no {
            color: #fff;
            font-size: 12px;
            background: #3989c6
        }
        .invoice table .unit {
            background: #ddd
        }
        .invoice table .total {
            background: #3989c6;
            color: #fff
        }
        .invoice table tbody tr:last-child td {
            border: none
        }
        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }
        .invoice table tfoot tr:first-child td {
            border-top: none
        }
        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }
        .invoice table tfoot tr td:first-child {
            border: none
        }
        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }
        @media print {
            .invoice {
                font-size: 11px!important;
                overflow: hidden!important
            }
            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }
            .invoice>div:last-child {
                page-break-before: always
            }
        }
    </style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    
    
</head>
<body>
    <div id="invoice">
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <!-- <header>
                    <div class="row">
                        <!--<div class="col">
                            <a target="_blank" href="https://lobianijs.com">
                                <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" data-holder-rendered="true" />
                            </a>
                        </div>
                        <div class="col company-details">
                            
                            <!-- <h2 class="name">
                                <a target="_blank" href="https://lobianijs.com">
                                    Arboshiki
                                </a>
                            </h2>
                            <div>455 Foggy Heights, AZ 85004, US</div>
                            <div>(123) 456-789</div>
                            <div>company@example.com</div>
                        </div>
                    </div>
                </header>-->
                <main>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 50%;">
                                <div class="text-gray-light">PAYMENT RECEIPT</div>
                                <h2 class="to">{{ucwords($agent->name)}}</h2>
                                <div class="address"><a href="">{{$agent->email}}</a></div><br>
                                @if ($booking->paid == 0 || $booking->status == 'cancel')
                                <div style="background-color: red; color:white;padding:5px;border-radius:3px"><b>CANCELLED</b></div>
                                @elseif($booking->paid > 0 && $booking->paid < $booking->total && $booking->status != 'cancel')
                                <div style="background-color: orange; color:white;padding:5px;border-radius:3px"><b>HOLD</b></div>
                                @elseif($booking->paid >= $booking->total && $booking->status != 'cancel')
                                <div style="background-color: #28AADE; color:white;padding:5px;border-radius:3px"><b>PAYMENT COMPLETED</b></div>
                                @endif
                            </td>
                            <td style="width: 50%; text-align: right;">
                                <img src="{{public_path('production/images/logo.png')}}" height="50px" alt="">
                                <h2 class="invoice-id">ORDER ID : {{$booking->kode_booking}}</h2>
                                <div class="date">Date of Invoice: {{date('d M Y', strtotime($booking->created_at))}}</div>
                                <div class="date">Due Date: {{ date('d M Y', strtotime($jadwal->tanggal . ' -3 days')) }}
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">DESCRIPTION</th>
                                <th class="text-right">RATE (IDR)</th>
                                <th class="text-right">QTY</th>
                                <th class="text-right">TOTAL (IDR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $counter = 1;
                            $tot = 0;
                                if (count($dewasa) == 1) {
                                    $tot += count($dewasa)*$jadwal->single;
									$tot += count($dewasa)*$jadwal->dewasa;
                                } elseif (count($dewasa) > 1) {
                                    $tot += count($dewasa)*$jadwal->dewasa;
                                }
                            @endphp
							@if(count($dewasa) > 1)
                            <tr>
                                <td class="no">{{$counter++}}</td>
                                <td class="text-left">
                                    <h3>
                                        <span>Adult Pax</span>
                                    </h3>
                                </td>
                                <td class="unit"><h3>{{number_format($jadwal->dewasa)}}</h3> </td>
                                <td class="qty"><h3>{{count($dewasa)}}</h3> </td>
                                <td class="qty"><h3>{{number_format($jadwal->dewasa * count($dewasa))}}</h3> </td>
                            </tr>
							@else
							<tr>
                                <td class="no">{{$counter++}}</td>
                                <td class="text-left">
                                    <h3>
                                        <span>Adult Single Pax</span>
                                    </h3>
                                </td>
                                <td class="unit"><h3>{{number_format($jadwal->single)}}</h3> </td>
                                <td class="qty"><h3>{{count($dewasa)}}</h3> </td>
                                <td class="qty"><h3>{{number_format($jadwal->single * count($dewasa))}}</h3> </td>
                            </tr>
							<tr>
                                <td class="no">{{$counter++}}</td>
                                <td class="text-left">
                                    <h3>
                                        <span>Adult Pax</span>
                                    </h3>
                                </td>
                                <td class="unit"><h3>{{number_format($jadwal->dewasa)}}</h3> </td>
                                <td class="qty"><h3>{{count($dewasa)}}</h3> </td>
                                <td class="qty"><h3>{{number_format($jadwal->dewasa * count($dewasa))}}</h3> </td>
                            </tr>
							@endif
                            @if (count($cwb) > 0)
                            @php
                                $tot += $jadwal->cwb * count($cwb);
                            @endphp
                            <tr>
                                <td class="no">{{$counter++}}</td>
                                <td class="text-left">
                                    <h3>
                                        <span>Child With Bed Pax</span>
                                    </h3>
                                </td>
                                <td class="unit"><h3>{{number_format($jadwal->cwb)}}</h3> </td>
                                <td class="qty"><h3>{{count($cwb)}}</h3> </td>
                                <td class="qty"><h3>{{number_format($jadwal->cwb * count($cwb))}}</h3> </td>
                            </tr>
                            @endif
                            @if (count($cwob) > 0)
                            @php
                                $tot += $jadwal->cwob * count($cwob);
                            @endphp
                            <tr>
                                <td class="no">{{$counter++}}</td>
                                <td class="text-left">
                                    <h3>
                                        <span>Child With Bed Pax</span>
                                    </h3>
                                </td>
                                <td class="unit"><h3>{{number_format($jadwal->cwob)}}</h3> </td>
                                <td class="qty"><h3>{{count($cwob)}}</h3> </td>
                                <td class="qty"><h3>{{number_format($jadwal->cwob * count($cwob))}}</h3> </td>
                            </tr>
                            @endif
                            @if (count($infant) > 0)
                            @php
                                $tot += $jadwal->infant * count($infant);
                            @endphp
                            <tr>
                                <td class="no">{{$counter++}}</td>
                                <td class="text-left">
                                    <h3>
                                        <span>Child With Bed Pax</span>
                                    </h3>
                                </td>
                                <td class="unit"><h3>{{number_format($jadwal->infant)}}</h3> </td>
                                <td class="qty"><h3>{{count($infant)}}</h3> </td>
                                <td class="qty"><h3>{{number_format($jadwal->infant * count($infant))}}</h3> </td>
                            </tr>
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
                            <tr>
                                <td class="no">{{$counter++}}</td>
                                <td class="text-left">
                                    <h3>
                                        <span>{{$excl['nama']}}</span>
                                    </h3>
                                </td>
                                <td class="unit"><h3>{{number_format($excl['harga'])}}</h3> </td>
                                <td class="qty"><h3>{{$excl['jumlah'] ?? 1}}</h3> </td>
                                <td class="qty"><h3>{{number_format($excl['harga'] * ($excl['jumlah'] ?? 1))}}</h3> </td>
                            </tr> 
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">SUBTOTAL</td>
                                <td>{{number_format($tot)}} IDR</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">Comm. x {{count($dewasa) + count($cwb) + count($cwob)}} Alltmt.</td>
                                <td style="color:red">- {{number_format($jadwal->commission * (count($dewasa) + count($cwb) + count($cwob)))}} IDR</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">GRAND TOTAL</td>
                                <td>{{number_format($tot - ($jadwal->commission * (count($dewasa) + count($cwb) + count($cwob))))}} IDR</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="thanks">Agent Paid</div>
					<div class="thankso"><b>{{number_format($booking->paid)}} IDR </b></div>
					<span class="thanksi" style="font-style:italic">* Cummulative Payment</span>
                </main>
                <footer>
                    Invoice was created on a computer and is valid without the signature and seal.
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div> 
    
</body>
</html>




