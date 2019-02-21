import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { RequestProvider } from '../../providers/request/request';

/**
 * Generated class for the PagesPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-pages',
  templateUrl: 'pages.html',
})
export class PagesPage {

	responseData:any;
	about:any=false;
	userData:any=JSON.parse(localStorage.getItem('userData'));

	constructor(public navCtrl: NavController, public navParams: NavParams, private requestProvider:RequestProvider){
		
	}

  	ionViewCanEnter() {
		this.aboutReq();
	}	

	ionViewDidLoad() {
		console.log('ionViewDidLoad PagesPage');
	}

	aboutReq(){
	    var params = 'appcontent/aboutpage?api_key='+this.userData.remember_token;
	    this.requestProvider.getReq(params).then((result) =>{
	      this.responseData = result;
	      console.log(this.responseData);
	      if(this.responseData.success == true){
	        this.about = this.responseData.data.aboutus;
	        console.log(this.about);
	      }else{

	        //this.contentReq();
	      }

	    }, (err) => {
	      this.responseData = err;
	      console.log(this.responseData);
	      
	    });
	}

}
