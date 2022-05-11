 
<form  class="form-horizontal" id="BtechRegularForm" method="post" enctype="multipart/form-data" action="{{route('btech_regular_store',\Crypt::encryptString($decrypted_forms_college_id))}}" class="form-horizontal">
    @csrf
    <div id="basicwizard"> 
        @include('applications::forms.btech-regular.partials.nav-item') 
        <div class="tab-content b-0 mb-0 pt-0 BasicwizardTabs">
            @include('applications::forms.btech-regular.form.personal-informations')
            @include('applications::forms.btech-regular.form.family-informations')
            @include('applications::forms.btech-regular.form.education-informations')
            @include('applications::forms.btech-regular.form.entrance-informations')
            @include('applications::forms.btech-regular.form.finish')
            
            <ul class="list-inline wizard mb-0">
                <li class="previous list-inline-item">
                    <a href="javascript: void(0);" class="btn btn-secondary">Previous</a>
                </li>
                <li class="next list-inline-item float-right" id="NextBtn">
                    <!--<button type="submit" >submit</button>-->
                    <a href="javascript: void(0);" class="btn btn-secondary AhrefNextBtn">Next</a>
                </li>
            </ul>

        </div> <!-- tab-content -->
    </div> <!-- end #basicwizard-->
</form>

@push('scripts')

@endpush

@section('css') 
 <!-- Plugins css-->
        <!--<link href="{{asset('public/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet" type="text/css" />-->
        <!--<link href="{{asset('public/assets/libs/clockpicker/bootstrap-clockpicker.min.css')}}" rel="stylesheet" type="text/css" />-->
        <link href="{{asset('public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
        <!--<link href="{{asset('public/assets/libs/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />-->
        @endsection
@section('js') 
        <!-- Vendor js -->
        <script src="{{asset('public/assets/js/vendor.min.js')}}"></script>
        <!-- Plugins js-->
        <script src="{{asset('public/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
        <!-- Init form  js-->
          <script src="{{asset('public/assets/libs/moment/moment.min.js')}}"></script>
        <!--<script src="{{asset('public/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>-->
        <!--<script src="{{asset('public/assets/libs/clockpicker/bootstrap-clockpicker.min.js')}}"></script>-->
        <script src="{{asset('public/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
        <!--<script src="{{asset('public/assets/libs/daterangepicker/daterangepicker.js')}}"></script>-->

        
         
        <script src="{{asset('public/plugins/validation/validate.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/plugins/validation/jquery.validate.file.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/plugins/intlTelInput/intlTelInput.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('Modules/Applications/Resources/assets/js/btech-regular-form.js')}}"></script>
       
@endsection