
<div class="form-group {{ $errors->has('problem_instance') ? 'has-error' : '' }}">
    <label for="problem_instance" class="col-md-2 control-label">{{ trans('problem_view_forms.problem_instance') }}</label>
    <div class="col-md-10">
        <div class="input-group uploaded-file-group">
            <label class="input-group-btn">
                <span class="btn btn-default">
                    Browse <input type="file" name="problem_instance" id="problem_instance" class="hidden">
                </span>
            </label>
            <input type="text" class="form-control uploaded-file-name" readonly>
        </div>

        @if (isset($problemViewForm->problem_instance) && !empty($problemViewForm->problem_instance))
            <div class="input-group input-width-input">
                <span class="input-group-addon">
                    <input type="checkbox" name="custom_delete_problem_instance" class="custom-delete-file" value="1" {{ old('custom_delete_problem_instance', '0') == '1' ? 'checked' : '' }}> Delete
                </span>

                <span class="input-group-addon custom-delete-file-name">
                    {{ $problemViewForm->problem_instance }}
                </span>
            </div>
        @endif
        {!! $errors->first('problem_instance', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('begin_hour') ? 'has-error' : '' }}">
    <label for="begin_hour" class="col-md-2 control-label">{{ trans('problem_view_forms.begin_hour') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="begin_hour" name="begin_hour" required="true">
        	    <option value="" style="display: none;" {{ old('begin_hour', optional($problemViewForm)->begin_hour ?: '') == '' ? 'selected' : '' }} disabled selected>La journée démarre à quelle heure</option>
        	@foreach (['0' => trans('problem_view_forms.begin_hour_0'),
'1' => trans('problem_view_forms.begin_hour_1'),
'2' => trans('problem_view_forms.begin_hour_2'),
'3' => trans('problem_view_forms.begin_hour_3'),
'4' => trans('problem_view_forms.begin_hour_4'),
'5' => trans('problem_view_forms.begin_hour_5'),
'6' => trans('problem_view_forms.begin_hour_6'),
'7' => trans('problem_view_forms.begin_hour_7'),
'8' => trans('problem_view_forms.begin_hour_8'),
'9' => trans('problem_view_forms.begin_hour_9'),
'10' => trans('problem_view_forms.begin_hour_10'),
'11' => trans('problem_view_forms.begin_hour_11'),
'12' => trans('problem_view_forms.begin_hour_12'),
'13' => trans('problem_view_forms.begin_hour_13'),
'14' => trans('problem_view_forms.begin_hour_14'),
'15' => trans('problem_view_forms.begin_hour_15'),
'16' => trans('problem_view_forms.begin_hour_16'),
'17' => trans('problem_view_forms.begin_hour_17'),
'18' => trans('problem_view_forms.begin_hour_18'),
'19' => trans('problem_view_forms.begin_hour_19'),
'20' => trans('problem_view_forms.begin_hour_20'),
'21' => trans('problem_view_forms.begin_hour_21'),
'22' => trans('problem_view_forms.begin_hour_22'),
'23' => trans('problem_view_forms.begin_hour_23')] as $key => $text)
			    <option value="{{ $key }}" {{ old('begin_hour', optional($problemViewForm)->begin_hour) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('begin_hour', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('days') ? 'has-error' : '' }}">
    <label for="days" class="col-md-2 control-label">{{ trans('problem_view_forms.days') }}</label>
    <div class="col-md-10">
        <input class="form-control" name="days" type="text" id="days" value="{{ old('days', optional($problemViewForm)->days) }}" minlength="1" required="true" placeholder="Par ordre croissant">
        {!! $errors->first('days', '<p class="help-block">:message</p>') !!}
    </div>
</div>

