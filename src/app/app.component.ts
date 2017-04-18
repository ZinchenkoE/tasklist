import {Component, Output} from '@angular/core';

@Component({
	selector: 'app-root',
	templateUrl: './app.component.html',
	styleUrls: ['./app.component.css']
})
export class AppComponent {
	infoBox: string = 'Приложение загружено.';
	@Output() activeCategory: number;

	onChangeCategory(id) {
		this.activeCategory = id;
		// console.log(this.activeCategory);
	}
}