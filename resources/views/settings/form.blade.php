
<div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
    <label for="key" class="col-md-2 control-label">Paramètre</label>
    <div class="col-md-10">
        <input class="form-control" name="key" type="text" id="key" value="{{ old('key', optional($setting)->key) }}" minlength="1" required="true" placeholder="Entrer key ici...">
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
    <label for="value" class="col-md-2 control-label">Valeur</label>
    <div class="col-md-10">
        <textarea class="form-control" name="value" cols="50" rows="10" id="value" required="true">{{ old('value', optional($setting)->value) }}</textarea>
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>

