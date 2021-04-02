<div class="form-group {{ $errors->has('room_id') ? 'has-error' : '' }}">
    <label for="room_id" class="col-md-2 control-label">{{ trans('class_possible_rooms.room_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="room_id" name="room_id">
            <option value="" style="display: none;"
                {{ old('room_id', optional($classPossibleRoom)->room_id ?: '') == '' ? 'selected' : '' }} disabled
                selected>{{ trans('class_possible_rooms.room_id__placeholder') }}</option>
            @foreach ($rooms as $key => $room)
                <option value="{{ $key }}"
                    {{ old('room_id', optional($classPossibleRoom)->room_id) == $key ? 'selected' : '' }}>
                    {{ $room }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('room_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('penalty') ? 'has-error' : '' }}">
    <label for="penalty" class="col-md-2 control-label">{{ trans('class_possible_rooms.penalty') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="penalty" type="number" id="penalty"
            value="{{ old('penalty', optional($classPossibleRoom)->penalty) }}" min="-2147483648" max="2147483647"
            required="true" placeholder="{{ trans('class_possible_rooms.penalty__placeholder') }}">
        {!! $errors->first('penalty', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<input type="hidden" name="classe_id" value="{{ $classe->id }}">

{{-- <div class="form-group {{ $errors->has('classe_id') ? 'has-error' : '' }}">
    <label for="classe_id" class="col-md-2 control-label">{{ trans('class_possible_rooms.classe_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="classe_id" name="classe_id">
        	    <option value="" style="display: none;" {{ old('classe_id', optional($classPossibleRoom)->classe_id ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('class_possible_rooms.classe_id__placeholder') }}</option>
        	@foreach ($classes as $key => $classe)
			    <option value="{{ $key }}" {{ old('classe_id', optional($classPossibleRoom)->classe_id) == $key ? 'selected' : '' }}>
			    	{{ $classe }}
			    </option>
			@endforeach
        </select>

        {!! $errors->first('classe_id', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}
