@switch(@config('custom.theme_alert'))

    @case('danger')
    #dd4b39
    @break

    @case('success')
    #00a65a
    @break;

    @case('warning')
    #f39c12
    @break;

    @case('primary')
    #3c8dbc
    @break;

    @case('default')
    #333
    @break;

    @case('purple')
    #605ca8
    @break;

@endswitch
