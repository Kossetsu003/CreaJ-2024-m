<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="f_k_user" class="form-label">{{ __('Fk User') }}</label>
            <input type="text" name="fk_user" class="form-control @error('FK_user') is-invalid @enderror" value="{{ old('fk_user', $reservation?->fk_user) }}" id="f_k_user" placeholder="Fk User">
            {!! $errors->first('fk_user', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>