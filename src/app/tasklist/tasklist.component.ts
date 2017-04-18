import {Component, OnInit, Input} from '@angular/core';

@Component({
	selector: 'app-tasklist',
	templateUrl: './tasklist.component.html',
	styleUrls: ['./tasklist.component.css'],
})
export class TasklistComponent implements OnInit {
	@Input() activeCategory: number;

	tasks: Task[] = [
		{id: 1, text: 'Сегодня dfhfg', category: 1},
		{id: 2, text: 'Завтра fhgh', category: 1},
		{id: 3, text: 'Заметки fgh ', category: 2},
		{id: 4, text: 'Выполненные fgh', category: 2},
	];
	constructor() {}
	ngOnInit() {}

}
export class Task {
	id: number;
	text: string;
	category: number;
}