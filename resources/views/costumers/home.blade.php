@extends('layouts.app')

@section('content')
<div class="container">
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
                    <Div>
                        User ID: {{ $user->id }}
                    </Div>
                    <Div>
                        User Name: {{ $user->name }}
                    </Div>
                    <Div>
                        Company: {{ $user->company_id }}
                    </Div>
                    <br>
                    You are logged in!
                    <h1 style="text-align:center">Welcome To E-CWO</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
