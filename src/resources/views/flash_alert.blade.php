{{-- flash message --}}
@php
    $flashType = isset(${config('flash_alert.TYPE_KEY')}) ? ${config('flash_alert.TYPE_KEY')} :session(config('flash_alert.TYPE_KEY'));
    $flashMsg = isset(${config('flash_alert.MSG_KEY')}) ? ${config('flash_alert.MSG_KEY')} :session(config('flash_alert.MSG_KEY'));
    $isMsgEscape = isset(${config('flash_alert.MSG_ESCAPE_KEY')}) ? ${config('flash_alert.MSG_ESCAPE_KEY')} :session(config('flash_alert.MSG_ESCAPE_KEY'));
@endphp
@if($flashType)
    @switch($flashType)
        @case('success')
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @if($isMsgEscape)
                {!!$flashMsg!!}
            @else
                {{$flashMsg}}
            @endif
        </div>
        @break

        @case('info')
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @if($isMsgEscape)
                {!!$flashMsg!!}
            @else
                {{$flashMsg}}
            @endif
        </div>
        @break

        @case('warning')
        <div class="alert alert-warning" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @if($isMsgEscape)
                {!!$flashMsg!!}
            @else
                {{$flashMsg}}
            @endif
        </div>
        @break

        @case('error')
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @if($isMsgEscape)
                {!!$flashMsg!!}
            @else
                {{$flashMsg}}
            @endif
        </div>
        @break
        
    @endswitch
@endif
{{-- validation error --}}
@if(isset($errors) && $errors->has(config('flash_alert.MSG_KEY')))
    @if(!$errors->isEmpty())
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @if($isMsgEscape)
                {!!$errors->first(config('flash_alert.MSG_KEY'))!!}
            @else
                {{$errors->first(config('flash_alert.MSG_KEY'))}}
            @endif
        </div>
    @endif
@endif