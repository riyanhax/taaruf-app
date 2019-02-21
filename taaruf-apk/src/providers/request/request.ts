import {Injectable} from '@angular/core';
import {Http, Headers, RequestOptions} from '@angular/http';
import 'rxjs/add/operator/map';


/*
  Generated class for the RequestProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/

let apiUrl = 'http://demo.multinity.com/taaruf-admin/public/api/';

@Injectable()
export class RequestProvider {
data: any;
  	 
  constructor(public http: Http) {
    console.log('Hello RequestProvider Provider');
  }

	
	postReq(addurl,credentials) {

	    return new Promise((resolve, reject) => {
	      let headers = new Headers();

	      headers.append('Content-Type','application/json');
	      let option = new RequestOptions({headers: headers});
	      
	      this.http.post(apiUrl+addurl, JSON.stringify(credentials), option)
	         .map(res => res.json())
	        .subscribe(res => {
	          this.data = res;
	          resolve(this.data);
	        }, (err) => {
	          reject(err);
	        });
	    });

	}

  getReq(credentials) {
    
    return new Promise((resolve, reject) => {
      this.http.get(apiUrl + credentials )
      	.map(res => res.json())
        .subscribe(res => {
        	this.data=res;
          resolve(this.data);
        }, (err) => {
          reject(err);
        });
    });

  }

}
