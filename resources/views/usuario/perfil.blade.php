@extends('layouts.app')
@section('content')

<!--
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

<script>

    function cancelar()
    {
        document.getElementById=password.value="";
        document.getElementById=password_nuevo.value="";
    }

    function enviar()
    {
        Swal.fire({
          title: 'Do you want to save the changes?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: `Confirmar`,
          denyButtonText: `Cancelar`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            Swal.fire('Saved!', '', 'success')
          } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
            return false;
          }
        })
    }
</script>
-->

@if(count($errors)>0)
  <div class="aler alert-danger" role="alert">
    <ul>
      @foreach($errors->all() as $error)
        <li> {{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if (isset($mensaje2))
{{$usuario->nombre}}
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Datos personales') }}</div>

                <div class="card-body">
                    <form id="myform" action="{{ url('/update/'.Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{isset($usuario->nombre)?$usuario->nombre:old('nombre')}}" required autocomplete="nombre" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{isset($usuario->email)?$usuario->email:old('email')}}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="semestre" class="col-md-4 col-form-label text-md-end">{{ __('Semestre') }}</label>

                            <div class="col-md-6">
                                <input id="semestre" type="text" class="form-control @error('email') is-invalid @enderror" name="semestre" value="{{isset($usuario->semestre)?$usuario->semestre:old('semestre')}}" required autocomplete="semestre" disabled readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="promedio" class="col-md-4 col-form-label text-md-end">{{ __('Promedio') }}</label>

                            <div class="col-md-6">
                                <input id="promedio" type="text" class="form-control @error('promedio') is-invalid @enderror" name="promedio" value="{{isset($usuario->promedio)?$usuario->promedio:old('promedio')}}" required autocomplete="promedio" disabled readonly>
                            </div>
                        </div>   

                        <div class="row mb-3">
                            <label for="activo" class="col-md-4 col-form-label text-md-end">{{ __('Estatus') }}</label>

                            <div class="col-md-6">
                                <input id="activo" type="text" class="form-control @error('activo') is-invalid @enderror" name="activo" value="{{isset($usuario->activo)?$usuario->activo:old('activo')}}" required autocomplete="status" disabled readonly>
                            </div>
                        </div>                        

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal" data-bs-whatever="@getbootstrap">Editar</button>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#passwordModal" data-bs-whatever="@getbootstrap">Cambiar contraseña</button>

                            </div>
                        </div>

                        <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passworModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="passwordModalLabel">Cambiar contraseña</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Contraseña actual:</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                  </div>
                                  <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Nueva contraseña:</label>
                                    <input type="password" class="form-control" id="password_nuevo" name="password_nuevo">
                                  </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" onclick="return cancelar()" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button"  class="btn btn-primary" data-bs-dismiss="modal">Confirmar</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Confirmar cambios</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                ¿Desea guardar los cambios?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection