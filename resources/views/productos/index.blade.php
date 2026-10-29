@extends('layouts.app')
@section('title', 'Listado')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
    <div>
        <p class="text-uppercase small fw-bold text-secondary mb-1" style="letter-spacing: .12em;">Inventario</p>
        <h1 class="titulo mb-0">Listado de <span class="resalte">productos</span></h1>
    </div>
    <a href="{{ route('productos.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Nuevo producto
    </a>
</div>

{{-- Formulario GET: los datos viajan en la URL --}}
<form method="GET" action="{{ route('productos.index') }}" class="row g-2 mb-4">
    <div class="col-12 col-md-5">
        <input type="text" name="buscar" value="{{ $buscar }}"
               class="form-control" placeholder="Buscar por nombre...">
    </div>
    <div class="col-8 col-md-4">
        <select name="categoria" class="form-select">
            <option value="">Todas las categorías</option>
            @foreach ($categorias as $cat)
                <option value="{{ $cat }}" @selected($cat === $categoria)>{{ $cat }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-4 col-md-3 d-grid d-md-flex gap-2">
        <button class="btn btn-primary"><i class="bi bi-search"></i> Filtrar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">Limpiar</a>
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th class="text-end">Precio</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $p)
                    <tr>
                        <td class="codigo">{{ str_pad($p['id'], 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="fw-semibold">{{ $p['nombre'] }}</td>
                        <td><span class="etiqueta">{{ $p['categoria'] }}</span></td>
                        <td class="text-end precio">${{ number_format($p['precio'], 2) }}</td>
                        <td class="text-end">
                            <a href="{{ route('productos.edit', $p['id']) }}"
                               class="btn btn-sm btn-outline-primary" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>

                            {{-- Ejercicio 4: botón que abre el modal de confirmación --}}
                            <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar"
                                    data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                    data-id="{{ $p['id'] }}" data-nombre="{{ $p['nombre'] }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-3 d-block mb-1"></i> Sin resultados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<p class="pie mt-3 mb-0">{{ $productos->count() }} resultado(s)</p>

{{-- EJERCICIO 4: modal de confirmación con @method('DELETE') --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="formEliminar" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                ¿Seguro que deseas eliminar <strong id="nombreEliminar"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('modalEliminar').addEventListener('show.bs.modal', (e) => {
        const btn = e.relatedTarget;
        document.getElementById('nombreEliminar').textContent = btn.dataset.nombre;
        document.getElementById('formEliminar').action = `{{ url('productos') }}/${btn.dataset.id}`;
    });
</script>
@endsection
