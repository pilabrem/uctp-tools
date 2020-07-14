
<div class="form-group {{ $errors->has('fichier') ? 'has-error' : '' }}">
    <label for="fichier" class="col-md-2 control-label">Fichier</label>
    <div class="col-md-10">
        <div class="input-group uploaded-file-group">
            <label class="input-group-btn">
                <span class="btn btn-default">
                    Browse <input type="file" name="fichier" id="fichier" class="hidden">
                </span>
            </label>
            <input type="text" class="form-control uploaded-file-name" readonly>
        </div>

        @if (isset($importShemaFromXML->fichier) && !empty($importShemaFromXML->fichier))
            <div class="input-group input-width-input">
                <span class="input-group-addon">
                    <input type="checkbox" name="custom_delete_fichier" class="custom-delete-file" value="1" {{ old('custom_delete_fichier', '0') == '1' ? 'checked' : '' }}> Delete
                </span>

                <span class="input-group-addon custom-delete-file-name">
                    {{ $importShemaFromXML->fichier }}
                </span>
            </div>
        @endif
        {!! $errors->first('fichier', '<p class="help-block">:message</p>') !!}
    </div>
</div>

