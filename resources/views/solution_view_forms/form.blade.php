
<div class="form-group {{ $errors->has('solution_instance') ? 'has-error' : '' }}">
    <label for="solution_instance" class="col-md-2 control-label">{{ trans('solution_view_forms.solution_instance') }}</label>
    <div class="col-md-10">
        <div class="input-group uploaded-file-group">
            <label class="input-group-btn">
                <span class="btn btn-default">
                    Browse <input type="file" name="solution_instance" id="solution_instance" class="hidden">
                </span>
            </label>
            <input type="text" class="form-control uploaded-file-name" readonly>
        </div>

        @if (isset($solutionViewForm->solution_instance) && !empty($solutionViewForm->solution_instance))
            <div class="input-group input-width-input">
                <span class="input-group-addon">
                    <input type="checkbox" name="custom_delete_solution_instance" class="custom-delete-file" value="1" {{ old('custom_delete_solution_instance', '0') == '1' ? 'checked' : '' }}> Delete
                </span>

                <span class="input-group-addon custom-delete-file-name">
                    {{ $solutionViewForm->solution_instance }}
                </span>
            </div>
        @endif
        {!! $errors->first('solution_instance', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('day_begin') ? 'has-error' : '' }}">
    <label for="day_begin" class="col-md-2 control-label">{{ trans('solution_view_forms.day_begin') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="day_begin" name="day_begin" required="true">
        	    <option value="" style="display: none;" {{ old('day_begin', optional($solutionViewForm)->day_begin ?: '') == '' ? 'selected' : '' }} disabled selected>{{ trans('solution_view_forms.day_begin__placeholder') }}</option>
        	@foreach (['0' => trans('solution_view_forms.day_begin_0'),
'1' => trans('solution_view_forms.day_begin_1'),
'2' => trans('solution_view_forms.day_begin_2'),
'3' => trans('solution_view_forms.day_begin_3'),
'4' => trans('solution_view_forms.day_begin_4'),
'5' => trans('solution_view_forms.day_begin_5'),
'6' => trans('solution_view_forms.day_begin_6'),
'7' => trans('solution_view_forms.day_begin_7'),
'8' => trans('solution_view_forms.day_begin_8'),
'9' => trans('solution_view_forms.day_begin_9'),
'10' => trans('solution_view_forms.day_begin_10'),
'11' => trans('solution_view_forms.day_begin_11'),
'12' => trans('solution_view_forms.day_begin_12'),
'13' => trans('solution_view_forms.day_begin_13'),
'14' => trans('solution_view_forms.day_begin_14'),
'15' => trans('solution_view_forms.day_begin_15'),
'16' => trans('solution_view_forms.day_begin_16'),
'17' => trans('solution_view_forms.day_begin_17'),
'18' => trans('solution_view_forms.day_begin_18'),
'19' => trans('solution_view_forms.day_begin_19'),
'20' => trans('solution_view_forms.day_begin_20'),
'21' => trans('solution_view_forms.day_begin_21'),
'22' => trans('solution_view_forms.day_begin_22'),
'23' => trans('solution_view_forms.day_begin_23')] as $key => $text)
			    <option value="{{ $key }}" {{ old('day_begin', optional($solutionViewForm)->day_begin) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('day_begin', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('time_slot') ? 'has-error' : '' }}">
    <label for="time_slot" class="col-md-2 control-label">{{ trans('solution_view_forms.time_slot') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="time_slot" type="number" id="time_slot" value="{{ old('time_slot', optional($solutionViewForm)->time_slot) }}" min="-2147483648" max="2147483647" required="true" placeholder="{{ trans('solution_view_forms.time_slot__placeholder') }}">
        {!! $errors->first('time_slot', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('day_time_slots') ? 'has-error' : '' }}">
    <label for="day_time_slots" class="col-md-2 control-label">{{ trans('solution_view_forms.day_time_slots') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="day_time_slots" type="number" id="day_time_slots" value="{{ old('day_time_slots', optional($solutionViewForm)->day_time_slots) }}" min="-2147483648" max="2147483647" required="true" placeholder="Combien ?">
        {!! $errors->first('day_time_slots', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('week_days') ? 'has-error' : '' }}">
    <label for="week_days" class="col-md-2 control-label">{{ trans('solution_view_forms.week_days') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="week_days" type="text" id="week_days" value="{{ old('week_days', optional($solutionViewForm)->week_days) }}" minlength="1" required="true" placeholder="Par ordre">
        {!! $errors->first('week_days', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('semester_weeks') ? 'has-error' : '' }}">
    <label for="semester_weeks" class="col-md-2 control-label">{{ trans('solution_view_forms.semester_weeks') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="semester_weeks" type="number" id="semester_weeks" value="{{ old('semester_weeks', optional($solutionViewForm)->semester_weeks) }}" min="-2147483648" max="2147483647" required="true" placeholder="Nombre">
        {!! $errors->first('semester_weeks', '<p class="help-block">:message</p>') !!}
    </div>
</div>

