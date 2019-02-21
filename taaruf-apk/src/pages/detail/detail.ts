import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ViewController, ToastController } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';

/**
 * Generated class for the DetailPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-detail',
  templateUrl: 'detail.html',
})
export class DetailPage {

  profile:any;
  userData:any=JSON.parse(localStorage.getItem('userData'));
  responseData:any;
  mapType:string;

  constructor(public navCtrl: NavController, public navParams: NavParams, public viewCtrl: ViewController, private toastCtrl: ToastController, 
    private requestProvider:RequestProvider) {
    this.profile = navParams.get('profile');
    if(navParams.get('mapType') == 'search'){
       this.mapType = navParams.get('mapType');
    }else{
      this.mapType = 'normal';
    }
    console.log(this.mapType);
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad DetailPage');
  }

  dismiss() {
  	this.viewCtrl.dismiss();
  }

  add(){
    this.profile.bookmarked = this.userData.id;
    var params = 'appbookmark/addCalon?api_key='+this.userData.remember_token+'&id_calon='+this.profile.id;
    this.requestProvider.getReq(params).then((result) =>{
      this.responseData = result;
      console.log(this.responseData);
      if(this.responseData.success == true){
        this.toast('Seseorang berhasil ditambahkan ke bookmark anda');
        
      }else{
        this.toast(this.responseData.message);
      }

    }, (err) => {
      if(err.status == 500){
        this.toast('Mohon maaf terjadi kesalahan pada server kami. Coba beberapa saat lagi.');
      }else if (err.status == 0 ){
        this.toast('Tidak dapat terhubung, periksa koneksi internet anda');
      }
    });

  }

  remove(){
    this.profile.bookmarked = null;
    var params = 'appbookmark/removeCalon?api_key='+this.userData.remember_token+'&id_calon='+this.profile.id;
    this.requestProvider.getReq(params).then((result) =>{
      this.responseData = result;
      console.log(this.responseData);
      if(this.responseData.success == true){
        this.toast('Seseorang berhasil dihapuskan dari bookmark anda');
        
      }else{
        this.toast(this.responseData.message);
      }

    }, (err) => {
      if(err.status == 500){
        this.toast('Mohon maaf terjadi kesalahan pada server kami. Coba beberapa saat lagi.');
      }else if (err.status == 0 ){
        this.toast('Tidak dapat terhubung, periksa koneksi internet anda');
      }
    });

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
}
