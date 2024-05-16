    @extends('layout.guest')
    @section('title')
    <title> Agent Registration </title>
    @endsection

    @section('content')
         <!-- page content -->
    <div class="right_cola" role="main">
        <div class="">
          <div style="background-color:#8DC63F">
            <div  style="background-color:#8DC63F">
              <h3 style="color:white">Agent Registration</h3>
            </div>
          </div>
       

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">

                  <form class="form-horizontal form-label-left" action="{{route('request-agent.store')}}" method="post">
                    @csrf
                    <span class="section">Personal Info</span>

                    <div class="item form-group">
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
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Agency Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="nama" placeholder="both name(s) e.g Jon Doe" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Address <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="address" required="required" name="address" class="form-control col-md-7 col-xs-12"></textarea>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Office Phone Number <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="nomor_kantor" name="nomor_kantor" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">PIC Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="pic" name="pic" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Designation <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="designation" name="designation" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Phone Number <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="hp" type="text" name="hp" class="optional form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="ln_solid"></div>
					  <div class="item form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <div class="terms-text" style="max-height: 200px; overflow-y: auto; background-color:#eeeeee">
				  <p style="text-align:center"><b>Syarat Ketentuan</b></p>
                <p>Syarat dan Ketentuan

Syarat dan Ketentuan ini berlaku untuk pada situs IndoTravelStore Wholesaler www.indotravelstore.com (“Situs”).

Syarat dan Ketentuan ini merupakan perjanjian sah yang berlaku dan mengikat Pengguna dengan Kami sehubungan dengan penggunaan Situs. Dengan mengunjungi atau menggunakan Situs ini, Anda dengan ini Anda telah memahami dan menyetujui serta terikat dan tunduk dengan segala syarat dan ketentuan yang berlaku di Situs ini. Jika anda tidak setuju, maka Anda tidak dapat menggunakan Situs ini dan melakukan semua layanan dan produk yang ada di Situs ini.<br><br>

1.	Tentang IndoTravelStore Wholesaler<br><br>

IndoTravelStore Wholesaler dibawah manajemen PT. Indah Tamasya Sentosa, suatu perseroan terbatas yang didirikan berdasarkan hukum negara Republik Indonesia, berkedudukan di  Kabupaten Tangerang (“Kami”) adalah Pemilik dan Operator Situs. Situs, modul, pengaturan dan konten yang terdapat dalam Situs merupakan hak cipta milik PT. Indah Tamasya Sentosa dan atau/pihak ketiga penyedia dan distributor yang memegang lisensi PT. Indah Tamasya Sentosa.<br><br>

2.	Perubahan dan/atau Pembaharuan Syarat dan Ketentuan Situs<br><br>

Seiring berkembangnya IndoTravelStore Wholesaler, Kami juga dapat melakukan perubahan atau pembaharuan pada Syarat dan Ketentuan di Situs Kami. Syarat dan Ketentuan yang telah dilakukan perubahan atau pembaharuan akan segera berlaku setelah perubahan tersebut dicantumkan di Situs ini.<br><br>

3.	Pembatasan Penggunaan<br><br>

Penggunaan situs ini hanya terbatas pada rekan agent yang sudah terdaftar dan yang sudah diberikan akses pada sistem Kami. Dengan penggunaan Situs ini, Anda menyetujui dan bertanggung jawab bahwa:<br>
a.	Anda hanya melakukan pemesanan dan/atau pembelian layanan kami. <br>
b.	Anda dilarang keras untuk melakukan  penyalahgunaan Situs ini untuk hal-hal lain, termasuk namun tidak terbatas pada melakukan pemesanan atau pemesanan fiktif.<br>
c.	Anda dilarang keras untuk menggunakan alamat email fiktif atau data pribadi palsu.<br>
d.	Anda dilarang menggunakan perangkat lunak atau dengan cara apapun untuk mengganggu kinerja pada Situs Kami;<br>
e.	Anda dilarang keras menyebarkan virus atau seluruh teknologi lainnya yang sejenis yang dapat merusak dan/atau merugikan Situs Kami;<br>
f.	Anda tidak melakukan penyalahgunaan Situs kami untuk Tindakan yang melawan hukum.<br><br>

4.	Kebijakan Privasi<br><br>


Kebijakan Privasi ini merupakan komitmen IndoTravelStore untuk menghargai dan melindungi setiap data atau informasi yang dikaitkan pada individu tertentu yang termasuk namun tidak terbatas pada identitas, nama pribadi, nomor kartu kredit, nomor rekening, alamat (“Data Pribadi”).

Dengan menggunakan Situs ini, Anda menyetujui bahwa jika Anda memberitahukan Data Pribadi apapun kepada kami, maka kami akan melakukan pengolahan, penganalisisan, penampilan, pengiriman, pembukaan, penyimpanan, perubahan, penghapusan dan/atau segala bentuk pengelolaan yang terkait dengan Data Pribadi.<br><br>

5.	Pemesanan Produk dan Layanan<br><br>

Dengan memesan melalui Situs, Anda dengan ini menyetujui untuk menerima persyaratan layanan dari IndoTravelStore maupun Pihak Ketiga. 

IndoTravelStore Wholesaler tidak bertanggung jawab atas pelanggaran ketentuan layanan yang ditentukan oleh Pihak Ketiga seperti maskapai penerbangan, hotel, kereta api, agen perjalanan, dan lainnya) atau ketersediaan atas permintaan Anda sebagai Rekan Agent atau individu.<br><br>

6.	Pembatalan<br><br>

Dengan melakukan pemesanan melalui Situs kami, Anda menyetujui bahwa Anda dianggap telah mengerti, memahami, menerima dan menyetujui kebijakan dan ketentuan pembatalan baik dari Kami maupun Pihak Ketiga sebagai penyedia layanan. Jika Anda melakukan perubahan atau pembatalan pesanan Anda dapat dikenakan biaya baik biaya administrasi maupun biaya yang timbul sebagai akibat pembatalan yang akan Anda tanggung sepenuhnya.<br><br>

7.	Penutup<br><br>
a.	Setiap perselisihan dan perbedaan interpretasi terhadap Syarat dan Ketentuan ini akan diselesaikan oleh Para Pihak secara musyawarah mufakat dan apabila musyawarah mufakat tidak tercapai maka Para Pihak dengan ini sepakat untuk menyelesaikan perselisihan di Pengadilan Negeri Tangerang.<br>
b.	Ketentuan khusus mengenai pemesanan Group Series merupakan bagian Syarat dan Ketentuan dan terlampir pada Situs ini.<br>
c.	Versi asli dari Syarat dan Ketentuan ini adalah dalam Bahasa Indonesia, dan dapat diterjemahkan ke dalam bahasa lain. Versi terjemahan dibuat untuk memberi kemudahan bagi pengunjung dan/atau pengguna asing, dan tidak bisa dianggap sebagai terjemahan resmi. Dan jika ditemukan perbedaan antara versi bahasa Indonesia dan bahasa lainnya dari Syarat dan Ketentuan ini, maka yang berlaku dan mengikat adalah versi Bahasa Indonesia.
</p>
              </div>
            </div>
          </div>
					  <div class="ln_solid"></div>
					   <div class="item form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <div class="terms-text">
                <p>By submitting this form, you agree to the following terms and conditions:</p>
                <p>By registering as an agent, you agree to act in accordance with our company's policies and guidelines, undertaking responsibilities honestly and diligently. You commit to maintaining the confidentiality of sensitive information, promoting our services ethically, and refraining from any activities that could compromise the reputation or integrity of our brand. Your registration signifies your consent to receive communications from us and acknowledges your compliance with relevant legal requirements. We reserve the right to review and terminate your registration if your actions are found to be inconsistent with our standards.</p>
              </div>
            </div>
          </div>
					  <div class="ln_solid"></div>
					<div class="form-group">
  						<div class="col-md-6 col-md-offset-3">
    						<input type="checkbox" id="terms-checkbox" required>
    						<label for="terms-checkbox">I have read, understood, and accept all Terms and conditions by IndoTravelStore Wholesaler.</label>
  						</div>
					</div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Cancel</button>
                        <button id="submit-btn" type="submit" class="btn btn-success" disabled>Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<script>
  const termsCheckbox = document.getElementById('terms-checkbox');
  const submitBtn = document.getElementById('submit-btn');

  termsCheckbox.addEventListener('change', function() {
    submitBtn.disabled = !termsCheckbox.checked;
  });
</script>
      <!-- /page content -->
    @endsection
   