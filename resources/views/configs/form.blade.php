<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('configs.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($config)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="{{ trans('configs.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<input type="hidden" name="course_id" value="{{ $course->id }}">

{{-- <div class="form-group {{ $errors->has('course_id') ? 'has-error' : '' }}">
    <label for="course_id" class="col-md-2 control-label">{{ trans('configs.course_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="course_id" name="course_id">
        	    <option value="" style="display: none;" {{ old('course_id', optional($config)->course_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('configs.course_id__placeholder') }}</option>
        	@foreach ($courses as $key => $course)
			    <option value="{{ $key }}" {{ old('course_id', optional($config)->course_id) == $key ? 'selected' : '' }}>
			    	{{ $course }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('course_id', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}
