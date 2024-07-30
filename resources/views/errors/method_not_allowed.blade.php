{{-- @extends('layouts.app') --}}

@section('content')
    <div class="container">
        <div class="alert alert-danger">
            <h4 class="alert-heading">Erro!</h4>
            <p>O método HTTP não é permitido para acessar esta página.</p>
            <p><a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a></p>
        </div>
    </div>
@endsection
