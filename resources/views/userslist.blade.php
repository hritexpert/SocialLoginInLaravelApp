<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Laravel</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600"
	rel="stylesheet" type="text/css">

<!-- Styles -->
<style>
</style>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<style>
#table_id th,#table_id td{ width:15px!important;}
</style>
<link href="https://staging.logoleader.com/admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
</head>
<body>
<style type="text/css">
   ul li {
        display: inline!important;
        color:#ffffff!important;
    }
</style>
<div class="container">
    <div align="center" style="top:0px;font-family: 'Agency FB';background-color:#f7f4cf;height:50px"><h1>Social Login App</h1></div>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner nav-collapse" style="height:50px;">
            <ul class="nav">
                <li class="active"><a href="/home2/">Home</a></li>
                <li><a href="/users/list/">Users List</a></li>
                @if(Session::has('user'))
                    <li><a href="/logout">Log Out</a></li>
                @else
                    <li><a href="/home"> Log In</a></li>
                @endif
            </ul>
        </div>
    </div>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="modal fade" id="errorModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Users List</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <table style="width: 100%;" id="subscriptions" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" >
                                <thead>
                                <tr>
                                    <th abbr="u|id">ID</th>
                                    <th abbr="u|username">Username</th>
                                    <th abbr="u|email">Email</th>
                                    <th abbr="u|phone">Phone</th>
                                    <th abbr="u|socialid">Social ID</th>
                                </tr>
                                </thead>
								<tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">
                                        <input placeholder="Search" type="text">
                                    </th>
									<th rowspan="1" colspan="1">
                                        <input placeholder="username search" type="text">
                                    </th>
									<th rowspan="1" colspan="1">
                                        <input placeholder="email search" type="text">
                                    </th>
									<th rowspan="1" colspan="1">
                                        <input placeholder="phone search" type="text">
                                    </th>
									<th rowspan="1" colspan="1">
                                        <input placeholder="social ID search" type="text">
                                    </th>
								</tr>
								</tfoot>
                            </table>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- /page content -->
</div>
<script>

 var table = $('#subscriptions').DataTable( {

                "lengthMenu": [ 10, 25, 50, 75, 100,1000 ],
                "order": [[ 0, "desc" ]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "https://dev.laravel.com/getusers",
                    "data": function ( d ) {
                        d.sortname = sortname;
                        d.startDate = startDate;
                        d.endDate = endDate;
                    }
                },
                "dom": "Blfrtip"

            } );






  // Apply the search
            table.columns().every( function () {
                var that = this;
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that.search( this.value ).draw();
                    }
                } );
            } );
























var sortname=$(this).attr('abbr');
                if(sortname == 'undefined'){
                    sortname='o|id';
                }

            var startDate='';
var endDate = '';
/*
var data = $.ajax({
  url: "https://dev.laravel.com/getusers",
  success: function(json2){
    //var data = data;
	console.log(json2);
        /*$('#table_id tbody').empty();
	    $.each(data, function (a, b) {
                $('#table_id tbody').append("<tr><td>"+b.id+"</td>" +
                    "<td>"+b.username+"</td>"+
                    "<td>" + b.email + "</td>" +
                    "<td>" + b.phone + "</td></tr>" +
					"<td>" + b.socialid + "</td></tr>");
            });* /
			//var json1 = [{"id":97,"username":"VwEP8"},{"id":98,"username":"dvDVl"},{"id":99,"username":"oelRk"}];
			//$('#table_id').DataTable({
    //data: json1,

	$('#table_id').DataTable({
    data: json2,
    columns: [
        { data: 'id' },
        { data: 'username' },
		{ data: 'email' },
		{ data: 'phone' },
		{ data: 'socialid' }
    ],
    "pageLength": 10
});


  }
});
*/




/* START */
       // Apply the search


	    var table = $('#table_id').DataTable( {

                "order": [[ 0, "desc" ]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "https://dev.laravel.com/getusers",
                    "data": function ( o ) {
                        o.sortname = sortname;
                        o.startDate = startDate;
                        o.endDate = endDate;
                    }
                },


				columns: [
        { data: 'id' },
        { data: 'username' },
		{ data: 'email' },
		{ data: 'phone' },
		{ data: 'socialid' }
    ],





            } );




/* END */
 // Apply the search
            table.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                                .search( this.value )
                                .draw();
                    }
                } );

                $( 'select', this.footer() ).on( 'change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );

            } );


/*
$(document).ready( function () {
    $('#table_id').DataTable();
} );
*/

</script>
</body>
</html>
