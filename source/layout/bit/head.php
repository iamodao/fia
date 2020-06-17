
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Bremit Booking<?php if(fia::route() != 'index'){echo ' - '.fia::stringTo(fia::route(), 'oTITLE');} else {echo ' App';}?></title>
<script src="/asset/js/fontawesome.min.js"></script>
<link rel="stylesheet" href="/asset/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="/asset/vendors/css/vendor.bundle.base.css">
<?php
$css ='';
if(fia::route() == 'dashboard'){
	$css .='<link rel="stylesheet" href="/asset/vendors/flag-icon-css/css/flag-icon.min.css">'."\r\n";
	$css .='<link rel="stylesheet" href="/asset/vendors/jvectormap/jquery-jvectormap.css">'."\r\n";
}
echo $css;
?>
<link rel="stylesheet" href="/asset/css/demo/style.css">
<link rel="shortcut icon" href="/asset/images/favicon.png">
<link rel="stylesheet" href="/asset/odao.css">


<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="all">

