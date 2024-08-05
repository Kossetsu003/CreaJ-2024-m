@extends('layouts.app')

@section('template_title')
    Vendedor
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Vendedor') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('vendedors.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>Usuario</th>
										<th>Rol</th>
										<th>Contrasena</th>
										<th>Nombre</th>
										<th>Apellidos</th>
										<th>Telefono</th>
										<th>Numero Puesto</th>
										<th>Fk Mercado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendedors as $vendedor)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $vendedor->usuario }}</td>
											<td>{{ $vendedor->ROL }}</td>
											<td>{{ $vendedor->contrasena }}</td>
											<td>{{ $vendedor->nombre }}</td>
											<td>{{ $vendedor->apellidos }}</td>
											<td>{{ $vendedor->telefono }}</td>
											<td>{{ $vendedor->numero_puesto }}</td>
											<td>{{ $vendedor->fk_mercado }}</td>

                                            <td>
                                                <form action="{{ route('vendedors.destroy',$vendedor->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('usuarios.vendedor',$vendedor->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('vendedors.edit',$vendedor->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $vendedors->links() !!}
            </div>
        </div>
    </div>
@endsection
