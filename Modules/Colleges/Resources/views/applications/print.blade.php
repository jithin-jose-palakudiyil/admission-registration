
<?php

$approved_by = null;
if($application->hasForms->slug == 'btech-regular'):
    $approved_by ='Approved by AICTE New Delhi & Affiliated to APJ Abdul kalam Technological University';
endif;
 
?>
<!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
        <div class="responive-table">
            <div class="container">
                <div class="clg">
                    <div class="table-responsive">
                        <table class="table-sm">
                            <tr>
                                <th colspan="2">
                                    <div class="table-header">
                                        <div class="logo">
                                            <a href="#"><img src="{{asset('Modules/Colleges/Resources/assets/img/logo_mgm.png')}}" alt="" class="img-fluid"></a>
                                        </div>
                                        <div class="table-header-content">
                                            <h1>{!! \Auth::guard(colleges_guard)->user()->name !!}
                                            </h1>
                                            <h4>Approved by AICTE New Delhi & Affiliated to APJ Abdul kalam Technological University</h4>
                                           
                                        </div>
                                    </div>
                                    <h2>APPLICATION FOR ADMISSION TO B.PHARM DEGREE COURSE 2020-21- .......... QUOTA</h2>
                                    <div class="application">
                                        <span>Application No:</span>
                                        <img src="{{asset('Modules/Colleges/Resources/assets/img/passport_size.png')}}" alt="">
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td>1. Name of the Candidate (In block letters)</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2. Permanent Address</td>
                                <td>Pin : .................., Phone Number : ....................................</td>
                            </tr>
                            <tr>
                                <td>3. Address For Communication</td>
                                <td>Pin : .................., Phone Number : ....................................</td>
                            </tr>
                            <tr>
                                <td>4. Email</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5. Date of Birth</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>6. Age</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>7. Gender</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>8. Nationality</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>9. Religion</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>10. Community</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>11. Category</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>12. Blood Group</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>13. Aadhar Number</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>14(a). Fathers Name</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>14(b). Occupation</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>14(c). Mobile No</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>15(a). Mother's Name</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>15(b). Occupation</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>15(c). Mobile No</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>16. Annual Family Income</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>17(a).Guardian's Name</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>17(b) Relation</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>17(c) Mobile No</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>18. Name of the Institution last studied</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>19. Board of Study</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2">20. Details of Marks secured in the plus two examination</td>
                            </tr>
                            <tr>
                                <td>20. a) Register No</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>20. b) Month & Year of passing</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table class="sub-table">
                                        <tr class="text-center">
                                            <td style="width: 50%;">Subject</td>
                                            <td>Mark Obtained</td>
                                            <td>Maximum Marks</td>
                                            <td>Grade</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>Grand Total : </td>
                                <td ><strong>Total Percentage :</strong></td>
                            </tr>
                            <tr>
                                <td>21. Details of Entrance examination</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>21. a)Register No.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>21. b)Rank</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table class="in-table text-center" style="text-align: center;">
                                        <tr>
                                            <td rowspan="2" style="width: 50%">Subject</td>
                                            <td colspan="2" style="width: 25%">Mark Scored</td>
                                           
                                        </tr>
                                        <tr>
                                        
                                            <td style="width: 25%"> In Figures </td>
                                            <td style="width: 25%"> In Words</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%">
                                                <p>Paper I(Physics & Chemistry)
                                                </p>
                                            </td>
                                            <td style="width: 25%"></td>
                                            <td style="width: 25%"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%">
                                                <p>Paper II (Biology)</p>
                                            </td>
                                            <td style="width: 25%"></td>
                                            <td style="width: 25%"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 50%">
                                                <p>Total Marks</p>
                                            </td>
                                            <td style="width: 25%"></td>
                                            <td style="width: 25%"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="diclaration-area">
                        <div class="all-text">
                            <h3 class="mb-1">Declaration</h3>
                            <form action="" method="">
                                <label><input type="checkbox">&nbsp; The above information is true to the best of my knowledge and belief and I understand that the admission shall be subject
                                to satisfying eligibility conditions as per PCI/AICTE/KUHS and Govt. of Kerala.</label>
                            </form>
                            <div class="diclaration-form">
                                <div class="site">
                                    <p>Place :</p>
                                    <p>Date :</p>
                                </div>
                                <div class="site">
                                    <p>Name :</p>
                                    <p>Signature of the Applicant : </p>
                                    <p>Signature of the Parent :</p>
                                </div>
                            </div>
                        </div>
                        <div class="dv"></div>
                    </div>
                    <div class="diclaration-area">
                        <div class="all-text">
                            <h3>FOR OFFICE USE ONLY</h3>
                            <h4 class="text-center">CERTIFICATE
                            </h4>
                            <p class="mt-3 mb-3">Certified that the candidate has passed the qualifying examination mentioned and I have verified the original mark list with the
                                entries made above and found correct.
                            </p>
                            <div class="diclaration-form">
                                <div class="site">
                                    <p>Rank :
                                    </p>
                                    <p>Place :</p>
                                    <p>Date :</p>
                                </div>
                                <div class="site">
                                    <p>Signature :
                                    </p>
                                    <p>Name :</p>
                                    <p>Designation :</p>
                                    <p>Address :</p>
                                </div>
                            </div>
                        </div>
                        <div class="dv"></div>
                    </div>
                    <div class="diclaration-area">
                        <div class="all-text">
                            <p class="responise">The above candidate is admitted Provisionally to ................. on  ................ under MQ / Govt. Quota.</p>
                            <div class="diclaration-form mt-1">
                                <div class="site">
                                    <p>Signature of Director</p>
                                </div>
                                <div class="site">
                                    <p>Signature of Principal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <style>
            *,
            *:before,
            *:after {
            box-sizing: border-box;
            }
            body {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            font-weight: 400;
            background: #E6E6E6;
            color: #333333;
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
            font-size: 20px;
            color: #000000;
            font-weight: 700;
            text-align: center;
            }
            .clg table tr th .application {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-top: 10px;
            }
            .clg table tr th .application span {
            font-size: 16px;
            font-weight: 700px;
            color: #000000;
            }
            .application img {
            max-width: 180px;
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