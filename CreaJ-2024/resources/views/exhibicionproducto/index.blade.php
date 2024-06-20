@extends('layouts.app')

@section('template_title')
    Exhibicionproducto
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Exhibicionproducto') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('exhibicionproductos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Imagen</th>
										<th>Nombre</th>
										<th>Descripcion</th>
										<th>Precio</th>
										<th>Fk Vendedors</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exhibicionproductos as $exhibicionproducto)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $exhibicionproducto->Imagen }}</td>
											<td>{{ $exhibicionproducto->Nombre }}</td>
											<td>{{ $exhibicionproducto->Descripcion }}</td>
											<td>{{ $exhibicionproducto->Precio }}</td>
											<td>{{ $exhibicionproducto->fk_vendedors }}</td>
											<td>{{ $exhibicionproducto->Estado }}</td>

                                            <td>
                                                <form action="{{ route('exhibicionproductos.destroy',$exhibicionproducto->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('exhibicionproductos.show',$exhibicionproducto->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('exhibicionproductos.edit',$exhibicionproducto->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $exhibicionproductos->links() !!}
            </div>
        </div>
    </div>
@endsection
