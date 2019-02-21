import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { HistoryDetailPage } from './history-detail';
//import { Autosize } from '../../directives/autosize/autosize';
import { SharedModule } from '../../directives/shared.module';

@NgModule({
  declarations: [
    HistoryDetailPage, //Autosize,
  ],
  imports: [
    IonicPageModule.forChild(HistoryDetailPage),SharedModule,
  ],
})
export class HistoryDetailPageModule {}
