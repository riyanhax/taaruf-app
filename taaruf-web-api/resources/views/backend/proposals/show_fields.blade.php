<hr> 

<?php


if($profiles['pengirim']['foto'] != null){
    $fotopengirim = $profiles['pengirim']['foto'];
     $location ='profile_pic';
}else if($profiles['pengirim']['foto'] == null && $gender['pengirim']['gender'] == 'P' ){
    $fotopengirim = 'akhwat.png';
    $location ='media';
}else{
    $fotopengirim = 'ikhwan.png';
    $location ='media';
}

if($profiles['penerima']['foto'] != null){
    $fotopenerima = $profiles['penerima']['foto'];
    $location ='profile_pic';
}else if($profiles['penerima']['foto'] == null && $gender['penerima']['gender'] == 'P' ){
    $fotopenerima = 'akhwat.png';
    $location ='media';
}else{
    $fotopenerima = 'ikhwan.png';
    $location ='media';
}

?>

<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="form-group">
        {!! Form::label('respon', 'Respon:') !!}
        <p>{!! $proposal->respon !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('isi_proposal', 'Isi Proposal:') !!}
        <p>{!! $proposal->isi_proposal !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('balasan_penerima', 'Balasan Penerima:') !!}
        <p>{!! $proposal->balasan_penerima !!}</p>
    </div>
    <hr> 
</div>
<!-- pengirim -->
<div class="col-lg-6 col-md-6 col-sm-12" style="overflow:auto;height:100vh;">
    <h6>Data Diri Pengirim</h6>
    <hr>


    <img style="margin:auto;width:150px;height:150px;" 
    src="{{url('')}}/{{$location}}/{{$fotopengirim}}">
    <div class="form-group">
        {!! Form::label('nama_asli', 'Nama Asli:') !!}
        <p>{!! $profiles['pengirim']['nama_asli'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('nama_samaran', 'Nama Samaran:') !!}
        <p>{!! $profiles['pengirim']['nama_samaran'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('status_pernikahan', 'Status Pernikahan:') !!}
        <p>{!! $profiles['pengirim']['status_pernikahan'] !!}, @if($profiles['pengirim']['jumlah_anak'] != null ) Anak {{$profiles['pengirim']['jumlah_anak']}} @endif</p>
    </div>

    <div class="form-group">
        {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
        <p>{!! $profiles['pengirim']['tanggal_lahir'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('hobby', 'Hobby:') !!}
        <p>{!! $profiles['pengirim']['hobby'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('keahlian', 'Keahlian:') !!}
        <p>{!! $profiles['pengirim']['keahlian'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('nomor_telp', 'Nomor Telp:') !!}
        <p>{!! $profiles['pengirim']['nomor_telp'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tipe_tandapengenal', 'Tipe Tanda Pengenal:') !!}
        <p>{!! $profiles['pengirim']['tipe_tandapengenal'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('nomor_tandapengenal', 'Nomor Tanda Pengenal:') !!}
        <p>{!! $profiles['pengirim']['nomor_tandapengenal'] !!}</p>
    </div>

    <br>
    <h6>Alamat KTP</h6>
    <hr>
    <div class="form-group">
        {!! Form::label('nama_jalan_ktp', 'Nama Jalan:') !!}
        <p>{!! $profiles['pengirim']['nama_jalan_ktp'] !!}</p>
    </div>
    <div class="form-group">
        {!! Form::label('ktp_rtrw', 'RT / RW:') !!}
        <p>{!! $profiles['pengirim']['ktp_rtrw'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kelurahan', 'Kelurahan:') !!}
        <p>{!! $profiles['pengirim']['ktp_kelurahan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kecamatan', 'Kecamatan:') !!}
        <p>{!! $profiles['pengirim']['ktp_kecamatan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kotakab', 'Kota / Kabupaten:') !!}
        <p>{!! $profiles['pengirim']['ktp_kotakab'] !!}</p>
    </div>
    <div class="form-group">
        {!! Form::label('ktp_provinsi', 'Provinsi:') !!}
        <p>{!! $profiles['pengirim']['ktp_provinsi'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kodepos', 'Kode Pos:') !!}
        <p>{!! $profiles['pengirim']['ktp_kodepos'] !!}</p>
    </div>
    <br>
    <h6>Alamat Tinggal</h6>
    <hr>
    <div class="form-group">
        {!! Form::label('tinggal_sda_ktp', 'Alamat Tinggal Sama Dengan KTP:') !!}
        <p>{!! $profiles['pengirim']['tinggal_sda_ktp'] !!}</p>
    </div>
    @if( $profiles['pengirim']['tinggal_sda_ktp'] != 'sama')
    <div class="form-group">
        {!! Form::label('tinggal_nama_jalan', 'Nama Jalan:') !!}
        <p>{!! $profiles['pengirim']['tinggal_nama_jalan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_rtrw', 'RT / RW:') !!}
        <p>{!! $profiles['pengirim']['tinggal_rtrw'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kelurahan', 'Kelurahan:') !!}
        <p>{!! $profiles['pengirim']['tinggal_kelurahan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kecamatan', 'Kecamatan:') !!}
        <p>{!! $profiles['pengirim']['tinggal_kecamatan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kotakab', 'Kota / Kabupaten:') !!}
        <p>{!! $profiles['pengirim']['tinggal_kotakab'] !!}</p>
    </div>
    <div class="form-group">
        {!! Form::label('tinggal_provinsi', 'Provinsi:') !!}
        <p>{!! $profiles['pengirim']['tinggal_provinsi'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kodepos', 'Kode Pos:') !!}
        <p>{!! $profiles['pengirim']['tinggal_kodepos'] !!}</p>
    </div>

    @endif
    <br>
    <h6>Pendidikan</h6>
    <hr>
    @if($profiles['pengirim']['pend_sd'] != null)
    <div class="form-group">
        {!! Form::label('pend_sd', 'SD:') !!}
        <p>{!! $profiles['pengirim']['pend_sd'] !!}</p>
    </div>
    @endif

    @if($profiles['pengirim']['pend_smp'] != null)
    <div class="form-group">
        {!! Form::label('pend_smp', 'SMP:') !!}
        <p>{!! $profiles['pengirim']['pend_smp'] !!}</p>
    </div>

    @if($profiles['pengirim']['pend_slta'] != null)
    <div class="form-group">
        {!! Form::label('pend_slta', 'SLTA:') !!}
        <p>{!! $profiles['pengirim']['pend_slta'] !!}</p>
    </div>
    @endif

    @if($profiles['pengirim']['pend_diploma'] != null)
    <div class="form-group">
        {!! Form::label('pend_diploma', 'Diploma:') !!}
        <p>{!! $profiles['pengirim']['pend_diploma'] !!}</p>
    </div>
    @endif

    @if($profiles['pengirim']['pend_s1'] != null)
    <div class="form-group">
        {!! Form::label('pend_s1', 'S1:') !!}
        <p>{!! $profiles['pengirim']['pend_s1'] !!}</p>
    </div>
    @endif

    @if($profiles['pengirim']['pend_s2'] != null)
    <div class="form-group">
        {!! Form::label('pend_s2', 'S2:') !!}
        <p>{!! $profiles['pengirim']['pend_s2'] !!}</p>
    </div>
    @endif

    @if($profiles['pengirim']['pend_s3'] != null)
    <div class="form-group">
        {!! Form::label('pend_s3', 'S3:') !!}
        <p>{!! $profiles['pengirim']['pend_s3'] !!}</p>
    </div>
    @endif

    @if($profiles['pengirim']['pend_lain'] != null)
    <div class="form-group">
        {!! Form::label('pend_lain', 'Lain-lain:') !!}
        <p>{!! $profiles['pengirim']['pend_lain'] !!}</p>
    </div>
    @endif

    @if($profiles['pengirim']['pend_nonformal'] != null)
    <div class="form-group">
        {!! Form::label('pend_nonformal', 'Non-formal:') !!}
        <p>{!! $profiles['pengirim']['pend_nonformal'] !!}</p>
    </div>
    @endif

    <br>
    <h6>Pekerjaan</h6>
    <hr>

    
    <div class="form-group">
        {!! Form::label('nama_pekerjaan', 'Nama Pekerjaan:') !!}
        <p>{!! $profiles['pengirim']['nama_pekerjaan'] !!}</p>
    </div>
    @endif

    <div class="form-group">
        {!! Form::label('tipe_pekerjaan', 'Tipe Pekerjaan:') !!}
        <p>{!! $profiles['pengirim']['tipe_pekerjaan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('golongan_pekerjaan', 'Golongan Pekerjaan:') !!}
        <p>{!! $profiles['pengirim']['golongan_pekerjaan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('penghasilan_pekerjaan', 'Penghasilan perbulan:') !!}
        <p>{!! $profiles['pengirim']['penghasilan_pekerjaan'] !!}</p>
    </div>

    <br>
    <h6>Fisik</h6>
    <hr>

    <div class="form-group">
        {!! Form::label('tinggi_badan', 'Tinggi Badan:') !!}
        <p>{!! $profiles['pengirim']['tinggi_badan'] !!} cm</p>
    </div>

    <div class="form-group">
        {!! Form::label('berat_badan', 'Berat Badan:') !!}
        <p>{!! $profiles['pengirim']['berat_badan'] !!} Kg</p>
    </div>

    <div class="form-group">
        {!! Form::label('warna_kulit', 'Warna Kulit:') !!}
        <p>{!! $profiles['pengirim']['warna_kulit'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('penilaian_wajah', 'Penilaian Wajah:') !!}
        <p>{!! $profiles['pengirim']['penilaian_wajah'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('riwayat_penyakit', 'Riwayat Penyakit:') !!}
        <p>{!! $profiles['pengirim']['riwayat_penyakit'] !!}</p>
    </div>

    <br>
    <h6>Keluarga</h6>
    <hr>

    <div class="form-group">
        {!! Form::label('tinggal_bersama', 'Tinggal bersama:') !!}
        <p>{!! $profiles['pengirim']['tinggal_bersama'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('pekerjaan_ayah', 'Pekerjaan Ayah:') !!}
        <p>{!! $profiles['pengirim']['pekerjaan_ayah'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('pekerjaan_ibu', 'Pekerjaan Ibu:') !!}
        <p>{!! $profiles['pengirim']['pekerjaan_ibu'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('anak_ke', 'Anak ke:') !!}
        <p>{!! $profiles['pengirim']['anak_ke'] !!} dari 
            {!! $profiles['pengirim']['jumlah_saudara'] !!} Bersaudara
        </p>
    </div>

    <div class="form-group">
        {!! Form::label('jum_kakak', 'Jumlah kakak:') !!}
        <p>Total {!! $profiles['pengirim']['jum_kakak'] !!}, 
            {!! $profiles['pengirim']['jum_kakak_laki'] !!} Lk, {!! $profiles['pengirim']['jum_kakak_perem'] !!} Pr

        </p>
    </div>

    <div class="form-group">
        {!! Form::label('jum_adik', 'Jumlah Adik:') !!}
        <p>Total{!! $profiles['pengirim']['jum_adik'] !!}, 
            {!! $profiles['pengirim']['jum_adik_laki'] !!} Lk, {!! $profiles['pengirim']['jum_adik_perem'] !!} Pr
        </p>
    </div>

    <br>
    <h6>Keislaman</h6>
    <hr>

        <div class="form-group">
        {!! Form::label('apakah_ikut_kajian_rutin', 'Apakah ikut kajian rutin:') !!}
        <p>{!! $profiles['pengirim']['apakah_ikut_kajian_rutin'] !!}</p>
    </div>

        <div class="form-group">
        {!! Form::label('solat_5_waktu', 'Sholat 5 Waktu:') !!}
        <p>{!! $profiles['pengirim']['solat_5_waktu'] !!}</p>
    </div>

        <div class="form-group">
        {!! Form::label('membaca_alquran', 'Membaca Alquran:') !!}
        <p>{!! $profiles['pengirim']['membaca_alquran'] !!}</p>
    </div>


    <div class="form-group">
        {!! Form::label('sholat_sunnah', 'Sholat Sunnah:') !!}
        <p>{!! $profiles['pengirim']['sholat_sunnah'] !!}</p>
    </div>


    <div class="form-group">
        {!! Form::label('puasa_sunnah', 'Puasa Sunnah:') !!}
        <p>{!! $profiles['pengirim']['puasa_sunnah'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('afiliasi_keagamaan', 'Afilasi Keagamaan:') !!}
        <p>{!! $profiles['pengirim']['afiliasi_keagamaan'] !!}</p>
    </div>
    @if(isset($profiles['pengirim']['min_usia']))
    <br>
    <h6>Kriteria yang dicari</h6>
    <hr>

    <div class="form-group">
        {!! Form::label('usia', 'Usia:') !!}
        <p>{!! $profiles['pengirim']['min_usia'] !!} - {!! $profiles['pengirim']['max_usia'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('berat', 'Berat:') !!}
        <p>{!! $profiles['pengirim']['min_berat'] !!} - {!! $profiles['pengirim']['max_berat'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('kriteria_afiliasi_keagamaan', 'Afilasi Keagamaan:') !!}
        <p>{!! $profiles['pengirim']['kriteria_afiliasi_keagamaan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('pendidikan_minimal', 'Afilasi Keagamaan:') !!}
        <p>{!! $profiles['pengirim']['pendidikan_minimal'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('kriteria_status', 'Afilasi Keagamaan:') !!}
        <p>{!! $profiles['pengirim']['kriteria_status'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('minimum_penghasilan', 'Minimum Penghasilan:') !!}
        <p>{!! $profiles['pengirim']['minimum_penghasilan'] !!}</p>
    </div>

    @endif

    













</div>

<!-- penerima -->
<div class="col-lg-6 col-md-6 col-sm-12" style="overflow:auto;height:100vh;">
    <h6>Data Diri Penerima</h6>
    <hr>


    <img style="margin:auto;width:150px;height:150px;" src="{{url('')}}/{{$location}}/{{$fotopenerima}}">
    <div class="form-group">
        {!! Form::label('nama_asli', 'Nama Asli:') !!}
        <p>{!! $profiles['penerima']['nama_asli'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('nama_samaran', 'Nama Samaran:') !!}
        <p>{!! $profiles['penerima']['nama_samaran'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('status_pernikahan', 'Status Pernikahan:') !!}
        <p>{!! $profiles['penerima']['status_pernikahan'] !!}, @if($profiles['penerima']['jumlah_anak'] != null ) Anak {{$profiles['penerima']['jumlah_anak']}} @endif</p>
    </div>

    <div class="form-group">
        {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
        <p>{!! $profiles['penerima']['tanggal_lahir'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('hobby', 'Hobby:') !!}
        <p>{!! $profiles['penerima']['hobby'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('keahlian', 'Keahlian:') !!}
        <p>{!! $profiles['penerima']['keahlian'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('nomor_telp', 'Nomor Telp:') !!}
        <p>{!! $profiles['penerima']['nomor_telp'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tipe_tandapengenal', 'Tipe Tanda Pengenal:') !!}
        <p>{!! $profiles['penerima']['tipe_tandapengenal'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('nomor_tandapengenal', 'Nomor Tanda Pengenal:') !!}
        <p>{!! $profiles['penerima']['nomor_tandapengenal'] !!}</p>
    </div>

    <br>
    <h6>Alamat KTP</h6>
    <hr>
    <div class="form-group">
        {!! Form::label('nama_jalan_ktp', 'Nama Jalan:') !!}
        <p>{!! $profiles['penerima']['nama_jalan_ktp'] !!}</p>
    </div>
    <div class="form-group">
        {!! Form::label('ktp_rtrw', 'RT / RW:') !!}
        <p>{!! $profiles['penerima']['ktp_rtrw'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kelurahan', 'Kelurahan:') !!}
        <p>{!! $profiles['penerima']['ktp_kelurahan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kecamatan', 'Kecamatan:') !!}
        <p>{!! $profiles['penerima']['ktp_kecamatan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kotakab', 'Kota / Kabupaten:') !!}
        <p>{!! $profiles['penerima']['ktp_kotakab'] !!}</p>
    </div>
    <div class="form-group">
        {!! Form::label('ktp_provinsi', 'Provinsi:') !!}
        <p>{!! $profiles['penerima']['ktp_provinsi'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kodepos', 'Kode Pos:') !!}
        <p>{!! $profiles['penerima']['ktp_kodepos'] !!}</p>
    </div>
    <br>
    <h6>Alamat Tinggal</h6>
    <hr>
    <div class="form-group">
        {!! Form::label('tinggal_sda_ktp', 'Alamat Tinggal Sama Dengan KTP:') !!}
        <p>{!! $profiles['penerima']['tinggal_sda_ktp'] !!}</p>
    </div>
    @if( $profiles['penerima']['tinggal_sda_ktp'] != 'sama')
    <div class="form-group">
        {!! Form::label('tinggal_nama_jalan', 'Nama Jalan:') !!}
        <p>{!! $profiles['penerima']['tinggal_nama_jalan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_rtrw', 'RT / RW:') !!}
        <p>{!! $profiles['penerima']['tinggal_rtrw'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kelurahan', 'Kelurahan:') !!}
        <p>{!! $profiles['penerima']['tinggal_kelurahan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kecamatan', 'Kecamatan:') !!}
        <p>{!! $profiles['penerima']['tinggal_kecamatan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kotakab', 'Kota / Kabupaten:') !!}
        <p>{!! $profiles['penerima']['tinggal_kotakab'] !!}</p>
    </div>
    <div class="form-group">
        {!! Form::label('tinggal_provinsi', 'Provinsi:') !!}
        <p>{!! $profiles['penerima']['tinggal_provinsi'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kodepos', 'Kode Pos:') !!}
        <p>{!! $profiles['penerima']['tinggal_kodepos'] !!}</p>
    </div>

    @endif
    <br>
    <h6>Pendidikan</h6>
    <hr>
    @if($profiles['penerima']['pend_sd'] != null)
    <div class="form-group">
        {!! Form::label('pend_sd', 'SD:') !!}
        <p>{!! $profiles['penerima']['pend_sd'] !!}</p>
    </div>
    @endif

    @if($profiles['penerima']['pend_smp'] != null)
    <div class="form-group">
        {!! Form::label('pend_smp', 'SMP:') !!}
        <p>{!! $profiles['penerima']['pend_smp'] !!}</p>
    </div>

    @if($profiles['penerima']['pend_slta'] != null)
    <div class="form-group">
        {!! Form::label('pend_slta', 'SLTA:') !!}
        <p>{!! $profiles['penerima']['pend_slta'] !!}</p>
    </div>
    @endif

    @if($profiles['penerima']['pend_diploma'] != null)
    <div class="form-group">
        {!! Form::label('pend_diploma', 'Diploma:') !!}
        <p>{!! $profiles['penerima']['pend_diploma'] !!}</p>
    </div>
    @endif

    @if($profiles['penerima']['pend_s1'] != null)
    <div class="form-group">
        {!! Form::label('pend_s1', 'S1:') !!}
        <p>{!! $profiles['penerima']['pend_s1'] !!}</p>
    </div>
    @endif

    @if($profiles['penerima']['pend_s2'] != null)
    <div class="form-group">
        {!! Form::label('pend_s2', 'S2:') !!}
        <p>{!! $profiles['penerima']['pend_s2'] !!}</p>
    </div>
    @endif

    @if($profiles['penerima']['pend_s3'] != null)
    <div class="form-group">
        {!! Form::label('pend_s3', 'S3:') !!}
        <p>{!! $profiles['penerima']['pend_s3'] !!}</p>
    </div>
    @endif

    @if($profiles['penerima']['pend_lain'] != null)
    <div class="form-group">
        {!! Form::label('pend_lain', 'Lain-lain:') !!}
        <p>{!! $profiles['penerima']['pend_lain'] !!}</p>
    </div>
    @endif

    @if($profiles['penerima']['pend_nonformal'] != null)
    <div class="form-group">
        {!! Form::label('pend_nonformal', 'Non-formal:') !!}
        <p>{!! $profiles['penerima']['pend_nonformal'] !!}</p>
    </div>
    @endif

    <br>
    <h6>Pekerjaan</h6>
    <hr>

    
    <div class="form-group">
        {!! Form::label('nama_pekerjaan', 'Nama Pekerjaan:') !!}
        <p>{!! $profiles['penerima']['nama_pekerjaan'] !!}</p>
    </div>
    @endif

    <div class="form-group">
        {!! Form::label('tipe_pekerjaan', 'Tipe Pekerjaan:') !!}
        <p>{!! $profiles['penerima']['tipe_pekerjaan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('golongan_pekerjaan', 'Golongan Pekerjaan:') !!}
        <p>{!! $profiles['penerima']['golongan_pekerjaan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('penghasilan_pekerjaan', 'Penghasilan perbulan:') !!}
        <p>{!! $profiles['penerima']['penghasilan_pekerjaan'] !!}</p>
    </div>

    <br>
    <h6>Fisik</h6>
    <hr>

    <div class="form-group">
        {!! Form::label('tinggi_badan', 'Tinggi Badan:') !!}
        <p>{!! $profiles['penerima']['tinggi_badan'] !!} cm</p>
    </div>

    <div class="form-group">
        {!! Form::label('berat_badan', 'Berat Badan:') !!}
        <p>{!! $profiles['penerima']['berat_badan'] !!} Kg</p>
    </div>

    <div class="form-group">
        {!! Form::label('warna_kulit', 'Warna Kulit:') !!}
        <p>{!! $profiles['penerima']['warna_kulit'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('penilaian_wajah', 'Penilaian Wajah:') !!}
        <p>{!! $profiles['penerima']['penilaian_wajah'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('riwayat_penyakit', 'Riwayat Penyakit:') !!}
        <p>{!! $profiles['penerima']['riwayat_penyakit'] !!}</p>
    </div>

    <br>
    <h6>Keluarga</h6>
    <hr>

    <div class="form-group">
        {!! Form::label('tinggal_bersama', 'Tinggal bersama:') !!}
        <p>{!! $profiles['penerima']['tinggal_bersama'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('pekerjaan_ayah', 'Pekerjaan Ayah:') !!}
        <p>{!! $profiles['penerima']['pekerjaan_ayah'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('pekerjaan_ibu', 'Pekerjaan Ibu:') !!}
        <p>{!! $profiles['penerima']['pekerjaan_ibu'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('anak_ke', 'Anak ke:') !!}
        <p>{!! $profiles['penerima']['anak_ke'] !!} dari 
            {!! $profiles['penerima']['jumlah_saudara'] !!} Bersaudara
        </p>
    </div>

    <div class="form-group">
        {!! Form::label('jum_kakak', 'Jumlah kakak:') !!}
        <p>Total {!! $profiles['penerima']['jum_kakak'] !!}, 
            {!! $profiles['penerima']['jum_kakak_laki'] !!} Lk, {!! $profiles['penerima']['jum_kakak_perem'] !!} Pr

        </p>
    </div>

    <div class="form-group">
        {!! Form::label('jum_adik', 'Jumlah Adik:') !!}
        <p>Total{!! $profiles['penerima']['jum_adik'] !!}, 
            {!! $profiles['penerima']['jum_adik_laki'] !!} Lk, {!! $profiles['penerima']['jum_adik_perem'] !!} Pr
        </p>
    </div>

    <br>
    <h6>Keislaman</h6>
    <hr>

        <div class="form-group">
        {!! Form::label('apakah_ikut_kajian_rutin', 'Apakah ikut kajian rutin:') !!}
        <p>{!! $profiles['penerima']['apakah_ikut_kajian_rutin'] !!}</p>
    </div>

        <div class="form-group">
        {!! Form::label('solat_5_waktu', 'Sholat 5 Waktu:') !!}
        <p>{!! $profiles['penerima']['solat_5_waktu'] !!}</p>
    </div>

        <div class="form-group">
        {!! Form::label('membaca_alquran', 'Membaca Alquran:') !!}
        <p>{!! $profiles['penerima']['membaca_alquran'] !!}</p>
    </div>


    <div class="form-group">
        {!! Form::label('sholat_sunnah', 'Sholat Sunnah:') !!}
        <p>{!! $profiles['penerima']['sholat_sunnah'] !!}</p>
    </div>


    <div class="form-group">
        {!! Form::label('puasa_sunnah', 'Puasa Sunnah:') !!}
        <p>{!! $profiles['penerima']['puasa_sunnah'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('afiliasi_keagamaan', 'Afilasi Keagamaan:') !!}
        <p>{!! $profiles['penerima']['afiliasi_keagamaan'] !!}</p>
    </div>
    @if(isset($profiles['penerima']['min_usia']))
    <br>
    <h6>Kriteria yang dicari</h6>
    <hr>

    <div class="form-group">
        {!! Form::label('usia', 'Usia:') !!}
        <p>{!! $profiles['penerima']['min_usia'] !!} - {!! $profiles['penerima']['max_usia'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('berat', 'Berat:') !!}
        <p>{!! $profiles['penerima']['min_berat'] !!} - {!! $profiles['penerima']['max_berat'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('kriteria_afiliasi_keagamaan', 'Afilasi Keagamaan:') !!}
        <p>{!! $profiles['penerima']['kriteria_afiliasi_keagamaan'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('pendidikan_minimal', 'Afilasi Keagamaan:') !!}
        <p>{!! $profiles['penerima']['pendidikan_minimal'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('kriteria_status', 'Afilasi Keagamaan:') !!}
        <p>{!! $profiles['penerima']['kriteria_status'] !!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('minimum_penghasilan', 'Minimum Penghasilan:') !!}
        <p>{!! $profiles['penerima']['minimum_penghasilan'] !!}</p>
    </div>

    @endif

    














</div>