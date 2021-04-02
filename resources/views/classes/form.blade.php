<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('classes.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($classe)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="{{ trans('classes.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('limit') ? 'has-error' : '' }}">
    <label for="limit" class="col-md-2 control-label">{{ trans('classes.limit') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="limit" type="number" id="limit"
            value="{{ old('limit', optional($classe)->limit) }}" min="-2147483648" max="2147483647" required="true"
            placeholder="{{ trans('classes.limit__placeholder') }}">
        {!! $errors->first('limit', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<input type="hidden" name="subpart_id" value="{{ $subpart->id }}">

{{-- <div class="form-group {{ $errors->has('subpart_id') ? 'has-error' : '' }}">
    <label for="subpart_id" class="col-md-2 control-label">{{ trans('classes.subpart_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="subpart_id" name="subpart_id">
        	    <option value="" style="display: none;" {{ old('subpart_id', optional($classe)->subpart_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('classes.subpart_id__placeholder') }}</option>
        	@foreach ($subparts as $key => $subpart)
			    <option value="{{ $key }}" {{ old('subpart_id', optional($classe)->subpart_id) == $key ? 'selected' : '' }}>
			    	{{ $subpart }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('subpart_id', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}

<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
    <label for="parent_id" class="col-md-2 control-label">{{ trans('classes.parent_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="parent_id" name="parent_id">
            <option value="" style="display: none;"
                {{ old('parent_id', optional($classe)->parent_id ?: '') == '' ? 'selected' : '' }} disabled selected>
                {{ trans('classes.parent_id__placeholder') }}</option>
            @foreach ($parents as $key => $parent)
                <option value="{{ $key }}"
                    {{ old('parent_id', optional($classe)->parent_id) == $key ? 'selected' : '' }}>
                    {{ $parent }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
