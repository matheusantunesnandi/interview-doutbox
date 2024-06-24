@extends('layouts.main')

@section('title', 'Feed')

@section('navbar_users_index', 'active')

@section('content')

    @foreach ($users as $k => $user)
        <div class="row mt-2">
            <div class="col col-md-8 col-lg-10">
                <div class="row">
                    <div class="col-1">
                        <strong>{{ $user->id }}</strong>
                    </div>

                    <div class="col">
                        {{ $user->name }}
                    </div>

                    <div class="col">
                        {{ $user->email }}
                    </div>
                </div>
            </div>

            <div class="col">

                <div class="row">
                    <div class="col-sm-12 col-md-6 p-1">
                        <form method="POST" action="{{ url('/users/' . $user->id) }}" id="form-remove-user">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Remove" class="btn btn-sm btn-outline-danger w-100 text-nowrap">
                        </form>
                    </div>

                    <div class="col-sm-12 col-md-6 p-1">
                        @if (!$user->isAdmin())
                            <form method="POST" action="{{ url('/users/' . $user->id . '/make-admin') }}"
                                id="form-make-admin">
                                @csrf
                                <input type="submit" value="Make admin"
                                    class="btn btn-sm btn-outline-primary w-100 text-nowrap">
                            </form>
                        @else
                            <form method="POST" action="{{ url('/users/' . $user->id . '/revoke-admin') }}"
                                id="form-make-admin">
                                @csrf
                                <input type="submit" value="Revoke admin"
                                    class="btn btn-sm btn-outline-danger w-100 text-nowrap">
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
