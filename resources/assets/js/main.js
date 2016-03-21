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

	//Init Tabs
	$('ul.tabs').tabs();

	//RemoveLoader
	$('body').removeClass('overflow-none');
	$('#loader').fadeOut();

	//Init DataTables
	$('.dataTable').DataTable();

	//Form Validator
	$('.validate-me').validate({
		errorElement:'div',
		errorPlacement: function(error, element) {
		 error.appendTo( element.parent(".input-field"));
	 }
 });

});

$.fn.extend({
    animateCss: function (animationName, doneClass, element) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
				$(this).removeClass('hidden');
        $(this).addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
						$(this).addClass(doneClass);
						/*$('html, body').animate({
						 scrollTop: $(element).offset().top
					 }, 1000);*/
        });
    }
});
