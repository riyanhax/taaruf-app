import { Component } from '@angular/core';
import { AlertController,IonicPage, NavController, NavParams, ModalController,LoadingController,ToastController } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';
import { RatingProvider } from '../../providers/rating/rating';
/**
 * Generated class for the ListPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-list',
  templateUrl: 'list.html',
})
export class ListPage {

  responseData:any;
  calons:any=false;
  last_page:number;
  page:number=1;
  userData:any = JSON.parse(localStorage.getItem('userData'));
  returned:boolean=false;
  q;
  orderby="nama_asli";
  ordertype="asc";
  sorting = false;
  loader:any;
  constructor(public navCtrl: NavController, public navParams: NavParams, public modalCtrl: ModalController
    ,public ratingProvider: RatingProvider,public loading: LoadingController,
     private requestProvider:RequestProvider,private alertCtrl: AlertController,private toastCtrl: ToastController) {
     if(this.navParams.get('keywords') != null){
          this.q=this.navParams.get('keywords');
      }else{
        this.q="";
      }
    this.listReq();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad ListPage');
  }

  listReq(){

    if(this.sorting == true){
      this.loader = this.loading.create({
        content: 'Sorting..',
       });
      this.loader.present();
    }

    var params = 'search?api_key='+this.userData.remember_token+'&q='+this.q+'&orderby='+this.orderby+'&ordertype='+this.ordertype+'&page='+this.page;
    this.requestProvider.getReq(params).then((result) =>{
      this.responseData = result;
      console.log(this.responseData);
      if(this.responseData.success == true){
        
        //console.log(this.responseData.data);
        this.calons=this.responseData.data;
        this.calons=this.ratingProvider.generateRating(this.calons,this.userData.kriteria,'profiledata_data');
        //this.last_page = this.responseData.data.last_page;
        console.log('asdsa');
        console.log(this.calons);
        if(this.sorting == true){
          this.loader.dismiss();
        }
        this.sorting=false;
        this.returned = true;
      }else{
        if(this.sorting){
          this.loader.dismiss();
        }
        console.log(this.responseData);
        this.returned = true;
        this.sorting=false;
      }

    }, (err) => {
      if(this.sorting){
          this.loader.dismiss();
        }
      this.responseData = err;
      console.log(this.responseData);
      this.returned = true;
      this.sorting=false;
      
    });

  }


    doInfinite(infiniteScroll) {
    var newListData:any;
    console.log('Begin async operation');

      setTimeout(() => {

      this.page = this.page+1;
      
      var params = 'appcontent/listpage?api_key='+this.userData.remember_token+'&page='+this.page;
      this.requestProvider.getReq(params).then((result) => {
        this.responseData = result;
        if(this.responseData.success == true){

          newListData = this.responseData.data;
          newListData = this.ratingProvider.generateRating(newListData,this.userData.kriteria,'profiledata_data');
          this.last_page = this.responseData.last_page;

          for(var i=0;i<newListData.length;i++){
            this.calons.push(newListData[i]);
          }
          console.log(this.calons);

        }else{
          //this.toast(this.responseData.message);
        }
        
       
        
      }, (err) => {

        if(err.status == 500){
          this.toast('Mohon maaf terjadi kesalahan pada server kami');
        }else if (err.status == 0 ){
          this.toast('Tidak dapat terhubung, periksa koneksi internet anda');
        }

      });
      

      console.log('Async operation has ended');
      infiniteScroll.complete();
    }, 500);


  }



  detail(profile) {
  	let modal = this.modalCtrl.create('DetailPage', {
      profile:profile,
      mapType:'search'
  	},
  	{
  		cssClass: 'detail-modal'
  	});
  	modal.present();
  }

 sort()
  {
      let prompt = this.alertCtrl.create({
      title: 'Urutkan berdasarkan',
      //message: 'Urutkan Berdasarkan ',
      inputs : [
      {
          type:'radio',
          label:'Nama A-Z',
          handler: data => {
            this.orderby = 'nama_asli';
            this.ordertype = 'asc';
          }
      },
      {
          type:'radio',
          label:'Nama Z-A',
          handler: data => {
            this.orderby = 'nama_asli';
            this.ordertype = 'desc';
          }
      },
      {
          type:'radio',
          label:'Penghasilan Rendah - Tinggi',
          handler: data => {
            this.orderby = 'penghasilan_pekerjaan';
            this.ordertype = 'asc';
          }      
      },
      {
          type:'radio',
          label:'Penghasilan Tinggi - Rendah',
          handler: data => {
            this.orderby = 'penghasilan_pekerjaan';
            this.ordertype = 'desc';
          } 
      },
      {
          type:'radio',
          label:'Usia Muda - Tua ',
          handler: data => {
            this.orderby = 'tanggal_lahir';
            this.ordertype = 'desc';
          } 
      },
      {
          type:'radio',
          label:'Usia Tua - Muda',
          handler: data => {
            this.orderby = 'tanggal_lahir';
            this.ordertype = 'asc';
          } 
      }],
      buttons : [
      {
          text: "Cancel",
          handler: data => {
          console.log("cancel clicked");
          }
      },
      {
          text: "Sort",
          handler: data => {
            this.page = 1;
            this.sorting=true;
            this.listReq();
          }
      }]});
      prompt.present();
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
