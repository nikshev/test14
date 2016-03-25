<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 2/10/16
 * Time: 3:18 PM
 */
$dashboard_js_version=uniqid();
?>
{!! Html::script('assets/js/jquery-1.12.0.min.js') !!}
{!! Html::style('assets/css/uikit.min.css') !!}
{!! HTML::script('assets/js/uikit.min.js') !!}
{!! Html::script('assets/js/jquery-ui.js') !!}
{!! Html::script('assets/js/dashboard.js?v='.$dashboard_js_version) !!}
<head>
    <title>{!! \Lang::get('auth.Login title') !!}</title>
</head>
<body>
  <div style="width: 20%; margin: 200px auto;">
    <form class="uk-form uk-form-horizontal" _lpchecked="1" method="post" action="/auth/login">
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
            <label class="uk-form-label" for="name">{!! \Lang::get('auth.Name') !!}</label>
            <div class="uk-form-controls">
                <input type="text" id="q">
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label" for="email">{!! \Lang::get('auth.Login') !!}</label>
            <div class="uk-form-controls">
                <input type="email" name="email" value="{{ old('email')}}"  id="email" placeholder="{!! \Lang::get('auth.Login') !!}" style="cursor: auto; background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg=='); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
            </div>
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label" for="form-h-ip">{!! \Lang::get('auth.Password') !!}</label>
            <div class="uk-form-controls">
                <input type="password" name="password" id="form-h-ip" placeholder="{!! \Lang::get('auth.Password') !!}" style="cursor: auto; background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACIUlEQVQ4EX2TOYhTURSG87IMihDsjGghBhFBmHFDHLWwSqcikk4RRKJgk0KL7C8bMpWpZtIqNkEUl1ZCgs0wOo0SxiLMDApWlgOPrH7/5b2QkYwX7jvn/uc//zl3edZ4PPbNGvF4fC4ajR5VrNvt/mo0Gr1ZPOtfgWw2e9Lv9+chX7cs64CS4Oxg3o9GI7tUKv0Q5o1dAiTfCgQCLwnOkfQOu+oSLyJ2A783HA7vIPLGxX0TgVwud4HKn0nc7Pf7N6vV6oZHkkX8FPG3uMfgXC0Wi2vCg/poUKGGcagQI3k7k8mcp5slcGswGDwpl8tfwGJg3xB6Dvey8vz6oH4C3iXcFYjbwiDeo1KafafkC3NjK7iL5ESFGQEUF7Sg+ifZdDp9GnMF/KGmfBdT2HCwZ7TwtrBPC7rQaav6Iv48rqZwg+F+p8hOMBj0IbxfMdMBrW5pAVGV/ztINByENkU0t5BIJEKRSOQ3Aj+Z57iFs1R5NK3EQS6HQqF1zmQdzpFWq3W42WwOTAf1er1PF2USFlC+qxMvFAr3HcexWX+QX6lUvsKpkTyPSEXJkw6MQ4S38Ljdbi8rmM/nY+CvgNcQqdH6U/xrYK9t244jZv6ByUOSiDdIfgBZ12U6dHEHu9TpdIr8F0OP692CtzaW/a6y3y0Wx5kbFHvGuXzkgf0xhKnPzA4UTyaTB8Ph8AvcHi3fnsrZ7Wore02YViqVOrRXXPhfqP8j6MYlawoAAAAASUVORK5CYII='); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
            </div>
        </div>
        <div class="uk-form-row">
            <button class="uk-button uk-width-1-1">{!! \Lang::get('auth.Enter') !!}</button>
        </div>
        <div class="uk-form-row">
            <p style="text-align:center;"><a href="/auth/register">{!! \Lang::get('auth.Registration') !!}</a>&nbsp/&nbsp<a href="/password/email">{!! \Lang::get('auth.Forgot password') !!}</a></p>
        </div>
    </form>
  </div>
</body>