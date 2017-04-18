window.onload = function() {
	$('.btn-plus').click(function () { // Добавляем новую запись в разметку
		$('<div class="business">\
			<input type="text" new>\
			<div class="btn arrow-circle-right"><i class="fa fa-arrow-circle-right"></i></div>\
			<div class="btn arrow-circle-left"><i class="fa fa-arrow-circle-left"></i></div>\
			<div class="btn check"><i class="fa fa-check"></i></div>\
			<div class="btn trash"><i class="fa fa-trash"></i></div>\
			<div class="btn chrome"><i class="fa fa-chrome"></i></div>\
		</div>').appendTo('#' + $('.tab.active').attr('id'));
		$('[new]').focus()
	});
	$(document).on('change', '[new]', function(){ // Отправляем новую запись на сохранение
		var input = $(this);
		$.get('php.php', { text: encodeURIComponent(input.val()), tab: $('.tab.active').attr('id'), action: 'insert' }, function (r) {
				consol('Добавили новую запись: ' + r); input.attr('data-id', r).removeAttr('new');
			}
		).error(function() {consol('Ошибка добавления записи');});
	});
	$(document).on('change', 'input:not([new])', function(){ // Изменение старой записи
		var input = $(this);
		$.get('php.php', { text: input.val(), id: input.attr('data-id'), action: 'updateText' }, function (r) { consol(r); }
		).error(function() {consol('Ошибка изменения записи');});
	});

	$(document).on('click', '.check', function() { // Переместить запись в удаленные
		var input = $(this).siblings('input');
		var business = input.closest('.business');
		if(input.val() != '') {
			$.get('php.php',{tab: 'removed',id: input.attr('data-id'),action: 'updateTab'},function (r) {
					consol(r); business.appendTo('#removed');
				}
			).error(function() {consol('Ошибка перемещения в выполнение');});
		}else{ business.remove(); }
	});

	$(document).on('click', '.arrow-circle-right', function() { // Переместить запись на завтра
		var input = $(this).siblings('input');
		var business = input.closest('.business');
		$.get('php.php',{tab: 'tomorrow',id: input.attr('data-id'),action: 'updateTab'},function (r) {
				consol(r);business.appendTo('#tomorrow');}
		).error(function() {consol('Ошибка перемещения на завтра');});
	});
	$(document).on('click', '.arrow-circle-left', function() { // Переместить запись на сегодня
		var input = $(this).siblings('input');
		var business = input.closest('.business');
		$.get('php.php', { tab: 'today', id: input.attr('data-id'), action: 'updateTab' }, function (r) {
				consol(r); business.appendTo('#today');
			}
		).error(function() {consol('Ошибка перемещения на сегодня');});
	});
	$(document).on('click', '.trash', function() { // Удалить навсегда
		var input = $(this).siblings('input');
		$.get('php.php', { id: input.attr('data-id'), action: 'delete' },function (r) {
				consol(r);input.closest('.business').remove();
			}
		).error(function() {consol('Ошибка удаления записи');});

	});
	$(document).on('click', '.chrome', function() { // Переход по ссылке
		var val= $(this).siblings('input').val();
		if(val.slice(0, 4) == 'http') window.open(val);
		else window.open('http://www.google.com/search?q=' + encodeURIComponent(val));
	});
	$(document).on('keyup', 'input', function(e) {
		if(e.keyCode==13){
			$(this).focusout();
		}else if(e.keyCode==38) {
			$(this).parent().prev().find('input').focus();
		}else if(e.keyCode==40) {
			$(this).parent().next().find('input').focus();
		}
	});
};

