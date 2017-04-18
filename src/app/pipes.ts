import {Pipe, PipeTransform} from '@angular/core';
import {Task} from './tasklist/tasklist.component';

@Pipe({
	name: 'filterByCategory',
})
export class FilterByCategoryPipe implements PipeTransform {
	transform(tasks: Task[], category: number): any {
		if (!tasks || !category) return tasks;
		return tasks.filter(task => task.category == category);
	}
}
