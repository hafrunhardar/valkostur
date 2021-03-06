/** Days to be disabled as an array */
var disableddates = ["20-06-2017", "12-11-2014", "12-25-2014", "12-20-2014"];


function DisableSpecificDates(date) {
	var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
	    return [disableddates.indexOf(string) == -1];
	  }
	 
	var m = date.getMonth();
	var d = date.getDate();
	var y = date.getFullYear();

	// First convert the date in to the mm-dd-yyyy format 
	// Take note that we will increment the month count by 1 
	var currentdate = (m + 1) + '-' + d + '-' + y ;

	// We will now check if the date belongs to disableddates array 
	for (var i = 0; i < disableddates.length; i++) {

		// Now check if the current date is in disabled dates array. 
		if ($.inArray(currentdate, disableddates) != -1 ) {
			return [false];

		}
	}

}


$(function() {
  $("#date").datepicker({
    beforeShowDay: DisableSpecificDates
  });
});