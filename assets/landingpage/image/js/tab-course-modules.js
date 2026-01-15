$(function() {
$('.tab-title').on('click', function(e) {
    e.preventDefault();
    var _self = $(this);
    $('.tab').removeClass('active');
    _self.parent().addClass('active');
  });
});