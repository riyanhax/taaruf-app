import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { KirimProposalPage } from './kirim-proposal';
import { SharedModule } from '../../directives/shared.module';

@NgModule({
  declarations: [
    KirimProposalPage, //Autosize,
  ],
  imports: [
    IonicPageModule.forChild(KirimProposalPage),SharedModule,
  ],
})
export class KirimProposalPageModule {}
