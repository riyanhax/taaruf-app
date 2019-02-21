import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';

/**
 * Generated class for the SliderDetailPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-slider-detail',
  templateUrl: 'slider-detail.html',
})
export class SliderDetailPage {
	slide:any;
	url:string = 'http://localhost/taaruf-admin/storage/app/public/media/';
  constructor(public navCtrl: NavController, public navParams: NavParams) {
  	this.slide = this.navParams.get('slide');
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad SliderDetailPage');
  }

}
