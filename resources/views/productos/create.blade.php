@extends('layouts.app')
@section('title', 'Nuevo producto')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header py-3">
                <p class="text-uppercase small fw-bold text-secondary mb-1" style="letter-spacing: .12em;">Alta</p>
                <h1 class="titulo mb-0" style="font-size: 1.7rem;">Nuevo <span class="resalte">producto</span></h1>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('productos.store') }}" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre"
                               value="{{ old('nombre') }}"
                               placeholder="Ej. Teclado mecánico"
                               class="form-control @error('nombre') is-invalid @enderror">
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <input type="text" id="categoria" name="categoria"
                               value="{{ old('categoria') }}"
                               placeholder="Ej. Tecnología"
                               class="form-control @error('categoria') is-invalid @enderror">
                        @error('categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="precio" class="form-label">Precio</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" id="precio" name="precio"
                                   value="{{ old('precio') }}"
                                   placeholder="0.00"
                                   class="form-control @error('precio') is-invalid @enderror">
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-success"><i class="bi bi-save"></i> Guardar</button>
                        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
