<div class="form-group {{ $errors->has('classe_id') ? 'has-error' : '' }}">
    <label for="classe_id" class="col-md-2 control-label">{{ trans('distribution_classes.classe_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="classe_id" name="classe_id">
            <option value="" style="display: none;"
                {{ old('classe_id', optional($distributionClass)->classe_id ?: '') == '' ? 'selected' : '' }} disabled
                selected>{{ trans('distribution_classes.classe_id__placeholder') }}</option>
            @foreach ($classes as $key => $classe)
                <option value="{{ $key }}"
                    {{ old('classe_id', optional($distributionClass)->classe_id) == $key ? 'selected' : '' }}>
                    {{ $classe }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('classe_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<input type="hidden" name="distribution_id" value="{{ $distribution->id }}">

{{-- <div class="form-group {{ $errors->has('distribution_id') ? 'has-error' : '' }}">
    <label for="distribution_id"
        class="col-md-2 control-label">{{ trans('distribution_classes.distribution_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="distribution_id" name="distribution_id">
            <option value="" style="display: none;"
                {{ old('distribution_id', optional($distributionClass)->distribution_id ?: '') == '' ? 'selected' : '' }}
                disabled selected>{{ trans('distribution_classes.distribution_id__placeholder') }}</option>
            @foreach ($distributions as $key => $distribution)
                <option value="{{ $key }}"
                    {{ old('distribution_id', optional($distributionClass)->distribution_id) == $key ? 'selected' : '' }}>
                    {{ $distribution }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('distribution_id', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}
