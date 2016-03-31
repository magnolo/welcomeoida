$.extend($.validator.messages, {
  required: "Dieses Feld ist ein Pflichtfeld.",
  maxlength: $.validator.format("Maximal {0} Zeichen."),
  minlength: $.validator.format("Mindestens {0} Zeichen."),
  rangelength: $.validator.format("Mindestens {0} und maximal {1} Zeichen."),
  email: "Gieb bitte eine gültige E-Mail Adresse ein.",
  url: "Gieb bitte eine gültige URL ein.",
  date: "Gieb bitte ein gültiges Datum ein.",
  number: "Gieb bitte eine Nummer ein.",
  digits: "Gieb bitte nur Ziffern ein.",
  equalTo: "Bitte denselben Wert wiederholen.",
  range: $.validator.format("Gieb einen Wert zwischen {0} und {1} ein."),
  max: $.validator.format("Gieb bitte einen Wert kleiner oder gleich {0} ein."),
  min: $.validator.format("Gieb bitte einen Wert größer oder gleich {0} ein."),
  creditcard: "Gieb bitte eine gültige Kreditkarten-Nummer ein."
});
$(function() {
  //Setup AJAX CALLS
  $.ajaxSetup({
    statusCode: {
        401: function(){
            console.log("sfsdf");
        }
    }
  });

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

  //imageModal
  $('.materialboxed').materialbox();

  //Init DataTables
  $('.dataTable').DataTable();

  //Form Validator
  $('.validate-me').validate({
    errorElement: 'div',
    errorPlacement: function(error, element) {
      error.appendTo(element.parent(".input-field"));
    }
  });

});

$.fn.extend({
  animateCss: function(animationName, doneClass, element) {
    var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
    $(this).removeClass('hidden');
    $(this).addClass('animated ' + animationName).one(animationEnd, function() {
      $(this).removeClass('animated ' + animationName);
      $(this).addClass(doneClass);
			if(element){
				$(element).find('input').first().focus();
	      $('html, body').animate({
							 scrollTop: $(element).offset().top
						 }, 1000);
			}

    });
  }
});

//# sourceMappingURL=app.js.map
