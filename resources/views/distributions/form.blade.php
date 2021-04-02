<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
    <label for="type" class="col-md-2 control-label">{{ trans('distributions.type') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="type" name="type" required="true">
            <option value="" style="display: none;"
                {{ old('type', optional($distribution)->type ?: '') == '' ? 'selected' : '' }} disabled selected>
                {{ trans('distributions.type__placeholder') }}</option>
            @foreach (['SameStart' => trans('distributions.type_samestart'), 'SameTime' => trans('distributions.type_sametime'), 'SameDays' => trans('distributions.type_samedays'), 'SameWeeks' => trans('distributions.type_sameweeks'), 'SameRoom' => trans('distributions.type_sameroom'), 'Overlap' => trans('distributions.type_overlap'), 'SameAttendees' => trans('distributions.type_sameattendees'), 'Precedence' => trans('distributions.type_precedence'), 'WorkDay' => trans('distributions.type_workday'), 'MinGap' => trans('distributions.type_mingap'), 'MaxDays' => trans('distributions.type_maxdays'), 'MaxDayLoad' => trans('distributions.type_maxdayload'), 'MaxBreaks' => trans('distributions.type_maxbreaks'), 'MaxBlock' => trans('distributions.type_maxblock')] as $key => $text)
                <option value="{{ $key }}"
                    {{ old('type', optional($distribution)->type) == $key ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_required') ? 'has-error' : '' }}">
    <label for="is_required" class="col-md-2 control-label">{{ trans('distributions.is_required') }}</label>
    <div class="col-md-10">
        <div class="radio">
            <label for="is_required_1">
                <input id="is_required_1" class="" name="is_required" type="radio" value="1" required="true"
                    {{ old('is_required', optional($distribution)->is_required) == '1' ? 'checked' : '' }}>
                {{ trans('distributions.is_required_1') }}
            </label>
        </div>
        <div class="radio">
            <label for="is_required_0">
                <input id="is_required_0" class="" name="is_required" type="radio" value="0" required="true"
                    {{ old('is_required', optional($distribution)->is_required) == '0' ? 'checked' : '' }}>
                {{ trans('distributions.is_required_0') }}
            </label>
        </div>

        {!! $errors->first('is_required', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('penalty') ? 'has-error' : '' }}">
    <label for="penalty" class="col-md-2 control-label">{{ trans('distributions.penalty') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="penalty" type="number" id="penalty"
            value="{{ old('penalty', optional($distribution)->penalty) }}" min="-2147483648" max="2147483647"
            placeholder="{{ trans('distributions.penalty__placeholder') }}">
        {!! $errors->first('penalty', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('param1') ? 'has-error' : '' }}">
    <label for="param1" class="col-md-2 control-label">{{ trans('distributions.param1') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="param1" type="number" id="param1"
            value="{{ old('param1', optional($distribution)->param1) }}" min="-2147483648" max="2147483647"
            placeholder="{{ trans('distributions.param1__placeholder') }}">
        {!! $errors->first('param1', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('param2') ? 'has-error' : '' }}">
    <label for="param2" class="col-md-2 control-label">{{ trans('distributions.param2') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="param2" type="number" id="param2"
            value="{{ old('param2', optional($distribution)->param2) }}" min="-2147483648" max="2147483647"
            placeholder="{{ trans('distributions.param2__placeholder') }}">
        {!! $errors->first('param2', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<input type="hidden" name="problem_id" value="{{ $problem->id }}">

{{-- <div class="form-group {{ $errors->has('problem_id') ? 'has-error' : '' }}">
    <label for="problem_id" class="col-md-2 control-label">{{ trans('distributions.problem_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="problem_id" name="problem_id">
            <option value="" style="display: none;"
                {{ old('problem_id', optional($distribution)->problem_id ?: '') == '' ? 'selected' : '' }} disabled
                selected>{{ trans('distributions.problem_id__placeholder') }}</option>
            @foreach ($problems as $key => $problem)
                <option value="{{ $key }}"
                    {{ old('problem_id', optional($distribution)->problem_id) == $key ? 'selected' : '' }}>
                    {{ $problem }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('problem_id', '<p class="help-block">:message</p>') !!}
    </div>
</div> --}}
