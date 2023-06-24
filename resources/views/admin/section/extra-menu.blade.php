<div class="b-notification">
    <div class="b-noti-wrap">
        <span>{{ @\Auth::user()->name['en'] }} ({{ request()->user()->roles->first()->name }})</span>
    </div>
    <div class="b-noti-wrap next">
        @hasanyrole('Agent|Staff')
        <span>Click <a href="{{$sitesetting->term_con_link}}">here</a> to see our Terms and Conditions of Carriage</span>
        @endhasallroles

        <p>Click <a href="{{route('index')}}">here</a> to return to home page</p>
    </div>

</div>
