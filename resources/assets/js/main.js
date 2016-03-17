$(function () {

	//Sidenav
	$(".button-collapse").sideNav();

	//Text Rotator
	$(".rotateText").textrotator({
	  animation: "flipCube", // You can pick the way it animates when rotating through words. Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
	  separator: ",", // If you don't want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.
	  speed: 2000 // How many milliseconds until the next word show.
	});

	//Modal opener
	$('.modal-trigger').leanModal();

	//RemoveLoader
	$('body').removeClass('overflow-none');
	$('#loader').fadeOut();

	//Form Validator
	$('.validate-me').validate({
		errorElement:'div',
		errorPlacement: function(error, element) {
		 error.appendTo( element.parent(".input-field"));
	 }
 });
});
