import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';
import { DomSanitizer, SafeResourceUrl, SafeUrl } from '@angular/platform-browser';
import { UrlProvider } from '../../providers/url/url';

/**
 * Generated class for the BlogPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-blog',
  templateUrl: 'blog.html',
})
export class BlogPage {

  responseData:any;
  userData:any=JSON.parse(localStorage.getItem('userData'));
  page:number=1;
  blogs:any=[];
  last_page:number;
  url:string = this.urlProvider.storageImgUrl;
  constructor(public navCtrl: NavController, public navParams: NavParams, 
    private requestProvider:RequestProvider, private _sanitizer: DomSanitizer, private urlProvider:UrlProvider){
    console.log('now page = '+this.page);
    this.blogReq();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad BlogPage');
  }

  blogDetail(blog) {
    console.log(blog);
    console.log('func');
    
    this.navCtrl.push('BlogDetailPage', {
      blog:blog 
    });
    //this.navCtrl.push('BlogDetailPage');
  }


  getBackground(image) {
    return this._sanitizer.bypassSecurityTrustStyle(`url(${image})`);
  }

  blogReq(){
    var params = 'appcontent/blogpage?api_key='+this.userData.remember_token+'&page='+this.page;
    this.requestProvider.getReq(params).then((result) =>{
      this.responseData = result;
      console.log(this.responseData);
      if(this.responseData.success == true){
        this.blogs = this.responseData.data.blogs;
        this.last_page = this.responseData.data.last_page;


      }else{

      }

    }, (err) => {
      this.responseData = err;
      console.log(this.responseData);
      
    });
  }

  doInfinite(infiniteScroll) {

    console.log(this.page);
    console.log(this.last_page);
    var newListData:any;
    console.log('Begin async operation');
    if(this.page < this.last_page){
      setTimeout(() => {

      this.page = this.page+1;
      
      var params = 'appcontent/blogpage?api_key='+this.userData.remember_token+'&page='+this.page;
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
}
