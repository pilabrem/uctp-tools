<input type="hidden" name="room_id" value="{{ $room->id }}">

<div class="form-group {{ $errors->has('travel_to_id') ? 'has-error' : '' }}">
    <label for="travel_to_id" class="col-md-2 control-label">Travel to</label>
    <div class="col-md-10">
        <select class="form-control" id="travel_to_id" name="travel_to_id">
            <option value="" style="display: none;"
                {{ old('travel_to_id', optional($travel)->travel_to_id ?: '') == '' ? 'selected' : '' }} disabled
                selected>
                {{ trans('travel.travel_to_id__placeholder') }}</option>
            @foreach ($rooms as $key => $_room)
                @if ($room->id != $key)
                    <option value="{{ $key }}"
                        {{ old('travel_to_id', optional($travel)->travel_to_id) == $key ? 'selected' : '' }}>
                        {{ $_room }}
                    </option>
                @endif
            @endforeach
        </select>

        {!! $errors->first('travel_to_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
    <label for="value" class="col-md-2 control-label">{{ trans('travel.value') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="value" type="number" id="value"
            value="{{ old('value', optional($travel)->value) }}" min="-2147483648" max="2147483647"
            placeholder="{{ trans('travel.value__placeholder') }}">
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>
