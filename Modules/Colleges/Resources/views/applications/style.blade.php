<?php if(isset($print_my_application)):
    $colleges_applications_show= route('colleges_applications_show',$application->id);
?> 
@include('colleges::layouts.header')

<script>
    $(function() 
    {
        printDiv('PrintMyApplication');
    }); 
    window.addEventListener("afterprint", myFunction);

    function myFunction() {
      window.location.href='{{$colleges_applications_show}}'
    }
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>   

<?php endif; ?>
 <style>
            *,
            *:before,
            *:after {
            box-sizing: border-box;
            }
            body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 17px;
            font-weight: 400;
            background: #E6E6E6;
            color: #000000;
            margin: 0;
            }
            h1,
            h2,
            h3,
            h4,
            h5,
            h6,
            p,
            ul,
            li,
            a {
           
    
    
    font-family: Arial, Helvetica, sans-serif !important;
    color: #101010 !important;
	            	
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style: none;
            }
            a:hover {
            text-decoration: none;
            }
            /* header section end */
            .clg {
            padding: 20px 30px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, .2);
            }
            .clg table {
            width: 100%;
            border-collapse: collapse;
            }
            .clg table,
            .clg table tr,
            .clg table tr td {
            border: 1px solid #999;
            }
            .clggm-table table tr th {
            padding: 5px;
            }
            .clg table tr th p {
            font-weight: normal;
            }
            .clg table tr td {
            width: 50%;
            padding: 10px 10px;
            }
            .clg table tr td:first-child {
            font-weight: 700;
            }
            .table-header {
            display: flex;
            align-items: center;
            padding: 10px 0 0 20px;
            }
            .table-header .logo {
            max-width: 250px;
            }
            .table-header .logo img {
            max-width: 100px;
            }
            .table-header-content {
            margin-left: 10px;
            }
            .si-no{
                min-width: 50px; 
                display:inline-block
            }
            .name-place-attr{
                min-width: 50px; 
                display:inline-block;
                font-weight: bold;
            }

            .parent-signature-attr{
                min-width: 205px; 
                display:inline-block;
                font-weight: bold;
            }
            .office-use-attr{
                min-width: 110px;
                display:inline-block;
                font-weight: bold;

            }
            .decl-attr{
                min-width: 230px;
                display:inline-block;
                font-weight: bold;

            }
            .table-header-content h1 {
            font-size: 21px;
            color: #000000;
            font-weight: 700;
            text-transform: uppercase;
            }
            .table-header-content h4 {
            font-size: 16px;
            color: #4F4E4E;
            }
            .table-header-content h5 {
            font-size: 18px;
            color: #000000;
            font-weight: 400;
            margin: 10px 0
            }
            .table-header-content h5 span {
            text-transform: uppercase;
            }
         .clg table tr th h2 {
    font-size: 19px;
    color: #000000;
    font-weight: 700;
    text-align: center;
    padding: 20px;
}
         .clg table tr th .application {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
    align-items: center;
}
            .clg table tr th .application span {
            font-size: 16px;
            font-weight: 700px;
            color: #000000;
            }
            .application img {
            max-width: 180px;    max-height: 180px;
            }
            .in-table tr td p {
            font-weight: normal;
            }
            .diclaration-area {
            padding-top: 30px;
            }
            .diclaration-area h3 {
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
            }
            .all-text {
            padding: 0 20px;
            }
            .diclaration-form {
            display: flex;
            }
            .site {
            width: 50%;
            }
            .passport-size-photo{
                height: 200px!important;
                width: 150px!important;
            }
            .sign-photo{
                height: 60px!important;
                width: 140px!important;
            }

            .sign-photo-margin{
                margin-right: 28px
            }

            .site p {
            font-weight: 700;
            margin: 20px 0;
            }
            .diclaration-area .dv {
            background: #000 !important;
            width: 100%;
            height: 1px;
            margin-top: 10px;
            }
            .diclaration-area h4 {
            border-bottom: 1px splod #999;
            text-align: center;
            text-decoration: underline;
            font-weight: 700;
            margin-bottom: 10px;
            }
            .table-header-content {
            text-align: left;
            margin-bottom: 0px;
            }
            .container {
            max-width: 950px;
            margin-left: auto;
            margin-right: auto;
            }
            [colspan="2"] {
            padding: 15px;
            }
            /*
            ====================================
            Xtra Small Screen - Small Mobile
            ====================================
            */
            @media screen and (max-width: 767px) {
            .clg {
            padding: 8px;
            background: #fff;
            }
            .table-header {
            padding: 10px 0;
            }
            .table-header-content h1 {
            font-size: 16px;
            color: #000000;
            font-weight: 700;
            text-transform: uppercase;
            }
            .table-header-content h5 {
            font-size: 16px;
            }
            .table-header-content h4 {
            margin: 10px 0;
            font-size: 16px;
            }
            .clg table tr th h2 {
            font-size: 17px;
            }
            .responise {
            font-size: 17px;
            }
            .clg table tr td {
            padding: 10px 5px;
            font-size: 15px;
            }
            .table-header .logo img {
            max-width: 130px;
            }
            }
        </style> 
