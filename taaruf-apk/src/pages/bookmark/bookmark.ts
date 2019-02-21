import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ModalController } from 'ionic-angular';
import { DomSanitizer, SafeResourceUrl, SafeUrl } from '@angular/platform-browser';
import { RequestProvider } from '../../providers/request/request';
import { UrlProvider } from '../../providers/url/url';
import { RatingProvider } from '../../providers/rating/rating';


/**
 * Generated class for the BookmarkPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-bookmark',
  templateUrl: 'bookmark.html',
})
export class BookmarkPage {
  responseData:any;
  page:number=1;
  last_page:number;
  blogs:any=false;
  calons:any=false;
  userData:any=JSON.parse(localStorage.getItem('userData'));
  url:string = this.urlProvider.storageImgUrl;
  disablesend:boolean=true;
  proposeTo:any;
  spin:string="with-spin";
  returned:boolean=false;

  constructor(public navCtrl: NavController, public navParams: NavParams, public modalCtrl: ModalController, 
    private _sanitizer: DomSanitizer, private requestProvider:RequestProvider,private urlProvider:UrlProvider
    ,public ratingProvider: RatingProvider) {
    this.bookmarkedBlogsReq();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad BookmarkPage');
  }

  detail(profile) {
  	let modal = this.modalCtrl.create('DetailPage', {
      profile:profile
  	},
  	{
  		cssClass: 'detail-modal'
  	});
  	modal.present();
  }

  blogDetail(blog) {
    console.log(blog);
    console.log('func');
    
    this.navCtrl.push('BlogDetailPage', {
      blog:blog 
    });
    //this.navCtrl.push('BlogDetailPage');
  }

  bookmarkedBlogsReq(){
    var params = 'appcontent/bookmarkpage?api_key='+this.userData.remember_token+'&page='+this.page;
    this.requestProvider.getReq(params).then((result) =>{
      this.responseData = result;
      console.log(this.responseData);
      if(this.responseData.success == true){
        this.blogs = this.responseData.data.blogs;
        this.calons=this.responseData.data.profile;
        this.calons = this.ratingProvider.generateRating(this.calons,this.userData.kriteria,'data');
        this.last_page = this.responseData.data.last_page;
        this.returned=true;

      }else{
        console.log(this.responseData);
        this.returned=true;
      }

    }, (err) => {
      this.responseData = err;
      console.log(this.responseData);
      this.returned=true;
      
    });
    this.spin = "";
  }

  choosecalon(profile){
    this.proposeTo=profile;
    this.disablesend=false;
  }

  doInfinite(infiniteScroll) {
    var newListData:any;
    console.log('Begin async operation');
    if(this.page < this.last_page){
      setTimeout(() => {

      this.page = this.page+1;
      
      var params = 'appcontent/bookmarkpage?api_key='+this.userData.remember_token+'&page='+this.page;
      this.requestProvider.getReq(params).then((result) => {
        this.responseData = result;
        if(this.responseData.success == true){

          newListData = this.responseData.data.blogs;
          this.last_page = this.responseData.last_page;
          for(var i=0;i<newListData.length;i++){
            this.blogs.push(newListData[i]);
          }
          console.log(this.blogs);

        }else{
          console.log(this.responseData);
        }
        
       
        
      }, (err) => {
         console.log(err);
      });
      

      console.log('Async operation has ended');
      infiniteScroll.complete();
    }, 500);

    }else{
      console.log('its the last page');
      infiniteScroll.complete();
    }
  }

  getBackground(image) {
    return this._sanitizer.bypassSecurityTrustStyle(`url(${image})`);
  }

  proposal(){
     this.navCtrl.push('KirimProposalPage', {
       profile:this.proposeTo
     });
  }
}
