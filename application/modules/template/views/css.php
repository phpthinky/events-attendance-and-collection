<style>

.site-title{
	font-style: unset;
	font-size: 18px;
	font-weight: bold;
	font-family: georgia;
	color: #ffffff;
	padding: 3px;
	text-align: center;
	width: 200px;
	display: inline-block;
}
.profile-photo{
	height: 200px;
	width: 200px;
	border: solid 1px #e1e1e1;
}
.table-profile-photo{

	height: 100px;
	width: 100px;
	border: solid 1px #e1e1e1;
}
.dataTables_wrapper .dataTables_length, .dataTables_filter{
		display: 	none;
}
.dataTables_wrapper .dt-buttons{
	visibility: hidden;
}

.w-100{
	width: 100% !important;
	min-width: 100% !important;
}
/*------------Forms-------------*/
.pointer{
	cursor: pointer;
}
.bg-black{
	background-color: black;
}


.bg-grey{
	background-color: lightgrey !important;
}
.text-title{
	font-weight: bold;
	padding: 10px;
}
.text-dgrey{
	color: darkgrey;
}
.form-control{
	background-color: lightyellow;
}
.divider-50{
	display: block;
	height: 50px;
}
.h-200{
	height: 200px;
	min-height: 200px;
	max-height: 200px;
}
body{
	color: black;
	font-size: 12px;
}
.print-header{
	visibility: hidden;
}
.modal > .modal-dialog > .modal-content > .modal-body.form{
	/*background-color: #F0FFFF;*/
	background-color: #F0FFFF;
	color: #000;
}
.card > .card-body{
	background-color: #F0FFFF;
	color: #000;
}
.card > .card-body.form{
	/*background-color: #F0FFFF;*/
	background-color: #ADD8E6;
	color: #000;
}


@media print{

	.print-6{
		width: 50%;
		display: inline-block;
	}
	.print-12{
		width: 100%;
		display: inline-block;
	}
	.print-header{
		visibility: visible;
	}
	.nav,button,.btn,.form-control,a{
		visibility: hidden;
	}
	.selections{
		visibility: hidden;
	}
}
</style>

