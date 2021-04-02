<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('courses.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($course)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="{{ trans('courses.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<input type="hidden" name="problem_id" value="{{ $problem->id }}">

{{-- <div class="form-group {{ $errors->has('problem_id') ? 'has-error' : '' }}">
    <label for="problem_id" class="col-md-2 control-label">{{ trans('courses.problem_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="problem_id" name="problem_id">
        	    <option value="" style="display: none;" {{ old('problem_id', optional($course)->problem_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('courses.problem_id__placeholder') }}</option>
        	@foreach ($problems as $key => $problem)
			    <option value="{{ $key }}" {{ old('problem_id', optional($course)->problem_id) == $key ? 'selected' : '' }}>
			    	{{ $problem }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('problem_id', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}
