<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('subparts.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($subpart)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="{{ trans('subparts.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<input type="hidden" name="config_id" value="{{ $config->id }}">

{{-- <div class="form-group {{ $errors->has('config_id') ? 'has-error' : '' }}">
    <label for="config_id" class="col-md-2 control-label">{{ trans('subparts.config_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="config_id" name="config_id">
        	    <option value="" style="display: none;" {{ old('config_id', optional($subpart)->config_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('subparts.config_id__placeholder') }}</option>
        	@foreach ($configs as $key => $config)
			    <option value="{{ $key }}" {{ old('config_id', optional($subpart)->config_id) == $key ? 'selected' : '' }}>
			    	{{ $config }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('config_id', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}
