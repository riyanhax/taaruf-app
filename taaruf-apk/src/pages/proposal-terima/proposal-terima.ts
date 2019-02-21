import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams,ToastController } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';
import { RatingProvider } from '../../providers/rating/rating';


/**
 * Generated class for the ProposalKirimPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-proposal-terima',
  templateUrl: 'proposal-terima.html',
})
export class ProposalTerimaPage {
  responseData:any;
  list:any = false;
  userData:any=JSON.parse(localStorage.getItem('userData'));
  page:number=1;
  last_page:number;
  returned=false;

  constructor(public navCtrl: NavController, public navParams: NavParams
    , private toastCtrl: ToastController, private requestProvider: RequestProvider
    ,public ratingProvider: RatingProvider){
  	this.listReq();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ProposalKirimPage');
  }
  detail(proposal) {
  	this.navCtrl.push('HistoryDetailPage',{
  		proposal:proposal
  	});
  }

  private listReq():void{

    var params = 'appproposal/receivedlist?api_key='+this.userData.remember_token+'&page='+this.page;
    this.requestProvider.getReq(params).then((result) =>{
      this.responseData = result;
      console.log(this.responseData);
      if(this.responseData.success == true){
        this.list = this.responseData.data.list;
        this.list = this.ratingProvider.generateRating(this.list,this.userData.kriteria,'data');
         this.last_page = this.responseData.data.last_page;
         this.returned = true;
      }else{
          this.returned = true;
      }

    }, (err) => {
	     if(err.status == 500){
	        this.toast('Mohon maaf terjadi kesalahan pada server kami. Coba beberapa saat lagi.');
          this.returned = true;
	      }else if (err.status == 0 ){
	        this.toast('Tidak dapat terhubung, periksa koneksi internet anda');
          this.returned = true;
	      }
      
    });

  }

    doInfinite(infiniteScroll) {
    console.log()
    var newListData:any;
    console.log('Begin async operation');
    if(this.page < this.last_page){
      setTimeout(() => {

      this.page = this.page+1;
      
      var params = 'appproposal/receivedlist?api_key='+this.userData.remember_token+'&page='+this.page;
      this.requestProvider.getReq(params).then((result) => {
        this.responseData = result;
        if(this.responseData.success == true){

          newListData = this.responseData.data.list;
          newListData = this.ratingProvider.generateRating(newListData,this.userData.kriteria,'data');
          this.last_page = this.responseData.last_page;
          for(var i=0;i<newListData.length;i++){
            this.list.push(newListData[i]);
          }
          console.log(this.list);

        }else{
          console.log(this.responseData);
        }
        
       
        
      }, (err) => {
          if(err.status == 500){
            this.toast('Mohon maaf terjadi kesalahan pada server kami. Coba beberapa saat lagi.');
          }else if (err.status == 0 ){
            this.toast('Tidak dapat terhubung, periksa koneksi internet anda');
          }
      });
      

      console.log('Async operation has ended');
      infiniteScroll.complete();
    }, 500);

    }else{
      console.log('its the last page');
      infiniteScroll.complete();
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

}
