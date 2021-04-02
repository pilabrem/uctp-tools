<div class="form-group {{ $errors->has('days') ? 'has-error' : '' }}">
    <label for="days" class="col-md-2 control-label">{{ trans('room_unavailables.days') }}</label>
    <div class="col-md-10">
        @for ($i = 1; $i <= $problem->nr_days; $i++)
            <div class="checkbox">
                <label for="days_{{ $i }}">
                    <input id="days_{{ $i }}" class="required" name="days[]" type="checkbox"
                        value="{{ $i }}"
                        {{ in_array('' . $i, old('days', optional($roomUnavailable)->days) ?: []) ? 'checked' : '' }}>
                    {{ trans('room_unavailables.days_' . $i) }}
                </label>
            </div>
        @endfor

        {!! $errors->first('days', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
    <label for="start" class="col-md-2 control-label">{{ trans('room_unavailables.start') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="start" type="number" id="start"
            value="{{ old('start', optional($roomUnavailable)->start) }}" min="-2147483648" max="2147483647"
            required="true" placeholder="Nombre de créneaux horaires">
        {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('length') ? 'has-error' : '' }}">
    <label for="length" class="col-md-2 control-label">{{ trans('room_unavailables.length') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="length" type="number" id="length"
            value="{{ old('length', optional($roomUnavailable)->length) }}" min="-2147483648" max="2147483647"
            required="true" placeholder="Nombre de créneaux horaires">
        {!! $errors->first('length', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('weeks') ? 'has-error' : '' }}">
    <label for="weeks" class="col-md-2 control-label">{{ trans('room_unavailables.weeks') }}</label>
    <div class="col-md-10">
        @for ($i = 1; $i <= $problem->nr_weeks; $i++)
            <div class="checkbox">
                <label for="weeks_{{ $i }}">
                    <input id="weeks_{{ $i }}" class="required" name="weeks[]" type="checkbox"
                        value="{{ $i }}"
                        {{ in_array('' . $i, old('weeks', optional($roomUnavailable)->weeks) ?: []) ? 'checked' : '' }}>
                    {{ $i }}
                </label>
            </div>
        @endfor

        {!! $errors->first('weeks', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<input type="hidden" name="room_id" value="{{ $room->id }}">


{{-- <div class="form-group {{ $errors->has('room_id') ? 'has-error' : '' }}">
    <label for="room_id" class="col-md-2 control-label">{{ trans('room_unavailables.room_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="room_id" name="room_id">
        	    <option value="" style="display: none;" {{ old('room_id', optional($roomUnavailable)->room_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('room_unavailables.room_id__placeholder') }}</option>
        	@foreach ($rooms as $key => $room)
			    <option value="{{ $key }}" {{ old('room_id', optional($roomUnavailable)->room_id) == $key ? 'selected' : '' }}>
			    	{{ $room }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('room_id', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}
