<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="imagen" class="form-label">{{ __('Imagen') }}</label>
            <input type="text" name="Imagen" class="form-control @error('Imagen') is-invalid @enderror" value="{{ old('Imagen', $exhibicionproducto?->Imagen) }}" id="imagen" placeholder="Imagen">
            {!! $errors->first('Imagen', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="Nombre" class="form-control @error('Nombre') is-invalid @enderror" value="{{ old('Nombre', $exhibicionproducto?->Nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('Nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="Descripcion" class="form-control @error('Descripcion') is-invalid @enderror" value="{{ old('Descripcion', $exhibicionproducto?->Descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('Descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="precio" class="form-label">{{ __('Precio') }}</label>
            <input type="text" name="Precio" class="form-control @error('Precio') is-invalid @enderror" value="{{ old('Precio', $exhibicionproducto?->Precio) }}" id="precio" placeholder="Precio">
            {!! $errors->first('Precio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fk_vendedors" class="form-label">{{ __('Fk Vendedors') }}</label>
            <input type="text" name="fk_vendedors" class="form-control @error('fk_vendedors') is-invalid @enderror" value="{{ old('fk_vendedors', $exhibicionproducto?->fk_vendedors) }}" id="fk_vendedors" placeholder="Fk Vendedors">
            {!! $errors->first('fk_vendedors', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="Estado" class="form-control @error('Estado') is-invalid @enderror" value="{{ old('Estado', $exhibicionproducto?->Estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('Estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>