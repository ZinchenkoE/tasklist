import {BrowserModule}        from '@angular/platform-browser';
import {NgModule} 	 	      from '@angular/core';
import {CommonModule}         from '@angular/common';
import {FormsModule}          from '@angular/forms';
import {HttpModule}           from '@angular/http';
import {AppComponent}         from './app.component';
import {NavComponent}         from './nav/nav.component';
import {TasklistComponent}    from './tasklist/tasklist.component';
import {FilterByCategoryPipe} from './pipes';

@NgModule({
	declarations: [
		AppComponent,
		NavComponent,
		TasklistComponent,
		FilterByCategoryPipe
	],
	imports: [
		BrowserModule,
		FormsModule,
		CommonModule,
		HttpModule
	],
	providers: [],
	bootstrap: [AppComponent]
})
export class AppModule {
}
