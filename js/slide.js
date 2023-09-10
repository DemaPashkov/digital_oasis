$(document).ready(function () {
	// Variables
	var $carousel = $(".carousel");
	var $carouselInner = $(".carousel-inner");
	var $slides = $(".slide");
	var slideWidth = $slides.width();
	var currentIndex = 0;

	// Funciones auxiliares
	function goToSlide(index) {
		$carouselInner.css("transform", "translateX(-" + slideWidth * index + "px)");
	}

	function showSlide(index) {
		$slides.removeClass("active");
		$slides.eq(index).addClass("active");
	}

	// Eventos
	$(".carousel-next").click(function () {
		currentIndex++;
		if (currentIndex >= $slides.length) {
			currentIndex = 0;
		}
		goToSlide(currentIndex);
		showSlide(currentIndex);
	});

	$(".carousel-prev").click(function () {
		currentIndex--;
		if (currentIndex < 0) {
			currentIndex = $slides.length - 1;
		}
		goToSlide(currentIndex);
		showSlide(currentIndex);
	});
});
