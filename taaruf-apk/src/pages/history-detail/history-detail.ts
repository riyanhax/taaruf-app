import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams,ModalController, ToastController } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';

/**
 * Generated class for the HistoryDetailPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-history-detail',
  templateUrl: 'history-detail.html',
})
export class HistoryDetailPage {
  proposal:any;
  userData:any=JSON.parse(localStorage.getItem('userData'));
  responseData:any;
  togglePressed:boolean=false;
  balasan:any={'respon':'','balasan_penerima':''};
  constructor(public navCtrl: NavController, public navParams: NavParams, private requestProvider:RequestProvider
,public modalCtrl: ModalController,private toastCtrl: ToastController) {
  	this.proposal = navParams.get('proposal');
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad HistoryDetailPage');
    if(this.proposal.id_penerima == this.userData.id && this.proposal.readed == 'no'){
    	this.readUpdate();
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


  profileDetail(profile) {
    let modal = this.modalCtrl.create('DetailPage', {
      profile:profile
    },
    {
      cssClass: 'detail-modal'
    });
    modal.present();
  }

  sendReply(){
    console.log('work');
    var valid = true;
    if(this.balasan.respon.length < 1){
        this.toast('Mohon pilih terima / tolak proposal terlebih dahulu');
        valid=false;
    }else if(this.balasan.balasan_penerima.length < 1){
        this.toast('Mohon isi pesan balasan terlebih dahulu');
        valid=false;
    }

    if(valid){
        console.log('valid')
        this.startSending();
    }
  }

  toggleReply(){
    console.log('pressed');
      if(this.togglePressed == false){
        this.togglePressed = true;
      }else{
        this.togglePressed = false;
      }
  }

  startSending(){

        var params = 'appproposal/balas?api_key='+this.userData.remember_token+'&proposal_id='+this.proposal.proposal_id+'&id_pengirim='+this.proposal.id_pengirim+'&balasan_penerima='+this.balasan.balasan_penerima+'&respon='+this.balasan.respon;
        this.requestProvider.getReq(params).then((result) =>{
          this.responseData = result;
          console.log(this.responseData);
          if(this.responseData.success == true){
            this.proposal.respon = this.balasan.respon;
            this.proposal.balasan_penerima = this.balasan.balasan_penerima;
            this.toast('Balasan berhasil dikirim');
          }else{
            this.toast('Balasan gagal dikirim');
          }

        }, (err) => {

          if(err.status == 500){
            this.toast('Mohon maaf terjadi kesalahan pada server kami. Coba beberapa saat lagi.');
          }else if (err.status == 0 ){
            this.toast('Tidak dapat terhubung, periksa koneksi internet anda');
          }
          console.log(err);
          
        });
    }

  

  readUpdate(){
        var params = 'appproposal/read?api_key='+this.userData.remember_token+'&proposal_id='+this.proposal.proposal_id;
        this.requestProvider.getReq(params).then((result) =>{
          this.responseData = result;
          console.log(this.responseData);
          if(this.responseData.success == true){
          	this.proposal.readed = "yes";
          }else{

          }

        }, (err) => {

          if(err.status == 500){
            this.toast('Mohon maaf terjadi kesalahan pada server kami. Coba beberapa saat lagi.');
          }else if (err.status == 0 ){
            this.toast('Tidak dapat terhubung, periksa koneksi internet anda');
          }
          console.log(err);
          
        });
  }
  }
