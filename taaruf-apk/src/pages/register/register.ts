import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, AlertController, LoadingController,MenuController } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';
/**
 * Generated class for the RegisterPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-register',
  templateUrl: 'register.html',
})
export class RegisterPage {
  phone:any;
  email:any;
  gender:string;
  validated:boolean;
  re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  loader:any;
  responseData:any;
  constructor(public navCtrl: NavController, private alertCtrl: AlertController, private menu: MenuController,
    public navParams: NavParams, public loading: LoadingController, private requestProvider:RequestProvider) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad RegisterPage');
  }
  ionViewWillEnter(){
    this.menu.swipeEnable(false);
  }

  register(){

    this.validated=true;

    if(/^\d+$/.test(this.phone) ==  false || this.phone.charAt(0) != "0"){
      let alert = this.alertCtrl.create({
        subTitle: 'Mohon isi nomor handphone anda dengan benar (tanpa kode negara) contoh : 081xxx',
        buttons: ['Dismiss']
      });
      alert.present();
      this.validated=false;
    }

    if(this.re.test(this.email) == false ){
      let alert = this.alertCtrl.create({
        subTitle: 'Mohon isi email anda dengan benar',
        buttons: ['Dismiss']
      });
      alert.present();
      this.validated=false;
    }


    if(this.gender.length < 1){
      let alert = this.alertCtrl.create({
        subTitle: 'Mohon pilih jenis kelamin terlebih dahulu',
        buttons: ['Dismiss']
      });
      alert.present();
      this.validated=false;
    }

    if(this.validated){

      if(this.phone.charAt(0) == "0"){
        this.phone='62'+this.phone.substr(1);
      }

      this.sendreq();

    }
  }


sendreq(){
      
      this.loader = this.loading.create({
        content: 'Tunggu..',
       });
      var params = 'appauth/register?email='+this.email+'&no_hp='+this.phone+'&gender='+this.gender;

      this.loader.present().then(()=>{
        this.requestProvider.getReq(params).then((result) =>{
          this.responseData = result;
          console.log(this.responseData);
          this.loader.dismiss();

          if(this.responseData.success == true){
                  let alert = this.alertCtrl.create({
        subTitle: this.responseData.code+', alert kode ini akan hilang jika app sudah production',
        buttons: ['Dismiss']
      });
      alert.present();
            localStorage.setItem('otpData', JSON.stringify(this.responseData.data));
            this.navCtrl.setRoot('VerifyPage');
          }else if(this.responseData.error.length > 0 ){

            for (var i = 0; i < this.responseData.error.length; i++) {
              let alert = this.alertCtrl.create({
                subTitle: this.responseData.error[i],
                buttons: ['Dismiss']
              });
              alert.present();
            }

          } /*else{
              let alert = this.alertCtrl.create({
                subTitle: this.responseData.message,
                buttons: ['Dismiss']
              });
              alert.present();
          } */


        }, (err) => {
          this.responseData = err;
          console.log(this.responseData);
          this.loader.dismiss();
        });
      });

      
  }

  login() {
  	this.navCtrl.setRoot('LoginPage');
  }
}
