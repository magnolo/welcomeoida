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