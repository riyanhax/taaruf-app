import { BrowserModule } from '@angular/platform-browser';
import { HttpModule } from '@angular/http';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';

import { MyApp } from './app.component';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { RequestProvider } from '../providers/request/request';
import { InAppBrowser } from "@ionic-native/in-app-browser";
//import { OneSignal } from '@ionic-native/onesignal';
import { UrlProvider } from '../providers/url/url';
import { IonicImageViewerModule } from 'ionic-img-viewer';
import { Camera } from '@ionic-native/camera';
import { SharedModule } from '../directives/shared.module';
import { RatingProvider } from '../providers/rating/rating';
import { Crop } from '@ionic-native/crop';
import { Base64 } from '@ionic-native/base64';

@NgModule({
  declarations: [
    MyApp,
  ],
  imports: [
    BrowserModule, HttpModule,
    IonicModule.forRoot(MyApp, {
      menuType: 'reveal'
    }),IonicImageViewerModule,
    SharedModule,
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
  ],
  providers: [
    Base64,
    Crop,
    Camera,
    StatusBar,
    SplashScreen,
    InAppBrowser,
  //  OneSignal,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    RequestProvider,
    UrlProvider,
    RatingProvider,
    RatingProvider,
    RequestProvider,
    UrlProvider
  ]
})
export class AppModule {}
