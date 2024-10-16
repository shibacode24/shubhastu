$(function() {
	"use strict";
	
	
	    $(document).ready(function() {
			$('#example').DataTable();
			$('#example6').DataTable();
		  } );
		  
		  
		  
		  $(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				//buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );

		 
		$(document).ready(function() {
			var table = $('#example5').DataTable( {
				lengthChange: true,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example5_wrapper .col-md-6:eq(0)' );
		} );
	
	
	});