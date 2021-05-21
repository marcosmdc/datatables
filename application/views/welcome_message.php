<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
	<script src="<?php echo site_url('assets/js/jquery-3.1.1.min.js');?>"></script>
	<!-- <link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet"> -->
    <!-- data table -->
    <link href="<?php echo site_url('assets/css/plugins/dataTables/datatables.min.css'); ?>" rel="stylesheet">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link type="text/css" href=" <?php echo site_url('assets/css/dataTables.checkboxes.css'); ?>" rel="stylesheet" />
	
	
	

	
	<script src="<?php echo site_url('assets/js/bootstrap.js');?>"></script>
	<script src="<?php echo site_url('assets/js/plugins/dataTables/datatables.min.js');?>"></script>
	<script src="<?php echo site_url('assets/js/plugins/dataTables/dataTables.bootstrap4.min.js');?>"></script>
	<script src="https://datatables.net/release-datatables/extensions/Scroller/js/dataTables.scroller.js"></script>
	<script type="text/javascript" src="<?php echo site_url('assets/js/dataTables.checkboxes.min.js'); ?>"></script>
	

</head>


<body>

				
                    <table id="table" class=" table table-striped table-bordered table-hover" style="width:100%">
							<thead>
                                    <tr>
									<th></th>
                                        <th>Codigo</th>

                                        <th>Detalle</th>
                                        
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>


								<thead>
    
							<tfoot>
							<tr>
									<th></th>
                                        <th>Codigo</th>

                                        <th>Detalle</th>
                                        
                                        <th>Cantidad</th>
                                    </tr>
							</tfoot>
                            </table>
            <br>
			<label>Sumatoria Productos</label>
							<input type=text id="suma">
               
               
</body>





<script>




$(document).ready(function() {
    chargeTable();
	$('#table').on('click', 'tr', function () {
        var data = tableGlobal.row( this ).data();
		var rows_selected = tableGlobal.column(0).checkboxes.selected();
    } );

	$('#table').on('change', 'tr', function () {
        var data = tableGlobal.row( this ).data();
			var sumatoria = 0;

			/* recorre todos los checkbox */
			tableGlobal.rows().every(function (rowIdx, tableLoop, rowLoop) {
				var dataCheck = this.node();
				if($(dataCheck).find('input').prop('checked')){
					//console.log("es true");
					/* suma los checkbox = checked */
					sumatoria = parseInt(sumatoria) + parseInt(data['3']);
				}
			
			});

	
			$("#suma").val(sumatoria);

	});

})




function chargeTable() {
	tableGlobal = $('#table').DataTable( {
        serverSide: true,
        ordering: false,
        searching: false,
        ajax: {  url: 'index.php/Welcome/getDatos',"type": "POST", function ( data, callback, settings ) {
            var out = [];
 
            for ( var i=data.start, ien=data.start+data.length ; i<ien ; i++ ) {
                out.push( [ i+'-1', i+'-2', i+'-3'] );
            }

            setTimeout( function () {
                callback( {
                    draw: data.draw,
                } );
            }, 50 );
        }, 
	},
	'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
      'order': [[1, 'asc']],
        scrollY: 200,
        scroller: {
            loadingIndicator: true
        },
        stateSave: false
    } );
}




</script>





















</html>
