$(document).ready(function(){
	$('#data_table').Tabledit({
		deleteButton: false,
		editButton: false,   		
		columns: {
		  identifier: [0, 'icode'],                    
		  editable: [[1, 'iname'], [2, 'sup'], [3, 'wkhan'], [4, 'rkhan'], [5, 'unit']]
		},
		hideIdentifier: true,
		url: 'live_edit_ramp.php'		
	});
});