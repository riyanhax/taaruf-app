import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';
import { DomSanitizer } from '@angular/platform-browser';
import { UrlProvider } from '../../providers/url/url';
/**
 * Generated class for the CityPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-city',
  templateUrl: 'city.html',
})
export class CityPage {
	
 responseData;
 kotas;
 userData:any=JSON.parse(localStorage.getItem('userData'));
 url:string = this.urlProvider.storageImgUrl;
 returned = false;

  constructor(public navCtrl: NavController, public navParams: NavParams, 
  	private requestProvider:RequestProvider, private _sanitizer: DomSanitizer, private urlProvider:UrlProvider) {
  	this.cityreq();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad CityPage');
  }

   getBackground(image) {
    return this._sanitizer.bypassSecurityTrustStyle(`url(${image})`);
  }

	cityreq(){
    var params = 'appcontent/citypage?api_key='+this.userData.remember_token;
    this.requestProvider.getReq(params).then((result) =>{
      this.responseData = result;
      console.log(this.responseData);
      if(this.responseData.success == true){
        this.kotas = this.responseData.data;
        this.returned = true;
      }else{
      	this.returned = true;
      }

    }, (err) => {
      this.responseData = err;
      console.log(this.responseData);
      this.returned = true;
    });
  }

}
