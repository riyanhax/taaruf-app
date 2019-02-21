import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { SliderDetailPage } from './slider-detail';

@NgModule({
  declarations: [
    SliderDetailPage,
  ],
  imports: [
    IonicPageModule.forChild(SliderDetailPage),
  ],
})
export class SliderDetailPageModule {}
