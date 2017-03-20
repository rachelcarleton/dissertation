$( "#viewBookings" ).click(function() {
  $( ".bookings" ).show("slow");
$(this).hide();
});

$( ".hideBookings" ).click(function() {
  $( ".bookings" ).hide("slow");
$("#viewBookings").show("slow");
});