import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController,LoadingController } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';
import { Camera, CameraOptions } from '@ionic-native/camera';
import { UrlProvider } from '../../providers/url/url';
import { Crop } from '@ionic-native/crop';
import { Base64 } from '@ionic-native/base64';
/**
 * Generated class for the ProfilePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-profile',
  templateUrl: 'profile.html',
})
export class ProfilePage {
  tags:any = [];
  profileData:any;
  responseData:any;
  pendidikan;
  userData:any=JSON.parse(localStorage.getItem('userData'));
  field_pend:any={'sd':false,'smp':false,'slta':false,'diploma':false,'s1':false,'s2':false,'s3':false,'lain':false,'nonformal':false};
  waktu_kajian;  
  sholat_sunnah;
  puasa_sunnah;
  juz_perhari;
  tempProfile:any={};
  sendData:{api_key:string,email:string,no_hp:string,profileData:Object}={'api_key':"",'email':"",'no_hp':"",'profileData':{}};
  emailFormat:any= /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  loader:any;
  tempImage;
  returned=false;
  url:string = this.urlProvider.storagePP;

  constructor(public navCtrl: NavController, public navParams: NavParams,
    private requestProvider:RequestProvider, //private alertCtrl: AlertController, 
    private toastCtrl: ToastController,public loading: LoadingController,private crop: Crop,
    private camera: Camera,private base64: Base64,
    private urlProvider:UrlProvider
    ){
  	this.datareq();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ProfilePage');
  }

  toggleHide(name:string){
  	if(this.profileData[name].status_hidden == 'false'){
  		this.profileData[name].status_hidden =  'true';
  	}else{
  		this.profileData[name].status_hidden =  'false';
  	}
  	
  }

  makefield(){
  	console.log('apa');
  	this.field_pend = {'sd':false,'smp':false,'slta':false,'diploma':false,'s1':false,'s2':false,'s3':false,'lain':false,'nonformal':false};
  	var index;
  	for (var i = 0; i < this.pendidikan.length; ++i) {
  		 index = this.pendidikan[i];
  		this.field_pend[index] = true;
  	}
  }


//jum_adek = jumlah - anak ke jum_kakak = jumlah-(jumlah-anake)+1

  /*saudaraCorrection(event){
console.log('jalan');
  	if(this.profileData.jumlah_saudara.data_varchar < this.profileData.anak_ke.data_varchar ){
  		this.profileData.jumlah_saudara.data_varchar = 0;
  		console.log('a');
  	}else{
  		console.log('ok');
  		var jumlah = parseInt(this.profileData.jumlah_saudara.data_varchar);
  		var anak_ke = parseInt(this.profileData.anak_ke.data_varchar);
  		this.kakak = jumlah-((jumlah-anak_ke)+1);
  		this.adik = jumlah-anak_ke;
  	}
  } */
  datareq(){
	    var params = 'appcontent/profilepage?api_key='+this.userData.remember_token;
        this.requestProvider.getReq(params).then((result) =>{
          this.responseData = result;
          console.log(this.responseData);
          if(this.responseData.success == true){
            this.profileData	 = this.responseData.data;
            //this.tempProfile = JSON.parse(JSON.stringify(this.profileData));
            console.log(this.responseData);
            this.returned=true;
          }else{

            //this.contentReq();
            this.returned=true;
          }

        }, (err) => {

          if(err.status == 500){
            this.toast('Mohon maaf terjadi kesalahan pada server kami. Coba beberapa saat lagi.');
          }else if (err.status == 0 ){
            this.toast('Tidak dapat terhubung, periksa koneksi internet anda');
          }
          
        });
  }
  onChange(val){
    console.log(this.tags);
  }

  send(){
  	if(this.profileData.status_pernikahan.data_varchar == 'belum'){
  		this.profileData.jumlah_anak.required ='false';
  	}else{
  		this.profileData.jumlah_anak.required ='true';
  	}

  	if(this.profileData.tipe_pekerjaan.data_varchar != 'pns'){
  		this.profileData.golongan_pekerjaan.required ='false';
  	}else{
  		this.profileData.golongan_pekerjaan.required ='true';
  	}

  	if(this.profileData.nama_asli.status_hidden == 'false'){
  		this.profileData.nama_samaran.required ='false';
  	}else{
  		this.profileData.nama_samaran.required ='true';
  	}

  	if(this.profileData.apakah_ikut_kajian_rutin.data_varchar == 'ya'){
  		this.profileData.apakah_ikut_kajian_rutin.data_varchar = this.profileData.apakah_ikut_kajian_rutin.data_varchar+', '+this.waktu_kajian;
  	}

  	if(this.profileData.membaca_alquran.data_varchar == 'Komitmen'){
  		this.profileData.membaca_alquran.data_varchar = 'Komitmen, '+this.juz_perhari+' perhari';
  	}

  	if(this.profileData.sholat_sunnah.data_varchar == "Komitmen"){
  		this.profileData.sholat_sunnah.data_varchar = this.profileData.sholat_sunnah.data_varchar+', '+this.sholat_sunnah;
  	}
    if(this.profileData.penghasilan_pekerjaan.data_integer != null){
      this.profileData.penghasilan_pekerjaan.data_varchar = this.profileData.penghasilan_pekerjaan.data_integer+'jt ';
      this.profileData.penghasilan_pekerjaan.data_varchar += this.profileData.penghasilan_pekerjaan.data_integer+'juta ';
      this.profileData.penghasilan_pekerjaan.data_varchar += this.profileData.penghasilan_pekerjaan.data_integer+' jt ';
      this.profileData.penghasilan_pekerjaan.data_varchar += this.profileData.penghasilan_pekerjaan.data_integer+' juta ';
      console.log(this.profileData.penghasilan_pekerjaan.data_varchar);
      
    }

  	console.log(this.profileData);

  	var valid = true;
  	for (var key in this.profileData) {
  		if(this.profileData[key].required == 'true'){

  			if(this.profileData[key].data_type == 'varchar'){
  				if(this.profileData[key].data_varchar == null || this.profileData[key].data_varchar == "" || !this.profileData[key].data_varchar.replace(/\s/g, '').length){
  					valid = false;
  					console.log(key);
  				}
  			}else if(this.profileData[key].data_type == 'date' ){
				if(this.profileData[key].data_date == null || this.profileData[key].data_date.length < 1 ){
  					valid = false;
  					console.log(key);
  				}
  			}else if(this.profileData[key].data_type == 'integer'){
        if(!this.profileData[key].data_integer){
            valid = false;
            console.log(key);
          }
        }
  			
  		}
  	//this.profileData[key].required
    //var value = this.profileData[key];
    //console.log(key, value);
	}

     if(this.emailFormat.test(this.userData.email) == false){
       this.toast('Masukan email dengan format yang benar');
       valid=false;
     }

  	if(valid){
  		console.log('send');   
      this.sendData.api_key = this.userData.remember_token;
      this.sendData.profileData =this.profileData;
      this.sendData.email = this.userData.email;
      this.sendData.no_hp = this.userData.no_hp;
      this.startsending(this.sendData);
  	}else{
  		this.toast('Mohon lengkapi kolom yang bertanda * terlebih dahulu.');
  	}
  }

  toast(message) {
    let toast = this.toastCtrl.create({
      message: message,
      duration: 3000,
      position: 'bottom',
      cssClass:"toast-styles"
    });

    toast.onDidDismiss(() => {
      console.log('Dismissed toast');
    });

    toast.present();
  }


  startsending(dataparam){

   this.loader = this.loading.create({
    content: 'Melakukan perubahan..',
   });

    this.loader.present().then(()=>{
        this.requestProvider.postReq('appprofile/update',dataparam).then((result) =>{
        this.responseData = result;
         this.toast('Profile berhasil diubah') 
         console.log(result);  
         localStorage.setItem('userData',JSON.stringify(this.responseData.profile));
           this.loader.dismiss();
        }, (err) => {

          console.log(err);
          this.loader.dismiss();
        });

      });
  }


  takepic(sourceType:number){
    
    const options: CameraOptions = {
      quality: 75,
      destinationType: this.camera.DestinationType.DATA_URL,
      encodingType: this.camera.EncodingType.JPEG,
      mediaType: this.camera.MediaType.PICTURE,      
      correctOrientation: true,
      sourceType:sourceType,
    }

  //   this.camera.getPicture(options).then((imageData) => {
  //    return this.crop.crop(imageData, { quality: 75 });
  //  }).then(croppedImagePath => {
  //    return this.base64.encodeFile(croppedImagePath);
  //  }).then(base64Data => {
      //this.updateLogo(base64Data);
   //   this.tempImage = 'data:image/jpeg;base64,' + base64Data;
  //    this.profileData.foto.data_varchar = this.tempImage;
  //  }).catch(err => {
  //    console.log(err);
  //  });

   this.camera.getPicture(options).then((imageData) => {
     // imageData is either a base64 encoded string or a file URI
     // If it's base64:
     this.tempImage = 'data:image/jpeg;base64,' + imageData;
     this.profileData.foto.data_varchar = this.tempImage;
    });

  }



}
