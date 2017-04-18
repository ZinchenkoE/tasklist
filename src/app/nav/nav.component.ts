import {Component, OnInit, Output, EventEmitter} from '@angular/core';

@Component({
	selector: 'app-nav',
	templateUrl: './nav.component.html',
	styleUrls: ['./nav.component.css']
})
export class NavComponent implements OnInit {
	categories: Category[] = [
		{id: 1, name: 'Сегодня'},
		{id: 2, name: 'Завтра'},
		{id: 3, name: 'Заметки'},
		{id: 4, name: 'Выполненные'},
	];
	activeCategory: number;
	@Output() onChangeCategory: EventEmitter<number>;

	constructor() {
		this.onChangeCategory = new EventEmitter<number>();
	}

	ngOnInit() {
		this.activeCategory = this.categories[0].id;
	}

	clickToCategory(id: number): void {
		this.activeCategory = id;
		this.onChangeCategory.emit(id);
	}
}

class Category {
	id: number;
	name: string;
}