import { NgModule } from '@angular/core';
import { Autosize } from './autosize/autosize';

@NgModule({
  declarations: [Autosize, ],
  exports: [ Autosize ]
})

export class SharedModule {}