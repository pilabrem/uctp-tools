<div class="form-group {{ $errors->has('id_room') ? 'has-error' : '' }}">
    <label for="id_room" class="col-md-2 control-label">{{ trans('rooms.id_room') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="id_room" type="text" id="id_room"
            value="{{ old('id_room', optional($room)->id_room) }}" minlength="1"
            placeholder="{{ trans('rooms.id_room__placeholder') }}">
        {!! $errors->first('id_room', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('capacity') ? 'has-error' : '' }}">
    <label for="capacity" class="col-md-2 control-label">{{ trans('rooms.capacity') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="capacity" type="number" id="capacity"
            value="{{ old('capacity', optional($room)->capacity) }}" min="-2147483648" max="2147483647"
            placeholder="{{ trans('rooms.capacity__placeholder') }}">
        {!! $errors->first('capacity', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<input type="hidden" name="problem_id" value="{{ $problem->id }}">

{{-- <div class="form-group {{ $errors->has('problem_id') ? 'has-error' : '' }}">
    <label for="problem_id" class="col-md-2 control-label">{{ trans('rooms.problem_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="problem_id" name="problem_id">
        	    <option value="" style="display: none;" {{ old('problem_id', optional($room)->problem_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('rooms.problem_id__placeholder') }}</option>
        	@foreach ($problems as $key => $problem)
			    <option value="{{ $key }}" {{ old('problem_id', optional($room)->problem_id) == $key ? 'selected' : '' }}>
			    	{{ $problem }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('problem_id', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}
