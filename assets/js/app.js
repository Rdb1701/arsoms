"use strict";
$(window).on("load", function() {
  $(".overflow-hidden").removeClass("overflow-hidden");
  $("#status").fadeOut();
  $("#preloader").fadeOut("fast");
  bsCustomFileInput.init();
});
$('[data-target="#cloudnote-panel"]').click(function() {
  $("body > .bmd-layout-canvas > div").toggleClass("collapsing-right");
});
$('[data-target="#mainmenu"]').click(function() {
  $("#cloudnote-panel").collapse("hide");
  $("body > .bmd-layout-canvas > div").removeClass("collapsing-right");
});
$(".yearDisplay").text(new Date().getFullYear());
$('#btn-theme').on("click", function (e) {
  e.stopPropagation();
});
$(".datepickermax").pickadate({
  format: "mm/dd/yyyy",
  selectMonths: true,
  selectYears: 100,
  min: new Date(1920, 1, 1),
  max: true,
  editable: true
});
$(".datepicker").pickadate({
  format: "yyyy-mm-dd",
  selectMonths: true,
  selectYears: 100,
  min: new Date(1920, 1, 1),
  editable: true,
  onStart: function() {
    var date = new Date();
    this.set("select", [date.getFullYear(), date.getMonth(), date.getDate()]);
  }
});
$(".datepickerblank").pickadate({
  format: "mm/dd/yyyy",
  selectMonths: true,
  selectYears: 100,
  min: new Date(1920, 1, 1),
  editable: true,
	});
$(".timepicker").click(function() {
  $("body").css({ overflow: "auto" });
});
$(".timepicker").pickatime({
  format: 'h:i A',
  clear: 'Clear',
  closeOnSelect: true,
  editable: true
});

// select button
$(".dropdown-select button.dropdown-item").click(function() {
  $(this)
    .parents(".dropdown")
    .find(".btn.dropdown-toggle")
    .html($(this).text() + ' <span class="caret"></span>');
  $(this)
    .parents(".dropdown")
    .find(".btn.dropdown-toggle")
    .val($(this).data("value"));
});

// select accordion
$(".accordion-select select").on("change", function(e) {
  var selected_value = $(this).val(),
    $target_elem = $('button[data-target="#' + selected_value + '"]');
  $target_elem.trigger("click");
});
$(".accordion-toggle").on("click", function() {
  var selected_value = $(this).attr("data-target");
  $(".accordion-select option").removeAttr("selected");
  $('.accordion-select option[value="' + selected_value + '"]').attr(
    "selected",
    "selected"
  );
});
$(".accordion-toggle").trigger("change");

$(".minus").click(function() {
  var $input = $(this)
    .parent()
    .find("input");
  var count = parseInt($input.val()) - 1;
  count = count < 1 ? 1 : count;
  $input.val(count);
  $input.change();
  return false;
});
$(".plus").click(function() {
  var $input = $(this)
    .parent()
    .find("input");
  $input.val(parseInt($input.val()) + 1);
  $input.change();
  return false;
});

// Noty
Noty.overrideDefaults({
  layout: "topRight",
  theme: "semanticui",
  dismissQueue: true, // If you want to use queue feature set this true
  timeout: "5000", // delay for closing event. Set false for sticky notifications
  force: false, // adds notification to the beginning of queue when set to true
  modal: false,
  progressBar: false,
  maxVisible: 10, // you can set max visible notification for dismissQueue true option
  closeWith: ["click", "button"], // ['click', 'button', 'hover']
  buttons: false, // an array of buttons
  callbacks: {
    onTemplate: function() {
      // Success
      if (this.options.type === "success") {
        this.barDom.innerHTML = '<div class="noty_body d-none">';
        this.barDom.innerHTML +=
          '<div class="noty_icon"><i class="material-icons">check</i></div><div class="noty_content"><h6 class="title">' +
          this.options.title +
          "</h6><p>" +
          this.options.text +
          "</p></div>";
      }
      // Error
      if (this.options.type === "error") {
        this.barDom.innerHTML = '<div class="noty_body d-none">';
        this.barDom.innerHTML +=
          '<div class="noty_icon"><i class="material-icons">error</i></div><div class="noty_content"><h6 class="title">' +
          this.options.title +
          "</h6><p>" +
          this.options.text +
          "</p></div>";
      }
      // Info
      if (this.options.type === "info") {
        this.barDom.innerHTML = '<div class="noty_body d-none">';
        this.barDom.innerHTML +=
          '<div class="noty_icon"><i class="material-icons">info</i></div><div class="noty_content"><h6 class="title">' +
          this.options.title +
          "</h6><p>" +
          this.options.text +
          "</p></div>";
      }
      // Warning
      if (this.options.type === "warning") {
        this.barDom.innerHTML = '<div class="noty_body d-none">';
        this.barDom.innerHTML +=
          '<div class="noty_icon"><i class="material-icons">warning</i></div><div class="noty_content"><h6 class="title">' +
          this.options.title +
          "</h6><p>" +
          this.options.text +
          "</p></div>";
      }
      // Alert
      if (this.options.type === "alert") {
        this.barDom.innerHTML = '<div class="noty_body d-none">';
        this.barDom.innerHTML +=
          '<div class="noty_icon"><i class="material-icons">warning</i></div><div class="noty_content"><h6 class="title">' +
          this.options.title +
          "</h6><p>" +
          this.options.text +
          "</p></div>";
      }
      // Reply
      if (this.options.type === "reply") {
        this.barDom.innerHTML = '<div class="noty_body d-none">';
        this.barDom.innerHTML +=
          '<div class="noty-header"><a href="' +
          this.options.category_link +
          '">' +
          this.options.category +
          '</a> <span class="noty-bull">&bull;</span> <span class="noty-date">' +
          moment(this.options.date).fromNow() +
          "</span></div>";
        this.barDom.innerHTML +=
          '<h5 class="from-name">' + this.options.from + "</h5>";
        this.barDom.innerHTML +=
          '<p class="noty-reply">' + this.options.text + "</p>";
        this.barDom.innerHTML += '<img src="' + this.options.avatar + '">';
        this.barDom.innerHTML += "<div>";
      }
    }
  }
});

// inputs
$.fn.inputFilter = function(inputFilter) {
  return this.on(
    "input keydown keyup mousedown mouseup select contextmenu drop",
    function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    }
  );
};

// Integer only
$(".input-integer").inputFilter(function(value) {
  return /^\d*$/.test(value);
});
// Integer limit
$(".input-limit").inputFilter(function(value) {
  return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500);
});
// Integer both positive and negative
$(".input-sign").inputFilter(function(value) {
  return /^-?\d*$/.test(value);
});
// Integer use . or , as decimal separator
$(".input-separator").inputFilter(function(value) {
  return /^-?\d*[.,]?\d*$/.test(value);
});
// Integer Currency
$(".input-currency").inputFilter(function(value) {
  return /^-?\d*[.,]?\d{0,2}$/.test(value);
});
// Letters only
$(".input-letters").inputFilter(function(value) {
  return /^[a-z]*$/i.test(value);
});
// checked allin table
$(".checkall").click(function() {
  var $checkboxes = $(".table").parent().find("input[type=checkbox]");
  $checkboxes.prop("checked", $(this).is(":checked"));
});

// Letters
$(".legal_size,.letter_size").hide();
$("#documentSheet").change(function() {
  $(".rx_size")[
    $("option[value='rx-sheet']").is(":checked") ? "slideDown" : "slideUp"
  ]();
  $(".letter_size")[
    $("option[value='letter-sheet']").is(":checked") ? "slideDown" : "slideUp"
  ]();
  $(".legal_size")[
    $("option[value='legal-sheet']").is(":checked") ? "slideDown" : "slideUp"
  ]();
});

// Table horizontal scroll fixed keft
$(".vertical-scroll").scroll(function(e) {
  $("thead").css("left", -$(".vertical-scroll").scrollLeft()); //fix the thead relative to the body scrolling
  $("thead th:nth-child(1)").css("left", $(".vertical-scroll").scrollLeft()); //fix the first cell of the header
  $("tbody th:nth-child(1)").css("left", $(".vertical-scroll").scrollLeft()); //fix the first column of tdbody
});