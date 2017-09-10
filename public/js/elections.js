$(document).ready(function() {
    $(document).on('change','#elections_selections',function(){
      $('#start_date').text($(":selected").attr('data-start'));
      $('#end_date').text($(":selected").attr('data-end'));
    });
});
