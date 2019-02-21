import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';
import { UrlProvider } from '../../providers/url/url';



/**
 * Generated class for the BlogDetailPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-blog-detail',
  templateUrl: 'blog-detail.html',
})
export class BlogDetailPage {
  url:string = this.urlProvider.storageImgUrl;;
  blog:any;
  userData:any=JSON.parse(localStorage.getItem('userData'));
  responseData:any;
  constructor(public navCtrl: NavController, public navParams: NavParams, private toastCtrl: ToastController, 
    private requestProvider:RequestProvider,private urlProvider:UrlProvider) {
  	this.blog = this.navParams.get('blog');
  	console.log(this.blog);
    console.log('page');
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad BlogDetailPage');
  }

  addBookmark(){
    this.blog.bookmarked = this.userData.id;
    var params = 'appbookmark/add?api_key='+this.userData.remember_token+'&id_blog='+this.blog.id;
    this.requestProvider.getReq(params).then((result) =>{
      this.responseData = result;
      console.log(this.responseData);
      if(this.responseData.success == true){
        this.toast('Blog berhasil ditambahkan ke daftar bookmark anda');
        
      }else{
        this.toast(this.responseData.message);
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

  removeBookmark(){
    this.blog.bookmarked = null;
    var params = 'appbookmark/delete?api_key='+this.userData.remember_token+'&id_blog='+this.blog.id;
    this.requestProvider.getReq(params).then((result) =>{
      this.responseData = result;
      console.log(this.responseData);
      if(this.responseData.success == true){
        this.toast('Blog berhasil dihapus ke daftar bookmark anda');
        
      }else{
        this.toast(this.responseData.message);
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


}
