@extends('layouts.app')
@section('content')

<!--
<script>
    function tipo_guardado(tipo) 
    {
        var dato="{{ url('/registro/') }}/"+tipo;
        document.getElementById=myform.action=dato;
    }
</script>
-->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro') }}</div>

                <div class="card-body">
                    <form id="myform" action="" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6" align="right">
                                <button type="submit" class="btn btn-primary" onclick="tipo_guardado(0)">
                                    {{ __('Registrar Alumno') }}
                                </button>
                            </div>
                        @if (Auth::user()->tipo_usuario==2)
                            <div class="col-md-6"  align="center">
                                <button type="submit" class="btn btn-success" onclick="tipo_guardado(1)">
                                    {{ __('Registrar Maestro') }}
                                </button>
                            </div>
                        @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection