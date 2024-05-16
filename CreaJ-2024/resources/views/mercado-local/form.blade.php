<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $mercadoLocal?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="imagen_referencia" class="form-label">{{ __('Imagen Referencia') }}</label>
            <input type="file" name="imagen_referencia"  accept=".png" class="form-control @error('imagen_referencia') is-invalid @enderror" value="{{ old('imagen_referencia', $mercadoLocal?->imagen_referencia) }}" id="imagen_referencia" placeholder="Imagen Referencia">
            {!! $errors->first('imagen_referencia', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="municipio" class="form-label">{{ __('Municipio') }}</label>
            <input type="text" name="municipio" class="form-control @error('municipio') is-invalid @enderror" value="{{ old('municipio', $mercadoLocal?->municipio) }}" id="municipio" placeholder="Municipio">
            {!! $errors->first('municipio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="ubicacion" class="form-label">{{ __('Ubicacion') }}</label>
            <input type="text" name="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror" value="{{ old('ubicacion', $mercadoLocal?->ubicacion) }}" id="ubicacion" placeholder="Ubicacion">
            {!! $errors->first('ubicacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="horaentrada" class="form-label">{{ __('Horaentrada') }}</label>
            <input type="time" name="horaentrada" class="form-control @error('horaentrada') is-invalid @enderror" value="{{ old('horaentrada', $mercadoLocal?->horaentrada) }}" id="horaentrada" placeholder="Horaentrada">
            {!! $errors->first('horaentrada', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="horasalida" class="form-label">{{ __('Horasalida') }}</label>
            <input type="time" name="horasalida" class="form-control @error('horasalida') is-invalid @enderror" value="{{ old('horasalida', $mercadoLocal?->horasalida) }}" id="horasalida" placeholder="Horasalida">
            {!! $errors->first('horasalida', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $mercadoLocal?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
