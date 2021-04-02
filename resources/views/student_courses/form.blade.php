<input type="hidden" name="student_id" value="{{ $student->id }}">

<div class="form-group {{ $errors->has('course_id') ? 'has-error' : '' }}">
    <label for="course_id" class="col-md-2 control-label">{{ trans('student_courses.course_id') }}</label>
    <div class="col-md-10">
        <select class="form-control" id="course_id" name="course_id">
            <option value="" style="display: none;"
                {{ old('course_id', optional($studentCourse)->course_id ?: '') == '' ? 'selected' : '' }} disabled
                selected>{{ trans('student_courses.course_id__placeholder') }}</option>
            @foreach ($courses as $key => $course)
                <option value="{{ $key }}"
                    {{ old('course_id', optional($studentCourse)->course_id) == $key ? 'selected' : '' }}>
                    {{ $course }}
                </option>
            @endforeach
        </select>

        {!! $errors->first('course_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
