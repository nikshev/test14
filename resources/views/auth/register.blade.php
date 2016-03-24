<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2/11/16
 * Time: 1:13 PM
 */
?>
{!! Html::style('assets/css/uikit.min.css') !!}
{!! HTML::script('assets/js/uikit.min.js') !!}
<head>
    <title>{!! \Lang::get('auth.Registration title') !!}</title>
</head>
<body>
<div style="width: 20%; margin: 200px auto;">
    <form method="POST" action="/auth/register" class="uk-form uk-form-horizontal" _lpchecked="1">
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
            <label class="uk-form-label" for="form-h-it">{!! \Lang::get('auth.Name') !!}</label>
            <div class="uk-form-controls">
                <input name="name" type="text" id="form-h-it" placeholder="{!! \Lang::get('auth.Name') !!}">
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label" for="form-h-it">{!! \Lang::get('auth.Login') !!}</label>
            <div class="uk-form-controls">
                <input name="email" type="email" id="form-h-it" placeholder="{!! \Lang::get('auth.Login') !!}">
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label" for="form-h-ip">{!! \Lang::get('auth.Password') !!}</label>
            <div class="uk-form-controls">
                <input type="password" name="password" id="form-h-ip" placeholder="{!! \Lang::get('auth.Password') !!}">
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label" for="form-h-irp">{!! \Lang::get('auth.Password again') !!}</label>
            <div class="uk-form-controls">
                <input type="password" name="password_confirmation" id="form-h-irp" placeholder="{!! \Lang::get('auth.Password again') !!}">
            </div>
        </div>

        <div class="uk-form-row">
            <button class="uk-button uk-width-1-1">{!! \Lang::get('auth.Registration') !!}</button>
        </div>

        <div class="uk-form-row">
            <p style="text-align:center;"><a href="/auth/login">{!! \Lang::get('auth.Sign in') !!}</a>&nbsp/&nbsp<a href="/password/email">{!! \Lang::get('auth.Forgot password') !!}</a></p>
        </div>

    </form>
</div>
</body>
