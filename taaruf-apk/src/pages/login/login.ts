import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, AlertController, LoadingController, MenuController } from 'ionic-angular';
//import { Validators, FormBuilder, FormGroup } from '@angular/forms';
import { RequestProvider } from '../../providers/request/request';
/**
 * Generated class for the LoginPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {

  email:any="";
  re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  loader:any;
  responseData:any;
  constructor(public navCtrl: NavController, 
    public navParams: NavParams,private alertCtrl: AlertController, private menu: MenuController,
   public loading: LoadingController, private requestProvider:RequestProvider
    ){
    
  }

  ionViewDidLoad() {
  }

  register() {
  	this.navCtrl.setRoot('RegisterPage');
  }
  ionViewWillEnter(){
    this.menu.swipeEnable(false);
  }

  login() {

    if(/^\d+$/.test(this.email)){
      if(this.email.charAt(0) == "0"){
        this.email='+62'+this.email.substr(1);
      }
        this.sendreq('mobile');
        console.log('mobile');
    }else if(this.re.test(this.email)){
      this.sendreq('email');
      console.log('email');
    }else{
      let alert = this.alertCtrl.create({
        subTitle: 'Mohon isi kolom dengan email atau nomor handphone',
        buttons: ['Dismiss']
      });
      alert.present();
      console.log('alert');
    }

    //this.navCtrl.setRoot('VerifyPage');
  }

  sendreq(paramName){
      
      this.loader = this.loading.create({
        content: 'Tunggu..',
       });
      var params = 'appauth/login?'+paramName+'='+this.email;

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
          }else{
            let alert = this.alertCtrl.create({
              subTitle: 'Email atau Nomor yang anda masukan salah atau tidak terdaftar',
              buttons: ['Dismiss']
            });
            alert.present();
          }

        }, (err) => {
          this.responseData = err;
          console.log(this.responseData);
          this.loader.dismiss();
        });
      });

      
  }
}
