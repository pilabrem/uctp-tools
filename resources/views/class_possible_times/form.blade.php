<input type="hidden" name="classe_id" value="{{ $classe->id }}">


<div class="form-group {{ $errors->has('days') ? 'has-error' : '' }}">
    <label for="days" class="col-md-2 control-label">{{ trans('class_possible_times.days') }}</label>
    <div class="col-md-10">
        @for ($i = 1; $i <= $problem->nr_days; $i++)
            <div class="checkbox">
                <label for="days_{{ $i }}">
                    <input id="days_{{ $i }}" class="required" name="days[]" type="checkbox"
                        value="{{ $i }}"
                        {{ in_array('' . $i, old('days', optional($classPossibleTime)->days) ?: []) ? 'checked' : '' }}>
                    {{ trans('class_possible_times.days_' . $i) }}
                </label>
            </div>
        @endfor


        {!! $errors->first('days', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
    <label for="start" class="col-md-2 control-label">{{ trans('class_possible_times.start') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="start" type="number" id="start"
            value="{{ old('start', optional($classPossibleTime)->start) }}" min="-2147483648" max="2147483647"
            required="true" placeholder="{{ trans('class_possible_times.start__placeholder') }}">
        {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('length') ? 'has-error' : '' }}">
    <label for="length" class="col-md-2 control-label">{{ trans('class_possible_times.length') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="length" type="number" id="length"
            value="{{ old('length', optional($classPossibleTime)->length) }}" min="-2147483648" max="2147483647"
            required="true" placeholder="{{ trans('class_possible_times.length__placeholder') }}">
        {!! $errors->first('length', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('weeks') ? 'has-error' : '' }}">
    <label for="weeks" class="col-md-2 control-label">{{ trans('class_possible_times.weeks') }}</label>
    <div class="col-md-10">
        @for ($i = 1; $i <= $problem->nr_weeks; $i++)
            <div class="checkbox">
                <label for="weeks_{{ $i }}">
                    <input id="weeks_{{ $i }}" class="required" name="weeks[]" type="checkbox"
                        value="{{ $i }}"
                        {{ in_array('' . $i, old('weeks', optional($classPossibleTime)->weeks) ?: []) ? 'checked' : '' }}>
                    {{ trans('class_possible_times.weeks_' . $i) }}
                </label>
            </div>
        @endfor


        {!! $errors->first('weeks', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('penalty') ? 'has-error' : '' }}">
    <label for="penalty" class="col-md-2 control-label">{{ trans('class_possible_times.penalty') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="penalty" type="number" id="penalty"
            value="{{ old('penalty', optional($classPossibleTime)->penalty) }}" min="-2147483648" max="2147483647"
            required="true" placeholder="{{ trans('class_possible_times.penalty__placeholder') }}">
        {!! $errors->first('penalty', '<p class="help-block">:message</p>') !!}
    </div>
</div>
