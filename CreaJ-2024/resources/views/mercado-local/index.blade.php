@extends('layouts.app')

@section('template_title')
    Mercado Local
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Mercado Local') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('mercado-locals.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Nombre</th>
										<th>Imagen Referencia</th>
										<th>Municipio</th>
										<th>Ubicacion</th>
										<th>Horaentrada</th>
										<th>Horasalida</th>
										<th>Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mercadoLocals as $mercadoLocal)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $mercadoLocal->nombre }}</td>
											<td>{{ $mercadoLocal->imagen_referencia }}</td>
											<td>{{ $mercadoLocal->municipio }}</td>
											<td>{{ $mercadoLocal->ubicacion }}</td>
											<td>{{ $mercadoLocal->horaentrada }}</td>
											<td>{{ $mercadoLocal->horasalida }}</td>
											<td>{{ $mercadoLocal->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('mercado-locals.destroy',$mercadoLocal->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('mercado-locals.show',$mercadoLocal->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('mercado-locals.edit',$mercadoLocal->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $mercadoLocals->links() !!}
            </div>
        </div>
    </div>
@endsection
