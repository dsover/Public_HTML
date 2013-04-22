$(document).ready(function() {
  $('#header ').click(function() {
		$(this).nextAll("div:next").slideToggle(600,"linear");
  });
});
