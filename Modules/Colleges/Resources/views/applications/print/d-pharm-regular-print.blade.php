@include('colleges::applications.style') 
<?php 
$quota = (isset($application->quota) & $application->quota !=null) ? $application->quota : "";
$application_no =(isset($application->id) & $application->id !=null) ? $application->id+1000 : ""; 
$passport_size_photo = "Modules/Colleges/Resources/assets/img/passport_size.png";
if( isset($application->photo) & $application->photo !=null ):
    $path = 'public'.$application->photo; 
    if(File::exists($path)):  $passport_size_photo = $path;  endif;     
endif; 
$signature_applicant = $signature_parent =null;

if( isset($application->signature_applicant) & $application->signature_applicant !=null ):
    $path = 'public'.$application->signature_applicant; 
    if(File::exists($path)):  $signature_applicant = $path;  endif;     
endif;

if( isset($application->signature_parent) & $application->signature_parent !=null ):
    $path = 'public'.$application->signature_parent; 
    if(File::exists($path)):  $signature_parent = $path;  endif;     
endif;
 ?>
<!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
        <div class="responive-table" id="PrintMyApplication">
            <div class="container">
                <div class="clg">
                    <div class="table-responsive">
                        <table class="table-sm">
                            <tr>
                                <th colspan="2">
                                    <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between" class="table-header">
                                        <div class="logo">
                                            <a href="#"><img src="{{asset('Modules/Colleges/Resources/assets/img/logo_mgm.png')}}" alt="" class="img-fluid"></a>
                                        </div>
                                        <div class="table-header-content">
                                            
                                        <?php if(\Auth::guard(colleges_guard)->user()->id==9 && $application->hasForms->slug=='d-pharm-regular'): ?>
                                            <img src="/Logos/MgmLogo_D_pharm_regular_9.jpg" width="717">
                                        <?php elseif(\Auth::guard(colleges_guard)->user()->id==5 && $application->hasForms->slug=='d-pharm-regular'): ?>
                                            <img src="/Logos/MgmLogo_D_pharm_regular_5.jpg" width="717">
                                        <?php elseif(\Auth::guard(colleges_guard)->user()->id==7 && $application->hasForms->slug=='d-pharm-regular'): ?>
                                            <img src="/Logos/MgmLogo_D_pharm_regular_7.jpg" width="717">
                                        <?php elseif(\Auth::guard(colleges_guard)->user()->id==3 && $application->hasForms->slug=='d-pharm-regular'): ?>
                                            <img src="/Logos/MgmLogo_D_pharm_regular_3.jpg" width="717">
                                        <?php else: ?> 
                                            {!! \Auth::guard(colleges_guard)->user()->application_heading !!}
                                        <?php endif; ?>  
                                        
                                        </div>
                                        <div></div>

                                    </div>
                                    <h2 style="text-transform: uppercase;">APPLICATION FOR ADMISSION TO {{strtoupper($application->hasForms->name)}} COURSE {{date('Y')}}-{{date('Y')+1}}<br/> UNDER Government / Management QUOTA</h2>
                                    <div class="application">
                                        <span>Application No: {{$application_no}}</span>
                                        <img class="passport-size-photo" src="{{asset($passport_size_photo)}}" alt="">
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td><div class="si-no">1.</div> Name of the Candidate (In block letters)</td>
                                <td>{{(isset($application->name) & $application->name !=null) ? $application->name : ""}}</td>
                            </tr>
                            <tr>
                                <td><div class="si-no">2.</div> Permanent Address</td>
                                <td>{{(isset($application->permanent_address) & $application->permanent_address !=null) ? $application->permanent_address : ""}}</td>
                            </tr>
                            <tr>
                                <td><div class="si-no">3.</div> Address For Communication</td>
                                <td>
                                    <?php 
                                    if( isset($application->address_communication) && isset($application->p_address_for_communication)  && $application->p_address_for_communication ==0):
                                        echo $application->address_communication;  
                                    elseif( isset($application->p_address_for_communication) && isset($application->permanent_address)  && $application->p_address_for_communication ==1):
                                        echo $application->permanent_address;
                                    endif;
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><div class="si-no">4.</div> Email</td>
                                <td>{{(isset($application->email) & $application->email !=null) ? $application->email : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">5.</div> Date of Birth</td>
                                <td>{{(isset($application->date_of_birth) & $application->date_of_birth !=null) ? $application->date_of_birth : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">6.</div> Age</td>
                                <td>{{(isset($application->age) & $application->age !=null) ? $application->age : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">7.</div> Gender</td>
                                <td>{{(isset($application->gender) & $application->gender !=null) ? $application->gender : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">8.</div> Nationality</td>
                                <td>{{(isset($application->nationality) & $application->nationality !=null) ? $application->nationality : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">9.</div> Religion</td>
                                <td>{{(isset($application->religion) & $application->religion !=null) ? $application->religion : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">10.</div> Community</td>
                                <td>{{(isset($application->community) & $application->community !=null) ? $application->community : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">11.</div> Category</td>
                                <td>{{(isset($application->category) & $application->category !=null) ? $application->category : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">12.</div> Blood Group</td>
                                <td>{{(isset($application->blood_group) & $application->blood_group !=null) ? $application->blood_group : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">13.</div> Aadhar Number</td>
                                <td>{{(isset($application->aadhar_number) & $application->aadhar_number !=null) ? $application->aadhar_number : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">14(a).</div> Fathers Name</td>
                                <td>{{(isset($application->father_name) & $application->father_name !=null) ? $application->father_name : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">14(b).</div> Occupation</td>
                                <td>{{(isset($application->father_occupation) & $application->father_occupation !=null) ? $application->father_occupation : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">14(c).</div> Mobile No</td>
                                <td>{{(isset($application->father_mobile) & $application->father_mobile !=null) ? $application->father_mobile : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">15(a).</div> Mother's Name</td>
                                <td>{{(isset($application->mother_name) & $application->mother_name !=null) ? $application->mother_name : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">15(b).</div> Occupation</td>
                                <td>{{(isset($application->mother_occupation) & $application->mother_occupation !=null) ? $application->mother_occupation : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">15(c).</div> Mobile No</td>
                                <td>{{(isset($application->mother_mobile) & $application->mother_mobile !=null) ? $application->mother_mobile : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">16.</div> Annual Family Income</td>
                                <td>{{(isset($application->annual_family_income) & $application->annual_family_income !=null) ? $application->annual_family_income : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">17(a).</div> Guardian's Name</td>
                                <td>{{(isset($application->guardian_name) & $application->guardian_name !=null) ? $application->guardian_name : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">17(b).</div> Relation</td>
                                <td>{{(isset($application->guardian_relation) & $application->guardian_relation !=null) ? $application->guardian_relation : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">17(c).</div> Mobile No</td>
                                <td>{{(isset($application->guardian_mobile) & $application->guardian_mobile !=null) ? $application->guardian_mobile : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">18.</div> Order of preference of branches offered</td>
                                <td>
                                    <?php 
                                    $course_1 = null;
                                    if(isset($application->course_1) && $application->course_1 !=null ):
                                        $course_1 = \Modules\Colleges\Entities\Courses::find($application->course_1);
                                    endif;
                                    $course_2 = null;
                                    if(isset($application->course_2) && $application->course_2 !=null ):
                                        $course_2 = \Modules\Colleges\Entities\Courses::find($application->course_2);
                                    endif;
                                    $course_3 = null;
                                    if(isset($application->course_3) && $application->course_3 !=null ):
                                        $course_3 = \Modules\Colleges\Entities\Courses::find($application->course_3);
                                    endif;
                                    
                                    ?>
                                    <div> 1 : {{ (isset($course_1->name) && $course_1->name !=null) ? $course_1->name : ''}}</div>
                                    <div> 2 : {{ (isset($course_2->name) && $course_2->name !=null) ? $course_2->name : ''}}</div>
                                    <div> 3 : {{ (isset($course_3->name) && $course_3->name !=null) ? $course_3->name : ''}}</div>
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            
                            <tr>
                                <td><div class="si-no">19.</div> Name of the Institution last studied</td>
                                <td>{{(isset($application->last_institution) & $application->last_institution !=null) ? $application->last_institution : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">20.</div> Board of Study</td>
                                <td>{{(isset($application->last_board_study) & $application->last_board_study !=null) ? $application->last_board_study : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td colspan="2"><div class="si-no">21.</div> Details of Marks secured in the plus two examination</td>
                            </tr>
                            <tr>
                                <td><div class="si-no">21(a).</div> Register No</td>
                                <td>{{(isset($application->register_no) & $application->register_no !=null) ? $application->register_no : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">21(b).</div> Month & Year of passing</td>
                                <td>{{(isset($application->month_year_passing) & $application->month_year_passing !=null) ? $application->month_year_passing : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table class="sub-table">
                                        <tr class="text-center">
                                            <td style="width: 40%;" align="center">Subject</td>
                                            <td style="width: 20%;" align="center">Mark Obtained</td>
                                            <td style="width: 20%;" align="center">Maximum Marks</td>
                                            <td style="width: 20%;" align="center">Grade</td>
                                        </tr>
                                       
                                        <?php
                                        $plus_two_result = false;
                                        $rem_size = 0;
                                        if(isset($application->id)):
                                            $PlusTwo = \Modules\Colleges\Entities\PivotApplicationsPlusTwo::where('new_applications_id',$application->id)->get();;
                                            if($PlusTwo->isNotEmpty()):
                                                $plus_two_result = true;
                                                $rem_size = 10-sizeof($PlusTwo);
                                                foreach ($PlusTwo as $key => $value): 
                                                ?>
                                                    <tr>
                                                        <td style="width: 40%;font-weight: 100!important" align="center">{{$value->subject}}</td>
                                                        <td style="width: 20%;font-weight: 100!important" align="center">{{$value->mark_obtained}}</td>
                                                        <td style="width: 20%;font-weight: 100!important" align="center">{{$value->maximum_marks}}</td>
                                                        <td style="width: 20%;font-weight: 100!important" align="center">{{$value->grade}}</td>
                                                    </tr>
                                                <?php
                                                endforeach;
                                            endif;
                                        endif;
                                        if(!$plus_two_result):
                                            $rem_size = 10;
                                        endif;
                                        if($rem_size && $rem_size > 0):
                                            foreach (range(1, $rem_size) as $item):
                                            ?>
                                                    <tr>
                                                        <td style="width: 40%;font-weight: 100!important; height: 45px" align="center"></td>
                                                        <td style="width: 40%;font-weight: 100!important; height: 45px" align="center"></td>
                                                        <td style="width: 40%;font-weight: 100!important; height: 45px" align="center"></td>
                                                        <td style="width: 40%;font-weight: 100!important; height: 45px" align="center"></td>
                                                    </tr>
                                            <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: 100!important"><strong style="font-weight: 700!important">Grand Total :</strong>  {{(isset($application->grand_total) & $application->grand_total !=null) ? $application->grand_total : ""}}</td>
                                <td><strong>Total Percentage :</strong> {{(isset($application->total_percentage) & $application->total_percentage !=null) ? $application->total_percentage : ""}}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: 100!important"><strong style="font-weight: 700!important">Total of Physics + Chemistry + Biology/Mathematics/Computer Science :</strong> {{(isset($application->pcm_total) & $application->pcm_total !=null) ? $application->pcm_total : ""}}</td>
                                <td ><strong>Physics + Chemistry + Biology/Maths/Computer Science Percentage : </strong>{{(isset($application->pcm_percentage) & $application->pcm_percentage !=null) ? $application->pcm_percentage : ""}}</td>
                            </tr>
                            
<!--                            <tr>
                                <td colspan="2">22. Details of Entrance examination</td>
                                
                            </tr>
                            <tr>
                                <td>22. a)Register No.</td>
                                <td>{{(isset($application->entrance_register_number) & $application->entrance_register_number !=null) ? $application->entrance_register_number : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td>22. b)Rank</td>
                                <td>{{(isset($application->entrance_rank) & $application->entrance_rank !=null) ? $application->entrance_rank : ""}}</td>
                            
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
                                            <td style="width: 25%;font-weight: 100!important">{{(isset($application->paper_I_figures) & $application->paper_I_figures !=null) ? $application->paper_I_figures : ""}}</td>
                                            <td style="width: 25%;font-weight: 100!important">{{(isset($application->paper_I_words) & $application->paper_I_words !=null) ? $application->paper_I_words : ""}}</td>
                            
                                        </tr>
                                        <tr>
                                            <td style="width: 50%">
                                                <p>Paper II (Mathematics)</p>
                                            </td>
                                            <td style="width: 25%;font-weight: 100!important">{{(isset($application->paper_II_figures) & $application->paper_II_figures !=null) ? $application->paper_II_figures : ""}}</td>
                                            <td style="width: 25%;font-weight: 100!important">{{(isset($application->paper_II_words) & $application->paper_II_words !=null) ? $application->paper_II_words : ""}}</td>
                            
                                        </tr>
                                        <tr>
                                            <td style="width: 50%">
                                                <p>Total Marks</p>
                                            </td>
                                            <td style="width: 25%;font-weight: 100!important">{{(isset($application->total_figures) & $application->total_figures !=null) ? $application->total_figures : ""}}</td>
                                            <td style="width: 25%;font-weight: 100!important">{{(isset($application->total_words) & $application->total_words !=null) ? $application->total_words : ""}}</td>
                            
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">23. Details of NRI Sponsor (Only for NRI Quota)</td>
                            </tr>
                            <tr>
                                <td>23 a). Name of Sponsor</td>
                                <td>{{(isset($application->name_of_sponsor) & $application->name_of_sponsor !=null) ? $application->name_of_sponsor : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td>23 b). Occupation & Address</td>
                                <td>{{(isset($application->occupation_address) & $application->occupation_address !=null) ? $application->occupation_address : ""}}</td>
                            
                            </tr>-->
                            
                               <tr>
                                <td colspan="2"><div class="si-no">22(a).</div> Details of Marks secured in the SSLC examination</td>
                            </tr>
                            <tr>
                                <td><div class="si-no">22(a).</div> Board of Study</td>
                                <td>{{(isset($application->sslc_board) & $application->sslc_board !=null) ? $application->sslc_board : ""}}</td>
                            
                            </tr>
<!--                            <tr>
                                <td><div class="si-no">22(b).</div> Total marks</td>
                                <td>{{(isset($application->sslc_mark) & $application->sslc_mark !=null) ? $application->sslc_mark : ""}}</td>
                            
                            </tr>-->
                            <tr>
                                <td><div class="si-no">22(b).</div> Total % of marks</td>
                                <td>{{(isset($application->sslc_percentage) & $application->sslc_percentage !=null) ? $application->sslc_percentage : ""}}</td>
                            
                            </tr>
                            <tr>
                                <td><div class="si-no">23.</div> Quota</td>
                                <td>{{(isset($application->quota) & $application->quota !=null) ? $application->quota : ""}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="diclaration-area">
                        <div class="all-text">
                            <h3 class="mb-1">Declaration</h3>
                                <label style="text-align: justify"><input type="checkbox" checked="" disabled="">&nbsp; 
<!--                                    The above information is true to the best of my knowledge and belief and I understand that the admission shall be subject
                                to satisfying eligibility conditions as per PCI/AICTE/KUHS and Govt. of Kerala.-->
We, the applicant & parent / guardian do hereby declare that all the information furnished above are true and correct and we will obey the rules and regulations of the institution, if admitted.  Also we understand that the admission shall be, subject to satisfying the eligibility norms prescribed by the Statutory Authorities and the state Govt. from time to time.
                                </label>
                            
                            <div class="diclaration-form">
                                <div class="site">
                                    <p><div class="name-place-attr">Place</div> :
                                        <span style="font-weight: 100!important">
                                            {{(isset($application->place) & $application->place !=null) ? $application->place : ""}}
                                        </span>
                                    </p>
                                    <p><div class="name-place-attr">Date</div> :
                                        <span style="font-weight: 100!important">
                                        <?php if(isset($created_at) && $created_at): echo $created_at; endif; ?>
                                        </span>
                                    </p>
                                    <p> 
                                         <table style="border: none !important" width="100%">
                                        <tr style="border: none !important;">
                                            <td style="border: none !important;width: 100%;padding: 0">
                                            <div class="parent-signature-attr">Signature of the Parent</div> : 
                                            </td>
<!--                                        </tr>
                                        <tr style="border: none !important;">-->
                                            <td style="border: none !important" align="left">
                                               <?php if($signature_parent): ?>
                                                <img class="sign-photo sign-photo-margin" src="{{asset($signature_parent)}}" alt="">
                                            <?php endif; ?> 
                                            </td>
                                        </tr>
                                        
                                    </table>
                                    </p>
                                </div>
                                <div class="site">
                                    <p>&nbsp;</p>
                                    <p><div class="decl-attr">Name</div> : <span style="font-weight: 100!important">{{(isset($application->name) & $application->name !=null) ? $application->name : ""}}</span></p>
                                    <p>
                                    <table style="border: none !important" width="100%">
                                        <tr style="border: none !important;">
                                            <td style="border: none !important;width: 100%;padding: 0">
                                            <div class="decl-attr">Signature of the Applicant</div> : 
                                            </td>
<!--                                        </tr>
                                        <tr style="border: none !important;">-->
                                            <td style="border: none !important" align="left">
                                               <?php if($signature_applicant): ?>
                                                <img class="sign-photo" src="{{asset($signature_applicant)}}" alt="">
                                    <?php endif; ?> 
                                            </td>
                                        </tr>
                                        
                                    </table>
                                        
                                    
                                    </p>
                                   
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
                                    
                                    <p><div class="name-place-attr">Place</div> :</p>
                                    <p><div class="name-place-attr">Date</div> :</p>
                                </div>
                                <div class="site">
                                    <p><div class="office-use-attr">Signature</div> :</p>
                                    <p><div class="office-use-attr">Name</div> :</p>
                                    <p><div class="office-use-attr">Designation</div> :</p>
                                  
                                </div>
                            </div>
                        </div>
                        <div class="dv"></div>
                    </div>
                    <div class="diclaration-area">
                        <div class="all-text">
                            <p class="responise">The above candidate is admitted Provisionally to …………………………………………………………. on  …………………………………………………………. under Government / Management Quota.</p>
                            <div class="diclaration-form mt-1">
                                <div class="site">
                                    <p>Signature of Director</p>
                                </div>
                                <div style="text-align: right" class="site">
                                    <p>Signature of Principal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



            