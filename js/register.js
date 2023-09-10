// Вызов модального окна
$('.button2').click( function() {
	$('.overlay2').fadeIn();
});

// Закрытие окна на крестик
$('.close-popup').click( function() {
	$('.overlay2').fadeOut();
});

// Закрытие окна на поле
$(document).mouseup( function (e) { 
	var popup = $('.popup');
	if (e.target != popup[0] && popup.has(e.target).length === 0){
		$('.overlay2').fadeOut();
	}
});
