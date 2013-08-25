$(document).ready(function() {
  $('#header ').click(function() {
		$(this).nextAll("div:next").slideToggle(200,"linear");
  });
});
