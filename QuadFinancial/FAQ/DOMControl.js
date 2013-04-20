$(document).ready(function() {
  $('#faqs h6').each(function() {
    var tis = $(this), state = false, answer = tis.next('div').hide().css('height','auto').slideUp();
    tis.click(function() {
      state = !state;
      answer.slideToggle(state);
      tis.toggleClass('active',state);
    });
  });
  $('#faqs h5').each(function() {
    var tis = $(this), state = false, answer = tis.next('div').hide().css('height','auto').slideUp();
    tis.click(function() {
      state = !state;
      answer.slideToggle(state);
      tis.toggleClass('active',state);
    });
  });
});