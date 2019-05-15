@extends('templates.auth')

@section('content')

<m-body class="mdl-color--grey-100">
    <!---->
    <m-login class="ng-star-inserted">
        <div class="m-login">
            <div>
                <h3>Đăng nhập</h3>
                <minds-form-login>
                    <form class="mdl-card mdl-color-text--blue-grey-400 m-form m-login-box ng-untouched ng-pristine ng-invalid" action ="{{route('auth.signin')}}" method = "post" role="form" class="form-vertical">
                        <div class="mdl-card__supporting-text mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="{{ $errors->has('username') ? ' has-error' : ''}}">
                                    <input class="ng-untouched ng-pristine ng-invalid" type="text" name="username">
                                </div>
                                @if ($errors->has('username'))
                                    <span class = "help-block"><h5>{{ $errors->first('username')}}</h5></span>
                                @endif
                            </div>

                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="{{ $errors->has('password') ? ' has-error' : ''}}">
                                    <input class="ng-untouched ng-pristine ng-invalid" type="password" name="password">
                                </div>
                                @if ($errors->has('password'))
                                    <span class = "help-block"><h5>{{ $errors->first('password')}}</h5></span>
                                @endif
                            </div>

                          <!--   <div class="has-text-centered">
                                <div class="is-centered">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Nhớ tài khoản!
                                        </label>
                                    </div>
                                </div>
                            </div> -->

                        </div>

                        <div class="mdl-card__actions">
                            <button type="submit" class="m-btn m-btn--action m-btn--login">
                                <!---->Đăng nhập</button>
                            <a class="mdl-card__subtitle-text mdl-color-text--blue-grey-300 m-reset-password-link" href="">
                                <!---->Quên mật khẩu?</a>
                        </div>

                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </form>
                </minds-form-login>

            </div>
            <div>
                <h3>Bạn chưa đăng kí? Thêm ngay một yêu thương!</h3>
                <minds-form-register>
                    <div class="mdl-card mdl-color--red-500 mdl-color-text--blue-grey-50  mdl-shadow--2dp minds-login-box m-error-box" style="min-height:0;" hidden="">
                        <div class="mdl-card__supporting-text mdl-color-text--blue-grey-50"> </div>
                    </div>
                    <!---->
                    <form class="mdl-card mdl-color-text--blue-grey-400 m-form m-login-box ng-untouched ng-pristine ng-invalid ng-star-inserted" action = "{{route('auth.signup')}}" method="post" role="form" class="form-vertical">

                        <div class="mdl-card__supporting-text mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="{{ $errors->has('last_name') ? ' has-error' : ''}}">
                                    <input class="ng-untouched ng-pristine ng-invalid" type="text" placeholder="Họ và tên đệm" name="last_name">
                                </div>
                                @if ($errors->has('last_name'))
                                    <span class = "help-block"><h5>{{ $errors->first('last_name')}}</h5></span>
                                @endif
                            </div>
                        </div>

                        <div class="mdl-card__supporting-text mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="{{ $errors->has('first_name') ? ' has-error' : ''}}">
                                    <input class="ng-untouched ng-pristine ng-invalid" type="text" placeholder="Tên của bạn" name="first_name">
                                </div>
                                @if ($errors->has('first_name'))
                                    <span class = "help-block"><h5>{{ $errors->first('first_name')}}</h5></span>
                                @endif
                            </div>
                        </div>

                        <div class="mdl-card__supporting-text mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="{{ $errors->has('username') ? ' has-error' : ''}}">
                                    <input class="ng-untouched ng-pristine ng-invalid" type="text" placeholder="Tên tài khoản" name="username">
                                </div>
                                @if ($errors->has('username'))
                                    <span class = "help-block"><h5>{{ $errors->first('username')}}</h5></span>
                                @endif
                            </div>
                        </div>

                        <div class="mdl-card__supporting-text mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="{{ $errors->has('password') ? ' has-error' : ''}}">
                                    <input class="ng-untouched ng-pristine ng-invalid" type="password" placeholder="Mật khẩu" name="password">
                                </div>
                                @if ($errors->has('password'))
                                    <span class = "help-block"><h5>{{ $errors->first('password')}}</h5></span>
                                @endif
                            </div>
                        </div>

                        <div class="mdl-card__supporting-text mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="{{ $errors->has('email') ? ' has-error' : ''}}">
                                    <input class="ng-untouched ng-pristine ng-invalid" type="text" placeholder="Email" name="email">
                                </div>
                                @if ($errors->has('email'))
                                    <span class = "help-block"><h5>{{ $errors->first('email')}}</h5></span>
                                @endif
                            </div>
                        </div>

                        <div class="mdl-card__actions">
                            <div>
                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-js-ripple-effect--ignore-events is-upgraded" data-upgraded=",MaterialCheckbox,MaterialRipple">
                                    <input class="mdl-checkbox__input ng-untouched ng-pristine ng-valid" type="checkbox"><span class="m-register-tac"> Nhận thông tin từ We Love So thông qua hình thức gửi email </span><span class="mdl-checkbox__focus-helper"></span><span class="mdl-checkbox__box-outline"><span class="mdl-checkbox__tick-outline"></span></span><span class="mdl-checkbox__ripple-container mdl-js-ripple-effect mdl-ripple--center" data-upgraded=",MaterialRipple"><span class="mdl-ripple"></span></span>
                                </label>
                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-js-ripple-effect--ignore-events is-upgraded" data-upgraded=",MaterialCheckbox,MaterialRipple">
                                    <input class="mdl-checkbox__input ng-untouched ng-pristine ng-valid" type="checkbox"><span class="m-register-tac"> Tôi đồng ý với <a href=""> điều khoản </a>của We Love So</span><span class="mdl-checkbox__focus-helper"></span><span class="mdl-checkbox__box-outline"><span class="mdl-checkbox__tick-outline"></span></span><span class="mdl-checkbox__ripple-container mdl-js-ripple-effect mdl-ripple--center" data-upgraded=",MaterialRipple"><span class="mdl-ripple"></span></span>
                                </label>
                            </div>
                            <button type="submit" class="m-btn m-btn--action">
                                <!---->Đăng kí</button>
                        </div>
                         <input type="hidden" name="_token" value="{{Session::token()}}">
                    </form>
                </minds-form-register>
            </div>
        </div>
    </m-login>
</m-body>

@stop
