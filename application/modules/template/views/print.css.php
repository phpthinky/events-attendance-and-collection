/* Styles go here */
.table{width:100%;margin-bottom:1rem;color:#212529}
.table td,.table th{padding:.75rem;vertical-align:top;border-top:1px solid #dee2e6}
.table thead th{vertical-align:bottom;border-bottom:2px solid #dee2e6}
.table tbody+tbody{border-top:1px solid #dee2e6}
.table-sm td,.table-sm th{padding:.3rem}
.table-bordered td,.table-bordered th{border:1px solid #dee2e6}
.table-bordered thead td,
.table-bordered thead th{border-bottom-width:2px}
.table-striped tbody tr:nth-of-type(odd){background-color:rgba(0,0,0,.05)}
.table-hover tbody tr:hover{color:#212529;background-color:rgba(0,0,0,.075)}

.page-header, .page-header-space {
  height: 100px;
}

.page-footer, .page-footer-space {
  height: 50px;

}

.page-footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  border-top: 1px solid black; /* for demo */
  background: #fff; /* for demo */
}

.page-header {
  position: fixed;
  top: 2mm;
  width: 100%;
  border-bottom: 1px solid black; /* for demo */
  background: #fff; /* for demo */
}

.page {
  page-break-after: always;
}

@page {
  margin: 20mm
}

@media print {
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   
   button {display: none;}
   
   body {margin: 0;}
}