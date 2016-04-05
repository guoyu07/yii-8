$(document).ready(function(){
	// Если выбран файл
	$('form input[type=file]').on('change', function() {
		// Скрываем форму выбора
		$('input[type=file]').hide();

		// Отображаем имя файла и кн. отмены
		$('input[type=file]').after('<span class="file">' +
                                    $('input[type=file]').val() +
                                    '</span>');
		$('a.delete').css('display', 'block');

		// Если файл выбран, то по нажатию на кн. отмены:
		// Очищаем и отображаем форму, удаляем имя, скрываем кн. отмены.
		if($('a').is('.delete')) {
			$('a.delete').on('click', function() {
				$('input[type=file]').val('').show();
				$('span.file').remove();
				$('a.delete').css('display', 'none')
			});
		}
	});
});