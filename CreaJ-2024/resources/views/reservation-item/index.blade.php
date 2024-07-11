@extends('layouts.app')

@section('template_title')
    Reservation Item
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Reservation Item') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('reservation-items.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Fk Reservation</th>
										<th>Fk Product</th>
										<th>Quantity</th>
										<th>Subtotal</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservationItems as $reservationItem)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $reservationItem->FK_reservation }}</td>
											<td>{{ $reservationItem->FK_product }}</td>
											<td>{{ $reservationItem->quantity }}</td>
											<td>{{ $reservationItem->subtotal }}</td>

                                            <td>
                                                <form action="{{ route('reservation-items.destroy',$reservationItem->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('reservation-items.show',$reservationItem->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('reservation-items.edit',$reservationItem->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $reservationItems->links() !!}
            </div>
        </div>
    </div>
@endsection
