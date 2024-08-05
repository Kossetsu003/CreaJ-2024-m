<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="f_k_reservation" class="form-label">{{ __('Fk Reservation') }}</label>
            <input type="text" name="FK_reservation" class="form-control @error('FK_reservation') is-invalid @enderror" value="{{ old('FK_reservation', $reservationItem?->FK_reservation) }}" id="f_k_reservation" placeholder="Fk Reservation">
            {!! $errors->first('FK_reservation', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="f_k_product" class="form-label">{{ __('Fk Product') }}</label>
            <input type="text" name="FK_product" class="form-control @error('FK_product') is-invalid @enderror" value="{{ old('FK_product', $reservationItem?->FK_product) }}" id="f_k_product" placeholder="Fk Product">
            {!! $errors->first('FK_product', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="quantity" class="form-label">{{ __('Quantity') }}</label>
            <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', $reservationItem?->quantity) }}" id="quantity" placeholder="Quantity">
            {!! $errors->first('quantity', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="subtotal" class="form-label">{{ __('Subtotal') }}</label>
            <input type="text" name="subtotal" class="form-control @error('subtotal') is-invalid @enderror" value="{{ old('subtotal', $reservationItem?->subtotal) }}" id="subtotal" placeholder="Subtotal">
            {!! $errors->first('subtotal', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>