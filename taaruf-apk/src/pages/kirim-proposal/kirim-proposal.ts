import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams,ToastController,ModalController, LoadingController } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';


/**
 * Generated class for the KirimProposalPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-kirim-proposal',
  templateUrl: 'kirim-proposal.html',
})
export class KirimProposalPage {

  calon:any;
  isi:string="";
  responseData:any;
  userData:any=JSON.parse(localStorage.getItem('userData'));
  loader:any;
  constructor(public navCtrl: NavController,
    public modalCtrl: ModalController, public navParams: NavParams, 
    private toastCtrl: ToastController, private requestProvider:RequestProvider,
    public loading: LoadingController) {
  	this.calon = navParams.get('profile');
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad KirimProposalPage');
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

  kirim(){

    this.loader = this.loading.create({
      content: 'Sorting..',
    });

    this.loader.present();
    var params = 'appproposal/kirim?api_key='+this.userData.remember_token+'&isi_proposal='+this.isi+'&id_penerima='+this.calon.id;
    this.requestProvider.getReq(params).then((result) =>{
      this.responseData = result;
      console.log(this.responseData);
      if(this.responseData.success == true){
        this.loader.dismiss();
       	this.toast('Proposal berhasil dikirim');
       	this.navCtrl.setRoot('ProposalKirimPage');
      }else{
        this.loader.dismiss();
      	this.toast('terjadi kesalahan, proposal gagal dikirim');
      }

    }, (err) => {

      if(err.status == 500){
        this.loader.dismiss();
        this.toast('Mohon maaf terjadi kesalahan pada server kami. Coba beberapa saat lagi.');
      }else if (err.status == 0 ){
        this.loader.dismiss();
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
