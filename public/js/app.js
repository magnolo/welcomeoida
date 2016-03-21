$.extend($.validator.messages, {
  required: "Dieses Feld ist ein Pflichtfeld.",
  maxlength: $.validator.format("Geben Sie bitte maximal {0} Zeichen ein."),
  minlength: $.validator.format("Geben Sie bitte mindestens {0} Zeichen ein."),
  rangelength: $.validator.format("Geben Sie bitte mindestens {0} und maximal {1} Zeichen ein."),
  email: "Geben Sie bitte eine gültige E-Mail Adresse ein.",
  url: "Geben Sie bitte eine gültige URL ein.",
  date: "Bitte geben Sie ein gültiges Datum ein.",
  number: "Geben Sie bitte eine Nummer ein.",
  digits: "Geben Sie bitte nur Ziffern ein.",
  equalTo: "Bitte denselben Wert wiederholen.",
  range: $.validator.format("Geben Sie bitte einen Wert zwischen {0} und {1} ein."),
  max: $.validator.format("Geben Sie bitte einen Wert kleiner oder gleich {0} ein."),
  min: $.validator.format("Geben Sie bitte einen Wert größer oder gleich {0} ein."),
  creditcard: "Geben Sie bitte eine gültige Kreditkarten-Nummer ein."
});
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

//# sourceMappingURL=app.js.map
