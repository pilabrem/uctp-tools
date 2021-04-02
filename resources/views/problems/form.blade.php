<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">{{ trans('problems.name') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name"
            value="{{ old('name', optional($problem)->name) }}" minlength="1" maxlength="255" required="true"
            placeholder="{{ trans('problems.name__placeholder') }}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('nr_days') ? 'has-error' : '' }}">
    <label for="nr_days" class="col-md-2 control-label">{{ trans('problems.nr_days') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="nr_days" type="number" id="nr_days"
            value="{{ old('nr_days', optional($problem)->nr_days) }}" min="-2147483648" max="2147483647"
            required="true" placeholder="{{ trans('problems.nr_days__placeholder') }}">
        {!! $errors->first('nr_days', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('nr_weeks') ? 'has-error' : '' }}">
    <label for="nr_weeks" class="col-md-2 control-label">{{ trans('problems.nr_weeks') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="nr_weeks" type="number" id="nr_weeks"
            value="{{ old('nr_weeks', optional($problem)->nr_weeks) }}" min="-2147483648" max="2147483647"
            required="true" placeholder="{{ trans('problems.nr_weeks__placeholder') }}">
        {!! $errors->first('nr_weeks', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('slots_per_day') ? 'has-error' : '' }}">
    <label for="slots_per_day" class="col-md-2 control-label">{{ trans('problems.slots_per_day') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="slots_per_day" type="number" id="slots_per_day"
            value="{{ old('slots_per_day', optional($problem)->slots_per_day) }}" min="-2147483648" max="2147483647"
            required="true" placeholder="{{ trans('problems.slots_per_day__placeholder') }}">
        {!! $errors->first('slots_per_day', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('begin_hour') ? 'has-error' : '' }}">
    <label for="begin_hour" class="col-md-2 control-label">{{ trans('problems.begin_hour') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="begin_hour" type="number" id="begin_hour"
            value="{{ old('begin_hour', optional($problem)->begin_hour) }}" min="-2147483648" max="2147483647"
            required="true" placeholder="{{ trans('problems.begin_hour__placeholder') }}">
        {!! $errors->first('begin_hour', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('week_days') ? 'has-error' : '' }}">
    <label for="week_days" class="col-md-2 control-label">{{ trans('problems.week_days') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="week_days" type="text" id="week_days"
            value="{{ old('week_days', optional($problem)->week_days) }}" minlength="1" required="true"
            placeholder="{{ trans('problems.week_days__placeholder') }}">
        {!! $errors->first('week_days', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('minutes_per_slot') ? 'has-error' : '' }}">
    <label for="minutes_per_slot" class="col-md-2 control-label">{{ trans('problems.minutes_per_slot') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="minutes_per_slot" type="number" id="minutes_per_slot"
            value="{{ old('minutes_per_slot', optional($problem)->minutes_per_slot) }}" min="-2147483648"
            max="2147483647" required="true" placeholder="{{ trans('problems.minutes_per_slot__placeholder') }}">
        {!! $errors->first('minutes_per_slot', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('time_optimization') ? 'has-error' : '' }}">
    <label for="time_optimization" class="col-md-2 control-label">{{ trans('problems.time_optimization') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="time_optimization" type="number" id="time_optimization"
            value="{{ old('time_optimization', optional($problem)->time_optimization) }}" min="-2147483648"
            max="2147483647" required="true" placeholder="{{ trans('problems.time_optimization__placeholder') }}">
        {!! $errors->first('time_optimization', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('room_optimization') ? 'has-error' : '' }}">
    <label for="room_optimization" class="col-md-2 control-label">{{ trans('problems.room_optimization') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="room_optimization" type="number" id="room_optimization"
            value="{{ old('room_optimization', optional($problem)->room_optimization) }}" min="-2147483648"
            max="2147483647" required="true" placeholder="{{ trans('problems.room_optimization__placeholder') }}">
        {!! $errors->first('room_optimization', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('distribution_optimization') ? 'has-error' : '' }}">
    <label for="distribution_optimization"
        class="col-md-2 control-label">{{ trans('problems.distribution_optimization') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="distribution_optimization" type="number" id="distribution_optimization"
            value="{{ old('distribution_optimization', optional($problem)->distribution_optimization) }}"
            min="-2147483648" max="2147483647" required="true"
            placeholder="{{ trans('problems.distribution_optimization__placeholder') }}">
        {!! $errors->first('distribution_optimization', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('student_optimisation') ? 'has-error' : '' }}">
    <label for="student_optimisation"
        class="col-md-2 control-label">{{ trans('problems.student_optimisation') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="student_optimisation" type="number" id="student_optimisation"
            value="{{ old('student_optimisation', optional($problem)->student_optimisation) }}" min="-2147483648"
            max="2147483647" required="true" placeholder="{{ trans('problems.student_optimisation__placeholder') }}">
        {!! $errors->first('student_optimisation', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group {{ $errors->has('is_random') ? 'has-error' : '' }}">
    <label for="is_random" class="col-md-2 control-label">Problème aléatoire</label>
    <div class="col-md-10">
        <div class="radio">
            <label for="is_random_1">
                <input id="is_random_1" class="" name="is_random" type="radio" value="1" required="true"
                    {{ old('is_random', optional($problem)->is_random) == 1 ? 'checked' : '' }}>
                Oui
            </label>
        </div>
        <div class="radio">
            <label for="is_random_0">
                <input id="is_random_0" class="" name="is_random" type="radio" value="0" required="true"
                    {{ old('is_random', optional($problem)->is_random) == 0 ? 'checked' : '' }}>
                Non
            </label>
        </div>

        {!! $errors->first('is_random', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('problem_class') ? 'has-error' : '' }}">
    <label for="problem_class" class="col-md-2 control-label">Problem class</label>
    <div class="col-md-10">
        <select class="form-control" id="problem_class" name="problem_class">
            <option value="" style="display: none;"
                {{ old('problem_class', optional($problem)->problem_class ?: '') == '' ? 'selected' : '' }} disabled
                selected>Selectioner</option>
            <option value="small"
                {{ old('problem_class', optional($problem)->problem_class) == 'small' ? 'selected' : '' }}>
                Petit
            </option>
            <option value="medium"
                {{ old('problem_class', optional($problem)->problem_class) == 'medium' ? 'selected' : '' }}>
                Moyen
            </option>
            <option value="large"
                {{ old('problem_class', optional($problem)->problem_class) == 'large' ? 'selected' : '' }}>
                Large
            </option>
        </select>

        {!! $errors->first('problem_class', '<p class="help-block">:message</p>') !!}
    </div>
</div>
