J(document).ready(function() {
	J(".tableorder").tablesorter({ //ordena a tabela com classe .table
		headers: {0:{sorter: false}}, 
		sortClassAsc: 'headersortup',		// Class name for ascending sorting action to header
		sortClassDesc: 'headersortdown',	// Class name for descending sorting action to header
		headerClass: 'header',			// Class name for headers (th's)
		widgets: ['zebra']
	});
	 
});

