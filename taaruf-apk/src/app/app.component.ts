import { Component, ViewChild } from '@angular/core';
import { Nav, Platform, LoadingController } from 'ionic-angular';
import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { RequestProvider } from '../providers/request/request';
//import { OneSignal } from '@ionic-native/onesignal';

@Component({
  templateUrl: 'app.html'
})
export class MyApp {
  @ViewChild(Nav) nav: Nav;

  rootPage: any = 'LoginPage';
  loader:any;
  userData:any=null;
  deviceData:any;

  pages: Array<{title: string, component?: any, icon?: any, logout?: boolean}>;

  constructor(public platform: Platform, public statusBar: StatusBar, public splashScreen: SplashScreen,
    public loading: LoadingController, private requestProvider:RequestProvider//,  private oneSignal: OneSignal
    ) {
    this.initializeApp();

    if(JSON.parse(localStorage.getItem('userData')) != null ){
        this.userData = JSON.parse(localStorage.getItem('userData'));
    }

    if(this.userData !== null){
      this.rootPage = 'HomePage';
    }

    // used for an example of ngFor and navigation
    this.pages = [
      { title: 'Home', component: 'HomePage', icon: 'home' },
      { title: 'Profil', component: 'ProfilePage', icon: 'person' },
      { title: 'Proposal Dikirim', component: 'ProposalKirimPage', icon: 'cloud-upload' },
      { title: 'Proposal Diterima', component: 'ProposalTerimaPage', icon: 'cloud-download' },
      { title: 'Progres Ta\'aruf', component: 'ProgressPage', icon: 'checkmark-circle-outline' },
      { title: 'Tentang Kami', component: 'PagesPage', icon: 'information-circle' },
      { title: 'Keluar', logout: true, icon: 'log-out' }
    ];

  }

  initializeApp() {
    this.platform.ready().then(() => {
      if(this.platform.is('core') || this.platform.is('mobileweb')) {
     
      }else{
      //  this.initializeonesignal();
      }
      // Okay, so the platform is ready and our plugins are available.
      // Here you can do any higher level native things you might need.
      this.statusBar.styleDefault();
      this.splashScreen.hide();
    });
  }

 /* initializeonesignal(){

    this.oneSignal.startInit('fd6a3860-96e6-4144-aed0-1bf1af246ba9', '1049754486791');

    this.oneSignal.inFocusDisplaying(this.oneSignal.OSInFocusDisplayOption.InAppAlert);

    this.oneSignal.handleNotificationReceived().subscribe(() => {
     // do something when notification is received
     
    });

    this.oneSignal.handleNotificationOpened().subscribe((data:any) => {
      //
      // do something when a notification is opened
      //var temp = data.notification.payload.additionalData.id_order;
      //var id_order = temp;
      this.nav.setRoot('ProposalTerimaPage'); 

    
    });

    this.oneSignal.endInit();
    
    this.oneSignal.getIds().then((ids) => {
      this.deviceData = ids.userId;
      localStorage.setItem('deviceData',this.deviceData);
    });
 
  } */ 

  openPage(page) {
    // Reset the content nav to have just this page
    // we wouldn't want the back button to show in this scenario
    if(page.logout == true){

      if(JSON.parse(localStorage.getItem('userData')) != null ){
          this.userData = JSON.parse(localStorage.getItem('userData'));
      }

       this.logout();
    }else{
      this.nav.setRoot(page.component);
    }

  }


  logout(){

      this.loader = this.loading.create({
        content: 'Keluar..',
       });

      var params = 'appauth/logout?api_key='+this.userData.remember_token;

      this.loader.present().then(()=>{
        this.requestProvider.getReq(params).then((result) =>{
          localStorage.clear();
          this.loader.dismiss();
          this.nav.setRoot('LoginPage');
        }, (err) => {
          console.log(err);
          this.loader.dismiss();
        });
      });
   }


}
