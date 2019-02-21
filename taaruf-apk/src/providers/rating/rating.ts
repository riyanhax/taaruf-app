//import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

/*
  Generated class for the RatingProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class RatingProvider {

  constructor() {
    console.log('Hello RatingProvider Provider');
  }

  generateRating(paramdata,user,keyparam){
  	
  	var rating;

  	var data = paramdata;

  	for (var i = 0; i < data.length; ++i) {
  		
  		rating  = 0;

  		var age = this.getAge(data[i][keyparam].tanggal_lahir.data_date);

  		if(age >= user.min_usia.data_integer && age <= user.max_usia.data_integer ){
  			rating += 16.6;
  		}

  		if(data[i][keyparam].penghasilan_pekerjaan.data_integer >= user.minimum_penghasilan.data_integer){
  			rating += 16.6;
  		}

  		if(data[i][keyparam].afiliasi_keagamaan.data_varchar == user.kriteria_afiliasi_keagamaan.data_varchar){
  			rating += 16.6;
  		}

  		if(user.kriteria_status.data_varchar == 'all'){
  			rating += 16.6;
  		}else if(user.kriteria_status.data_varchar == data[i][keyparam].status_pernikahan.data_varchar){
  			rating += 16.6;
  		}

  		if(data[i][keyparam].tinggi_badan.data_integer >= user.min_tinggi.data_integer && data[i][keyparam].tinggi_badan.data_integer <= user.max_tinggi.data_integer){
  			rating += 16.6;
  		}

  		if(data[i][keyparam].berat_badan >= user.min_berat.data_integer && data[i][keyparam].berat_badan <= user.max_berat.data_integer ){
  			rating += 16.6;
  		}

  		var match_edu = false;
  		if( user.pendidikan_minimal.data_varchar == 's3'){
  			if(data[i][keyparam].pend_s3.data_varchar != null){
  				match_edu = true;
  			}
  		}else if( user.pendidikan_minimal.data_varchar == 's2' ){
  			if(data[i][keyparam].pend_s3.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_s2.data_varchar != null){
  				match_edu = true;
  			}
  		}else if(user.pendidikan_minimal.data_varchar == 's1'){
			if(data[i][keyparam].pend_s3.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_s2.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_s1.data_varchar != null){
  				match_edu = true;
  			}
  		}else if(user.pendidikan_minimal.data_varchar == 'diploma'){
			if(data[i][keyparam].pend_s3.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_s2.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_s1.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_diploma.data_varchar != null){
  				match_edu = true;
  			}
  		}else if(user.pendidikan_minimal.data_varchar == 'slta'){
			if(data[i][keyparam].pend_s3.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_s2.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_s1.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_diploma.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_slta.data_varchar != null){
  				match_edu = true;
  			}
  		}else if(user.pendidikan_minimal.data_varchar == 'smp'){
			if(data[i][keyparam].pend_s3.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_s2.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_s1.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_diploma.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_slta.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_smp.data_varchar != null){
  				match_edu = true;
  			}
  		}else if(user.pendidikan_minimal.data_varchar == 'sd'){
			if(data[i][keyparam].pend_s3.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_s2.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_s1.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_diploma.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_slta.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_smp.data_varchar != null){
  				match_edu = true;
  			}else if(data[i][keyparam].pend_sd.data_varchar != null){
  				match_edu = true;
  			}
  		}

  		if(match_edu == true){
  			rating += 16.6;
  		}

  		data[i].rating = rating;
  		data[i].age = age;
  	}

  	return data;

  }


 	getAge(dateString) 
	{
	    var today = new Date();
	    var birthDate = new Date(dateString);
	    var age = today.getFullYear() - birthDate.getFullYear();
	    var m = today.getMonth() - birthDate.getMonth();
	    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) 
	    {
	        age--;
	    }
	    return age;
	}
}
