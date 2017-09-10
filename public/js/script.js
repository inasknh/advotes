$(document).ready(function(){
  $(".button-collapse").sideNav({
    menuWidth: 300, // Default is 300
    edge: 'left', // Choose the horizontal origin
    closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
    draggable: true // Choose whether you can drag to open on touch screens,
  });
  $('ul.tabs').tabs();
  $('.tooltipped').tooltip({delay: 50});
  $(".select").on('change', function(){
  var index = $( ".select" ).index( this );
    $( ".scope" ).eq(index).val($(".select").eq(index).val());
  });

  $('.datepicker').pickadate({
    container: 'body'
  })

  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Hari Ini',
    clear: 'Hapus',
    close: 'Ok',
    closeOnSelect: false // Close upon selecting a date,
  });

  $('select').material_select();

  //modal controller
  $('.modal').modal();
  if($('#error').val() == 1){
      $('#addWatchmen').modal('open');
  }

  if($('#addSucces').val() == 1){
      Materialize.toast('Sukses menambahkan penjaga!', 5000);
  }

  if($('#editSucces').val() == 1){
      Materialize.toast('Sukses mengedit penjaga!', 5000);
  }

  if($('#destroySucces').val() == 1){
      Materialize.toast('Penjaga telah dihapus!', 5000);
  }
});
