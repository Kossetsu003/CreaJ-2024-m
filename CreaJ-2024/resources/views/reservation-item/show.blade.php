@extends('layouts.app')

@section('template_title')
    {{ $reservationItem->name ?? __('Show') . " " . __('Reservation Item') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Reservation Item</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('reservation-items.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Fk Reservation:</strong>
                            {{ $reservationItem->FK_reservation }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Fk Product:</strong>
                            {{ $reservationItem->fk_product }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Quantity:</strong>
                            {{ $reservationItem->quantity }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Subtotal:</strong>
                            {{ $reservationItem->subtotal }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
