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

{{-- <b-container fluid style="height: calc(100vh - 56px);">
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
 --}}


 <b-container fluid style="height: calc(100vh - 56px);">
    <b-row >
        <b-col cols="4">
            <b-form class="my-3 mx-2">
                <b-form-input class="text-center"
                type="text"
                placeholder="Buscar Contacto">

                </b-form-input>
            </b-form>

            <b-list-group>
                <contact-component variant="dark"></contact-component>
                <contact-component variant=""></contact-component>
                <contact-component variant="secondary"></contact-component>
                
            </b-list-group>  
        </b-col>
        <b-col cols="8">
        </b-col>
    </b-row>
</b-container>
@endsection
