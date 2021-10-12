 @extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-11">
				 <div class="card">
					<div class="header">
						<h4 class="title"><?php echo trans('lang.expense_monthly_report');?> (<?php echo date("Y");?>)</h4>
					</div>
					<div class="content">
						<div class="table-responsive">
						<table id="monthlyreportsexpense" class="table table-striped table-bordered"  cellspacing="0" width="100%">
							<thead style="font-size:10px;background:#e3f1f4">
                                <tr>
                                    <th class="bold"><b><?php echo trans('lang.category');?></b></th>
                                    <th class="bold"><b><?php echo trans('lang.jan');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.feb');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.mar');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.apr');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.may');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.jun');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.jul');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.aug');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.sep');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.oct');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.nov');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.dec');?></b></th>                                        
									<th class="bold"><b><?php echo trans('lang.total');?></b></th>   
								</tr>
                            </thead>
							
							<tbody style="font-size:12px;">
							
							</tbody>
						</table>
						</div>
					</div>
				 </div>
			</div> 
		</div>

    </div>
</div>	


<script>


$(document).ready(function() {
	$.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
	});
	
	
	
	//get data
    var table = $('#monthlyreportsexpense').DataTable( {
			
			processing: true,
			serverSide: true,
			bFilter : false,
            ajax: {
				url : "{{ url('reports/getexpensemonthly')}}",
				
			},
			"language": {
            "decimal":        "",
                "emptyTable":     "<?php echo trans('lang.demptyTable');?>",
                "info":           "<?php echo trans('lang.dshowing');?> _START_ <?php echo trans('lang.dto');?> _END_ <?php echo trans('lang.dof');?> _TOTAL_ <?php echo trans('lang.dentries');?>",
                "infoEmpty":      "<?php echo trans('lang.dinfoEmpty');?>",
                "infoFiltered":   "(<?php echo trans('lang.dfilter');?> _MAX_ <?php echo trans('lang.total');?> <?php echo trans('lang.dentries');?>)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "<?php echo trans('lang.dshow');?> _MENU_ <?php echo trans('lang.dentries');?>",
                "loadingRecords": "<?php echo trans('lang.dloadingRecords');?>",
                "processing":     "<?php echo trans('lang.dprocessing');?>",
                "search":         "<?php echo trans('lang.dsearch');?>",
                "zeroRecords":    "<?php echo trans('lang.dzeroRecords');?>",
                "paginate": {
                    "first":      "<?php echo trans('lang.dfirst');?>",
                    "last":       "<?php echo trans('lang.dlast');?>",
                    "next":       "<?php echo trans('lang.dnext');?>",
                    "previous":   "<?php echo trans('lang.dprevious');?>"
                }
            },
			columns: [
				{ data: 'category', name:'category'},
				{ data: 'ijan', name:'ijan'},
				{ data: 'ifeb', name:'ifeb'},
				{ data: 'imar', name:'imar'},				
				{ data: 'iapr', name:'iapr'},		
				{ data: 'imay', name:'imay'},
				{ data: 'ijun', name:'ijun'},
				{ data: 'ijul', name:'ijul'},
				{ data: 'iags', name:'iags'},
				{ data: 'isep', name:'isep'},
				{ data: 'iokt', name:'iokt'},
				{ data: 'inov', name:'inov'},
				{ data: 'idec', name:'idec'},
				{ data: 'total', name:'total'}
			],
			dom: 'Bfrtip',

			buttons: [
				{
					extend: 'copy',
					text:   'Copy <i class="fa fa-files-o"></i>',
					title: '<?php echo trans('lang.expense_monthly_report');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV <i class="fa fa-file-excel-o"></i>',
					title: '<?php echo trans('lang.expense_monthly_report');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
					}
				},
				{
					extend:'pdf',
					text:   'PDF <i class="fa fa-file-pdf-o"></i>',
					title: '<?php echo trans('lang.expense_monthly_report');?>',
					className: 'btn btn-sm btn-fill btn-info ',
					orientation:'landscape',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.expense_monthly_report');?>',
					text:   'Print <i class="fa fa-print"></i>',
					className: 'btn btn-sm btn-fill btn-info ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
					}
				}
			]
    } );
	
	
		
} );


</script>
@endsection