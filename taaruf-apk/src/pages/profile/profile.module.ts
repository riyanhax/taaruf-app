import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { ProfilePage } from './profile';
//import {IonTagsInputModule} from "ionic-tags-input";
import { IonicImageViewerModule } from 'ionic-img-viewer';
@NgModule({
  declarations: [
    ProfilePage,
  ],
  imports: [
  IonicImageViewerModule,
    IonicPageModule.forChild(ProfilePage),
  ],
})
export class ProfilePageModule {}
