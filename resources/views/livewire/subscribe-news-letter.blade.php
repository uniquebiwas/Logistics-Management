<section class="newsletter">
    <div class="container">
        <div class="newsletter-wrap">
            <div class="newsletter-title">
                <h3>पूरा समाचारको दैनिक विवरण</h3>
            </div>
            <div class="newsletter-form">
                {{ Form::open(['url' => route('subscriberStore'), 'wire:submit.prevent' => 'subscribeMe']) }}
                {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Enter your email address...', 'required' => 'required', 'wire:model' => 'email']) }}

                {{ Form::submit('Subscribe', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
              
                 
            </div>
        </div>
        @if($message)
        <span class="  alert {{ @$message_class }}">{{ $message }}</span>
        @endif 
    </div>
</section>
