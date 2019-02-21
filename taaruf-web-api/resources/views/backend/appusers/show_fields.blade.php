

<?php

if($profile['foto'] != null){
    $fotopengirim = $profile['foto'];
    $location ='profile_pic';    
}else if($profile['foto'] == null && $appusers->gender == 'P' ){
    $fotopengirim = 'akhwat.png';
    $location ='media';
}else{
    $fotopengirim = 'ikhwan.png';
    $location ='media';
}
?>



<div class="col-md-6  col-lg-6 col-sm-12">
<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $appusers->id !!}</p>
</div>

<!-- Gender Field -->
<div class="form-group">
    {!! Form::label('gender', 'Gender:') !!}
    <p>{!! $appusers->gender !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $appusers->email !!}</p>
</div>

<!-- No Hp Field -->
<div class="form-group">
    {!! Form::label('no_hp', 'No Hp:') !!}
    <p>{!! $appusers->no_hp !!}</p>
</div>

<!-- Otp Code Field -->
<div class="form-group">
    {!! Form::label('otp_code', 'Otp Code:') !!}
    <p>{!! $appusers->otp_code !!}</p>
</div>

<!-- Verified Field -->
<div class="form-group">
    {!! Form::label('verified', 'Verified:') !!}
    <p>{!! $appusers->verified !!}</p>
</div>

<!-- Remember Token Field -->
<div class="form-group">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    <p>{!! $appusers->remember_token !!}</p>
</div>

<!-- Device Id Field -->
<div class="form-group">
    {!! Form::label('device_id', 'Device Id:') !!}
    <p>{!! $appusers->device_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $appusers->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $appusers->updated_at !!}</p>
</div>

</div>



<div class="col-md-6 col-lg-6 col-sm-12" style="overflow:auto; height:100vh"> 
        <h6>Data Diri Pengirim</h6>
    <hr>


    <img style="margin:auto;width:150px;height:150px;" 
    src="{{url('')}}/{{$location}}/{{$fotopengirim}}">
    <div class="form-group">
        {!! Form::label('nama_asli', 'Nama Asli:') !!}
        <p>{!! $profile['nama_asli']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('nama_samaran', 'Nama Samaran:') !!}
        <p>{!! $profile['nama_samaran']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('status_pernikahan', 'Status Pernikahan:') !!}
        <p>{!! $profile['status_pernikahan']!!}, @if($profile['jumlah_anak']!= null ) Anak {{$profile['jumlah_anak']['data_varchar']}} @endif</p>
    </div>

    <div class="form-group">
        {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
        <p>{!! $profile['tanggal_lahir']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('hobby', 'Hobby:') !!}
        <p>{!! $profile['hobby']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('keahlian', 'Keahlian:') !!}
        <p>{!! $profile['keahlian']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('nomor_telp', 'Nomor Telp:') !!}
        <p>{!! $profile['nomor_telp']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tipe_tandapengenal', 'Tipe Tanda Pengenal:') !!}
        <p>{!! $profile['tipe_tandapengenal']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('nomor_tandapengenal', 'Nomor Tanda Pengenal:') !!}
        <p>{!! $profile['nomor_tandapengenal']!!}</p>
    </div>

    <br>
    <h6>Alamat KTP</h6>
    <hr>
    <div class="form-group">
        {!! Form::label('nama_jalan_ktp', 'Nama Jalan:') !!}
        <p>{!! $profile['nama_jalan_ktp']!!}</p>
    </div>
    <div class="form-group">
        {!! Form::label('ktp_rtrw', 'RT / RW:') !!}
        <p>{!! $profile['ktp_rtrw']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kelurahan', 'Kelurahan:') !!}
        <p>{!! $profile['ktp_kelurahan']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kecamatan', 'Kecamatan:') !!}
        <p>{!! $profile['ktp_kecamatan']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kotakab', 'Kota / Kabupaten:') !!}
        <p>{!! $profile['ktp_kotakab']!!}</p>
    </div>
    <div class="form-group">
        {!! Form::label('ktp_provinsi', 'Provinsi:') !!}
        <p>{!! $profile['ktp_provinsi']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('ktp_kodepos', 'Kode Pos:') !!}
        <p>{!! $profile['ktp_kodepos']!!}</p>
    </div>
    <br>
    <h6>Alamat Tinggal</h6>
    <hr>
    <div class="form-group">
        {!! Form::label('tinggal_sda_ktp', 'Alamat Tinggal Sama Dengan KTP:') !!}
        <p>{!! $profile['tinggal_sda_ktp']!!}</p>
    </div>
    @if( $profile['tinggal_sda_ktp']!= 'sama')
    <div class="form-group">
        {!! Form::label('tinggal_nama_jalan', 'Nama Jalan:') !!}
        <p>{!! $profile['tinggal_nama_jalan']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_rtrw', 'RT / RW:') !!}
        <p>{!! $profile['tinggal_rtrw']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kelurahan', 'Kelurahan:') !!}
        <p>{!! $profile['tinggal_kelurahan']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kecamatan', 'Kecamatan:') !!}
        <p>{!! $profile['tinggal_kecamatan']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kotakab', 'Kota / Kabupaten:') !!}
        <p>{!! $profile['tinggal_kotakab']!!}</p>
    </div>
    <div class="form-group">
        {!! Form::label('tinggal_provinsi', 'Provinsi:') !!}
        <p>{!! $profile['tinggal_provinsi']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('tinggal_kodepos', 'Kode Pos:') !!}
        <p>{!! $profile['tinggal_kodepos']!!}</p>
    </div>

    @endif
    <br>
    <h6>Pendidikan</h6>
    <hr>
    @if($profile['pend_sd']!= null)
    <div class="form-group">
        {!! Form::label('pend_sd', 'SD:') !!}
        <p>{!! $profile['pend_sd']!!}</p>
    </div>
    @endif

    @if($profile['pend_smp']!= null)
    <div class="form-group">
        {!! Form::label('pend_smp', 'SMP:') !!}
        <p>{!! $profile['pend_smp']!!}</p>
    </div>

    @if($profile['pend_slta']!= null)
    <div class="form-group">
        {!! Form::label('pend_slta', 'SLTA:') !!}
        <p>{!! $profile['pend_slta']!!}</p>
    </div>
    @endif

    @if($profile['pend_diploma']!= null)
    <div class="form-group">
        {!! Form::label('pend_diploma', 'Diploma:') !!}
        <p>{!! $profile['pend_diploma']!!}</p>
    </div>
    @endif

    @if($profile['pend_s1']!= null)
    <div class="form-group">
        {!! Form::label('pend_s1', 'S1:') !!}
        <p>{!! $profile['pend_s1']!!}</p>
    </div>
    @endif

    @if($profile['pend_s2']!= null)
    <div class="form-group">
        {!! Form::label('pend_s2', 'S2:') !!}
        <p>{!! $profile['pend_s2']!!}</p>
    </div>
    @endif

    @if($profile['pend_s3']!= null)
    <div class="form-group">
        {!! Form::label('pend_s3', 'S3:') !!}
        <p>{!! $profile['pend_s3']!!}</p>
    </div>
    @endif

    @if($profile['pend_lain']!= null)
    <div class="form-group">
        {!! Form::label('pend_lain', 'Lain-lain:') !!}
        <p>{!! $profile['pend_lain']!!}</p>
    </div>
    @endif

    @if($profile['pend_nonformal']!= null)
    <div class="form-group">
        {!! Form::label('pend_nonformal', 'Non-formal:') !!}
        <p>{!! $profile['pend_nonformal']!!}</p>
    </div>
    @endif

    <br>
    <h6>Pekerjaan</h6>
    <hr>

    
    <div class="form-group">
        {!! Form::label('nama_pekerjaan', 'Nama Pekerjaan:') !!}
        <p>{!! $profile['nama_pekerjaan']!!}</p>
    </div>
    @endif

    <div class="form-group">
        {!! Form::label('tipe_pekerjaan', 'Tipe Pekerjaan:') !!}
        <p>{!! $profile['tipe_pekerjaan']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('golongan_pekerjaan', 'Golongan Pekerjaan:') !!}
        <p>{!! $profile['golongan_pekerjaan']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('penghasilan_pekerjaan', 'Penghasilan perbulan:') !!}
        <p>{!! $profile['penghasilan_pekerjaan']!!}</p>
    </div>

    <br>
    <h6>Fisik</h6>
    <hr>

    <div class="form-group">
        {!! Form::label('tinggi_badan', 'Tinggi Badan:') !!}
        <p>{!! $profile['tinggi_badan']!!} cm</p>
    </div>

    <div class="form-group">
        {!! Form::label('berat_badan', 'Berat Badan:') !!}
        <p>{!! $profile['berat_badan']!!} Kg</p>
    </div>

    <div class="form-group">
        {!! Form::label('warna_kulit', 'Warna Kulit:') !!}
        <p>{!! $profile['warna_kulit']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('penilaian_wajah', 'Penilaian Wajah:') !!}
        <p>{!! $profile['penilaian_wajah']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('riwayat_penyakit', 'Riwayat Penyakit:') !!}
        <p>{!! $profile['riwayat_penyakit']!!}</p>
    </div>

    <br>
    <h6>Keluarga</h6>
    <hr>

    <div class="form-group">
        {!! Form::label('tinggal_bersama', 'Tinggal bersama:') !!}
        <p>{!! $profile['tinggal_bersama']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('pekerjaan_ayah', 'Pekerjaan Ayah:') !!}
        <p>{!! $profile['pekerjaan_ayah']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('pekerjaan_ibu', 'Pekerjaan Ibu:') !!}
        <p>{!! $profile['pekerjaan_ibu']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('anak_ke', 'Anak ke:') !!}
        <p>{!! $profile['anak_ke']!!} dari 
            {!! $profile['jumlah_saudara']!!} Bersaudara
        </p>
    </div>

    <div class="form-group">
        {!! Form::label('jum_kakak', 'Jumlah kakak:') !!}
        <p>Total {!! $profile['jum_kakak']!!}, 
            {!! $profile['jum_kakak_laki']!!} Lk, {!! $profile['jum_kakak_perem']!!} Pr

        </p>
    </div>

    <div class="form-group">
        {!! Form::label('jum_adik', 'Jumlah Adik:') !!}
        <p>Total{!! $profile['jum_adik']!!}, 
            {!! $profile['jum_adik_laki']!!} Lk, {!! $profile['jum_adik_perem']!!} Pr
        </p>
    </div>

    <br>
    <h6>Keislaman</h6>
    <hr>

        <div class="form-group">
        {!! Form::label('apakah_ikut_kajian_rutin', 'Apakah ikut kajian rutin:') !!}
        <p>{!! $profile['apakah_ikut_kajian_rutin']!!}</p>
    </div>

        <div class="form-group">
        {!! Form::label('solat_5_waktu', 'Sholat 5 Waktu:') !!}
        <p>{!! $profile['solat_5_waktu']!!}</p>
    </div>

        <div class="form-group">
        {!! Form::label('membaca_alquran', 'Membaca Alquran:') !!}
        <p>{!! $profile['membaca_alquran']!!}</p>
    </div>


    <div class="form-group">
        {!! Form::label('sholat_sunnah', 'Sholat Sunnah:') !!}
        <p>{!! $profile['sholat_sunnah']!!}</p>
    </div>


    <div class="form-group">
        {!! Form::label('puasa_sunnah', 'Puasa Sunnah:') !!}
        <p>{!! $profile['puasa_sunnah']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('afiliasi_keagamaan', 'Afilasi Keagamaan:') !!}
        <p>{!! $profile['afiliasi_keagamaan']!!}</p>
    </div>
    @if(isset($profile['min_usia']['data_integer']))
    <br>
    <h6>Kriteria yang dicari</h6>
    <hr>

    <div class="form-group">
        {!! Form::label('usia', 'Usia:') !!}
        <p>{!! $profile['min_usia']!!} - {!! $profile['max_usia']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('berat', 'Berat:') !!}
        <p>{!! $profile['min_berat']!!} - {!! $profile['max_berat']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('kriteria_afiliasi_keagamaan', 'Afilasi Keagamaan:') !!}
        <p>{!! $profile['kriteria_afiliasi_keagamaan']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('pendidikan_minimal', 'Afilasi Keagamaan:') !!}
        <p>{!! $profile['pendidikan_minimal']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('kriteria_status', 'Afilasi Keagamaan:') !!}
        <p>{!! $profile['kriteria_status']!!}</p>
    </div>

    <div class="form-group">
        {!! Form::label('minimum_penghasilan', 'Minimum Penghasilan:') !!}
        <p>{!! $profile['minimum_penghasilan']!!}</p>
    </div>

    @endif

    












</div>

