import { Injectable } from '@angular/core';

/*
  Generated class for the UrlProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class UrlProvider {
	public storageImgUrl:string = 'http://localhost:8000/taaruf-admin/public/media/';
	public storagePP:string ='http://localhost:8000/taaruf-admin/public/profile_pic/';
  constructor() {
    console.log('Hello UrlProvider Provider');
  }

}
