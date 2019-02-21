import { Component } from '@angular/core';
import { AlertController, IonicPage, NavController, NavParams, ModalController,ToastController } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';
import { DomSanitizer, SafeResourceUrl } from '@angular/platform-browser';
import { InAppBrowser } from "@ionic-native/in-app-browser";
import { UrlProvider } from '../../providers/url/url';
import { RatingProvider } from '../../providers/rating/rating';

/**
 * Generated class for the HomePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-home',
  templateUrl: 'home.html',
})
export class HomePage {

  loader:any;
  responseData:any;
  homeCont:any={'blogs':[],'banner':[],'slider':[]};
  userData:any=JSON.parse(localStorage.getItem('userData'));
  url:string = this.urlProvider.storageImgUrl;
  keywords;
  constructor(public navCtrl: NavController, 
    public navParams: NavParams, 
    public modalCtrl: ModalController,
    private alertCtrl: AlertController, 
    private requestProvider:RequestProvider,
    private _sanitizer: DomSanitizer,
    private iab: InAppBrowser, 
    private toastCtrl: ToastController,
    private urlProvider:UrlProvider, 
    public ratingProvider: RatingProvider
    ){

    this.contentReq();
    
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad HomePage');
    
  }
  ionViewCanEnter() {
    if(this.userData.verified == 'false'){

        let alert = this.alertCtrl.create({
         title:'Profil anda belum lengkap!',
        subTitle: 'Data profil anda belum lengkap, agar profil anda bisa di lihat oleh peserta taaruf lain<br>anda harus melengkapi profil anda terlebih dahulu.',
        buttons: ['Dismiss']
      });
      alert.present();
      this.navCtrl.setRoot('ProfilePage');
    }
  }

  find(){
    this.navCtrl.push('ListPage',{
      keywords:this.keywords
    });
  }

  getBackground(image) {
    return this._sanitizer.bypassSecurityTrustStyle(`url(${image})`);
  }
  openurl(url){
    const browser = this.iab.create(url,'_system');
  }


  slideDetail(slide){
    this.navCtrl.push('SliderDetailPage', {
      slide:slide 
    });
  }

  contentReq(){
        var params = 'appcontent/homepage?api_key='+this.userData.remember_token;
        this.requestProvider.getReq(params).then((result) =>{
          this.responseData = result;
          console.log(this.responseData);
          if(this.responseData.success == true){
            this.homeCont = this.responseData.data;
            this.homeCont.profile = this.ratingProvider.generateRating(this.homeCont.profile,this.userData.kriteria,'data');
            console.log(this.homeCont.profile);
          }else{

            //this.contentReq();
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

  profileDetail(profile) {
  	let modal = this.modalCtrl.create('DetailPage', {
      profile:profile
  	},
  	{
  		cssClass: 'detail-modal'
  	});
  	modal.present();
  }

  viewAll() {
    this.navCtrl.push('ListPage');
  }

  blogDetail(blog) {
    console.log(blog);
    console.log('func');
    
    this.navCtrl.push('BlogDetailPage', {
      blog:blog 
    });
    //this.navCtrl.push('BlogDetailPage');
  }

  profile() {
    this.navCtrl.push('ProfilePage');
  }

  bookmark() {
    this.navCtrl.push('BookmarkPage');
  }

  blog() {
    this.navCtrl.push('BlogPage');
  }

  city() {
    this.navCtrl.push('CityPage');
  }

  candidate() {
    this.navCtrl.push('CandidatePage');
  }


}
