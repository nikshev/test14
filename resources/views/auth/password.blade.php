<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2/10/16
 * Time: 3:18 PM
 */
?>
{!! Html::style('assets/css/uikit.min.css') !!}
{!! HTML::script('assets/js/uikit.min.js') !!}
<head>
    <title>{!! \Lang::get('auth.Reset password title') !!}</title>
</head>
<body>
<div style="width: 20%; margin: 200px auto;">
    <form class="uk-form uk-form-horizontal" _lpchecked="1" method="post" action="/password/email">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if (count($errors) > 0)
            <div class="uk-form-row">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="uk-form-row">
            <label class="uk-form-label" for="form-h-it">{!! \Lang::get('auth.Login') !!}</label>
            <div class="uk-form-controls">
                <input type="email" name="email" value="{{ old('email')}}"  id="form-h-it" placeholder="{!! \Lang::get('auth.Login') !!}" style="cursor: auto; background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg=='); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
            </div>
        </div>

        <div class="uk-form-row">
            <button class="uk-button uk-width-1-1">{!! \Lang::get('auth.Reset password') !!}</button>
        </div>
        <div class="uk-form-row">
            <p style="text-align:center;"><a href="/auth/login">{!! \Lang::get('auth.Sign in') !!}</a>&nbsp/&nbsp<a href="/auth/register">{!! \Lang::get('auth.Registration') !!}</a></p>
        </div>

    </form>
</div>
</body>