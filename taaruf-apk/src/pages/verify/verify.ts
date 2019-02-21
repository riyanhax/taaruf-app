import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, AlertController, LoadingController, MenuController } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';
/**
 * Generated class for the VerifyPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-verify',
  templateUrl: 'verify.html',
})
export class VerifyPage {

   boolresend:boolean=false;
   otpData:any=JSON.parse(localStorage.getItem('otpData'));
   loader:any;
   responseData:any;
   code1:any;
   code2:any;
   code3:any;
   code4:any;
   code:any;
   validated:boolean;
  constructor(public navCtrl: NavController, public navParams: NavParams, private menu: MenuController,
    public loading: LoadingController, private alertCtrl: AlertController,
    private requestProvider:RequestProvider) {
  }

  ionViewDidLoad() {
    this.countdown();
  
  }
  ionViewWillEnter(){
    this.menu.swipeEnable(false);
  }
  ionViewWillLeave() {
    this.menu.swipeEnable(true);
  }



  countdown(){

    let time = document.getElementById('time'),
    timer = 59;

    let counting = setInterval(() => {
      timer -= 1;
      if(timer == 0){
        clearInterval(counting);
        this.boolresend = true;
      }

      time.innerHTML = '00:' + timer;

    }, 1000);

  }

  verify(){

    this.validated=false;
    if(this.code1 != null && this.code2 != null && this.code3 != null && this.code4 != null ){
      this.code = this.code1.toString()+this.code2.toString()+this.code3.toString()+this.code4.toString();
      console.log(this.code1+','+this.code2+','+this.code3+','+this.code4);
      console.log(this.code);
      this.validated= true;
       if(this.code.length > 4 || this.code.length < 4){
         let alert = this.alertCtrl.create({
            subTitle: 'Kode yang anda masukan salah, Kode minimal atau maksimal 4 digit angka',
            buttons: ['Dismiss']
          });
          alert.present();
         this.validated=false;
  
       }
     }else{
          let alert = this.alertCtrl.create({
            subTitle: 'Kode yang anda masukan salah, lengkapi ke empat digit angka',
            buttons: ['Dismiss']
          });
          alert.present();
     }

     if(this.validated == true){
        this.loader = this.loading.create({
           content: 'Tunggu..',
          });
         var params = 'appauth/otpVerify?email='+this.otpData.email+'&code='+this.code
   
         this.loader.present().then(()=>{
           this.requestProvider.getReq(params).then((result) =>{
             this.responseData = result;
             console.log(this.responseData);
             this.loader.dismiss();

             if(this.responseData.success == true){
               localStorage.setItem('userData',JSON.stringify(this.responseData.data));
               this.saveDeviceID(this.responseData.data.remember_token);
               this.navCtrl.setRoot('HomePage');
             }else{
                let alert = this.alertCtrl.create({
                  subTitle: this.responseData.message,
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

  resend(){
      this.loader = this.loading.create({
        content: 'Tunggu..',
       });
      var params = 'appauth/login?email='+this.otpData.email

      this.loader.present().then(()=>{
        this.requestProvider.getReq(params).then((result) =>{
          this.responseData = result;
          console.log(this.responseData);
          this.loader.dismiss();

          if(this.responseData.success == true){
            let alert = this.alertCtrl.create({
              subTitle: 'Kode Berhasil dikirim',
              buttons: ['Dismiss']
            });
            alert.present();
          }else{
            let alert = this.alertCtrl.create({
              subTitle: "Kode Gagal dikirim, mohon coba beberapa saat lagi atau hubungi CS Ta'aruf Syar'i",
              buttons: ['Dismiss']
            });
            alert.present();
          }
        }, (err) => {
          this.responseData = err;
          console.log(this.responseData);
          this.loader.dismiss();

           let alert = this.alertCtrl.create({
              subTitle: "Kode Gagal dikirim, mohon coba beberapa saat lagi atau hubungi CS Ta'aruf Syar'i",
              buttons: ['Dismiss']
            });
            alert.present();
        });
      });
  }

  login() {
   let alert = this.alertCtrl.create({
    message: 'Dengan melakukan ini anda akan membatalkan verifikasi, yakin?',
    buttons: [
      {
        text: 'Kembali',
        role: 'cancel',
        handler: () => {
          // result = false;
        }
      },
      {
        text: 'Yakin',
        handler: () => {
           this.navCtrl.setRoot('LoginPage');
        }
      }
    ]});
    alert.present();
  }

  saveDeviceID(api_key){

   var temp = localStorage.getItem('deviceData');
   
   if(temp != null){

    var device_id = temp;
    var params = 'appauth/savedeviceid?api_key='+api_key+'&device_id='+device_id;
     this.requestProvider.getReq(params).then((result) =>{
       console.log(result);
     }, (err) => {
       console.log(err);
     });

    }

  }

  register(){
   let alert = this.alertCtrl.create({
    message: 'Dengan melakukan ini anda akan membatalkan verifikasi, yakin?',
    buttons: [
      {
        text: 'Kembali',
        role: 'cancel',
        handler: () => {
          // result = false;
        }
      },
      {
        text: 'Yakin',
        handler: () => {
           this.navCtrl.setRoot('RegisterPage');
        }
      }
    ]});
    alert.present();
  }

  alertsure(){
    var result;

  }

}