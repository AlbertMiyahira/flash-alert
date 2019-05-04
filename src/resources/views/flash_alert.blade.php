{{-- flash message --}}
@php
    $flashType = isset(${config('flash_alert.TYPE_KEY')}) ? ${config('flash_alert.TYPE_KEY')} : session(config('flash_alert.TYPE_KEY'));
    $flashMsg = isset(${config('flash_alert.MSG_KEY')}) ? ${config('flash_alert.MSG_KEY')} : session(config('flash_alert.MSG_KEY'));
    $flashTitle = isset(${config('flash_alert.TITLE_KEY')}) ? ${config('flash_alert.TITLE_KEY')} : session(config('flash_alert.TITLE_KEY'));
    $isMsgEscape = isset(${config('flash_alert.MSG_ESCAPE_KEY')}) ? ${config('flash_alert.MSG_ESCAPE_KEY')} : session(config('flash_alert.MSG_ESCAPE_KEY'));
    $isTitleEscape = isset(${config('flash_alert.TITLE_ESCAPE_KEY')}) ? ${config('flash_alert.TITLE_ESCAPE_KEY')} : session(config('flash_alert.TITLE_ESCAPE_KEY'));
    $alertClass = isset(${config('flash_alert.ALERT_CLASS_KEY')}) ? ${config('flash_alert.ALERT_CLASS_KEY')} : session(config('flash_alert.ALERT_CLASS_KEY'));
    // https://getbootstrap.com/docs/4.1/components/alerts/#examples
    // alert class
    if(!empty($alertClass)){
        switch ($alertClass){
            case('primary') :
                $alertClass='alert-primary';
                break;
            case('secondary') :
                $alertClass='alert-secondary';
                break;
            case('success') :
                $alertClass='alert-success';
                break;
            case('danger') :
                $alertClass='alert-danger';
                break;
            case('warning') :
                $alertClass='alert-warning';
                break;
            case('info') :
                $alertClass='alert-info';
                break;
            case('light') :
                $alertClass='alert-light';
                break;
            case('dark') :
                $alertClass='alert-dark';
                break;
            default:
                break;
        }
    } else {
        $alertClass='alert-'.$flashType;
    }
@endphp
@if(!empty($flashType) && !empty($flashMsg))
    <div class="alert {{$alertClass}}" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @if(!empty($flashTitle))
            @if($isTitleEscape)
                {!!$flashTitle!!}
            @else
                {{$flashTitle}}
            @endif
        @endif
        @if($isMsgEscape)
            {!!$flashMsg!!}
        @else
            {{$flashMsg}}
        @endif
    </div>
@endif
{{-- validation error --}}
@if(isset($errors) && $errors->has(config('flash_alert.MSG_KEY') ) )
    @if(!$errors->isEmpty())
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @if(!empty($flashTitle))
                @if($isTitleEscape)
                    {!!$errors->first(config('flash_alert.TITLE_KEY'))!!}
                @else
                    {{$errors->first(config('flash_alert.TITLE_KEY'))}}
                @endif
            @endif
            @if($isMsgEscape)
                {!!$errors->first(config('flash_alert.MSG_KEY'))!!}
            @else
                {{$errors->first(config('flash_alert.MSG_KEY'))}}
            @endif
        </div>
    @endif
@endif