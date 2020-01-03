@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}

 <b-container fluid style="height: calc(100vh - 56px);">
        <b-row no-gutters>
            <b-col cols="4">
                <contact-list-component></contact-list-component>   
            </b-col>
            <b-col cols="8">
                <active-conversation-component></active-conversation-component>
            </b-col>
        </b-row>
</b-container>


@endsection
