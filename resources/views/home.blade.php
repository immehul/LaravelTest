@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Welcome to dashboard</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/user/search') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Search User') }} <span class="required">*</span></label>

                                <div class="col-md-6">
                                    <input id="search_user" type="text" class="form-control @error('search_user') is-invalid @enderror" name="search_user" value="{{ isset($searchData) ? $searchData : '' }}" placeholder="Search User" required autocomplete="search_user" autofocus>

                                    @if (\Session::has('success'))
                                        <div class="alert alert-danger">
                                            {!! \Session::get('success') !!}
                                        </div>
                                    @endif

                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($userData) && !empty($userData))
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Search Result</div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Tech Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                  </thead>
                                <tbody>
                                    @foreach($userData as $key => $value)
                                        <tr>
                                            <td>{{($key + 1)}}</td>
                                            <td>{{ $value->first_name }}</td>
                                            <td>{{ $value->last_name }}</td>
                                            <td>{{ $value->phone_number }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->tech_name }}</td>
                                            <td>
                                                @if($currentUserid !== $value->id)
                                                    <a href="{{ url('/user/send/request',['id' => $value->id]) }}"><button class="btn btn-primary">Sent Request</button></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                              </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>    
</div>
@endsection
