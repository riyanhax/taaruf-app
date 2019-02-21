import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams,ToastController,ModalController } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';
import { RatingProvider } from '../../providers/rating/rating';


/**
 * Generated class for the CandidatePage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-candidate',
  templateUrl: 'candidate.html',
})
export class CandidatePage {

  responseData;
  profiles;
  userData:any=JSON.parse(localStorage.getItem('userData'));
  returned:boolean = false;
  constructor(public navCtrl: NavController, public navParams: NavParams, public modalCtrl: ModalController,
  	private requestProvider:RequestProvider,private toastCtrl: ToastController,public ratingProvider: RatingProvider) {

  	this.contentReq();

  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad CandidatePage');
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

    private contentReq(){
        var params = 'appcontent/calonpage?api_key='+this.userData.remember_token;
        this.requestProvider.getReq(params).then((result) =>{
          this.responseData = result;
          console.log(this.responseData);
          if(this.responseData.success == true){
            this.profiles = this.responseData.data;
            this.profiles = this.ratingProvider.generateRating(this.profiles,this.userData.kriteria,'data');
            console.log(this.profiles)
            this.returned = true;
          }else{
            this.returned = true;
            //this.contentReq();
          }

        }, (err) => {

          if(err.status == 500){
            this.returned = true;
            this.toast('Mohon maaf terjadi kesalahan pada server kami. Coba beberapa saat lagi.');
          }else if (err.status == 0 ){
            this.returned = true;
            this.toast('Tidak dapat terhubung, periksa koneksi internet anda');
          }
          
        });
  }


}
