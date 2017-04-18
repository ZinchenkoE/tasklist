import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-tasklist',
  templateUrl: './tasklist.component.html',
  styleUrls: ['./tasklist.component.css']
})
export class TasklistComponent implements OnInit {
  tasks: Task[] = [
    { id: 1, name: 'Сегодня dfhfg'  , category: 1 },
    { id: 2, name: 'Завтра fhgh'    , category: 1 },
    { id: 3, name: 'Заметки fgh '   , category: 1 },
    { id: 4, name: 'Выполненные fgh', category: 1 },
  ];
  constructor() { }

  ngOnInit() {}

}

class Task {
  id: number;
  name: string;
  category: number;
}