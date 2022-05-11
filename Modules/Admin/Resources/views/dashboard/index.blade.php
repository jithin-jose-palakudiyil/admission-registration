@extends('admin::layouts.master')

@section('content')
        <div class="col-md-6 col-xl-4">
            <div class="card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-sm bg-soft-success rounded">
                            <i class="fe-clipboard avatar-title font-22 text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-right">
                            <h3 class="text-dark my-1">@if(isset($user_count)) {{$user_count}} @endif</h3>
                            <p class="text-muted mb-1 text-truncate">Total Registrations</p>
                        </div>
                    </div>
                </div> 
            </div> <!-- end card-box-->
        </div> <!-- end col -->
@endsection
