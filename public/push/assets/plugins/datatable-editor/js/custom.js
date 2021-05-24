var editor; // use a global for the submit and return data rendering in the examples
 
// id,user,description,amount,date_bill,note,payment_proof,payment_proof_date,status,las_status_change

$(document).ready(function() {
	editor = new $.fn.dataTable.Editor( {
		ajax: "Biaya/ajax",
		table: "#example",
		fields: [ { //kolom sesuai database yg mau ditampilin
				label: "Student:",
				name: "user"
			}, {
				label: "Description:",
				name: "description"
				// ,type: "datetime" //textarea
			}, {
				label: "Amount:",
				name: "amount"
			}
		],
		// formOptions: {inline: { onBlur: 'submit' }}
	} );
		
	// $('#example').on('click','tbody td:not(:first-child)', function(e){ editor.inline(this); }); // dari examples\inline-editing\simple.html. penting utk inline editing
		
	$('#example').DataTable( {
		dom: "Bfrtip", //button, filtering input
		ajax: {
			url: "Biaya/ajax",
			type: "POST" // ??
		},
		order: [[ 1, 'asc' ]], // dari examples\inline-editing\simple.html
		serverSide: true, // ??
		columns: [ //kolom sesuai jml tag <td>
			{
				data: null,
				defaultContent: '',
				className: 'select-checkbox',
				orderable: false
			},
      // { data:null, render:function(data,type,row){return data.first_name+' '+data.last_name;}}, // Combine 2 fields
			{ data: "user" },
			{ data: "description" },
			{ data: "amount", render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp.' ) }
		],
		select: true, // dari examples\extensions\responsive.html
		// lengthChange: false
		// keys: {
		// 	columns: ':not(:first-child)',
		// 	keys: [ 9 ],
		// 	editor: editor,
		// 	editOnFocus: true
		// },
		// select: { // dari examples\inline-editing\simple.html
			// style:    'os',
			// selector: 'td:first-child'
		// },
		buttons: [ //diklik ga terjadi apa2 ??
			{ extend: "create", editor: editor },
			{ extend: "edit",   editor: editor },
			{ extend: "remove", editor: editor }
		]
	} );
	
	
} );