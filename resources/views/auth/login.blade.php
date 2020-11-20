@extends('layouts.admin.nolayout')

@section('content')
    <div class="container">
        <div class="login-wrap">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#">
                        <img style="width:150px;height: 150px;object-fit: cover"
                            src="{{ asset('public/images/bp-logo.png') }}" alt="CoolAdmin">
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('อีเมล์') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('รหัสผ่าน') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('จดจำการเข้าสู่ระบบ') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">เข้าสู่ระบบ</button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('ลืมรหัสผ่าน?') }}
                            </a>
                        @endif

                        <div class="social-login-content">
                            <div class="social-button row">
                                <div class="col-12">
                                    <a id="google-signin" onclick="signInWithGoogle()"
                                        class="btn btn-light w-100 shadow-sm mb-2" href="#" role="button">
                                        <img src="{{ asset('public/images/google.png') }}" width="20px">
                                        {{ __('เข้าสู่ระบบด้วย Google') }}</a>
                                </div>
                                <div class="col-12">
                                    <a id="facebook-signin" onclick="signInWithFacebook()" style="background-color:#3b5998"
                                        class="btn text-white w-100 shadow-sm mb-2" href="#" role="button">
                                        <img src="{{ asset('public/images/facebook.png') }}" width="20px">
                                        {{ __('เข้าสู่ระบบด้วย Facebook') }}</a>
                                </div>
                                <div class="col-12">
                                    <a id="apple-signin" style="background-color:black"
                                        class="btn text-white w-100 shadow-sm mb-2" href="#" role="button"
                                        onclick="signInWithApple()">
                                        <img src="{{ asset('public/images/apple.png') }}" width="20px">
                                        {{ __('เข้าสู่ระบบด้วย Apple') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('login') }}" id="socialLogin" hidden>
                        @csrf
                        <input type="text" name="uid" id="uid">
                        <input type="text" name="email" id="email-social">
                    </form>
                    <div class="register-link">
                        <p>
                            ยังไม่มีบัญชี?
                            <a href="{{ url('/register') }}">สมัครสมาชิกที่นี่</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-auth.js"></script>
    <script>
        // Initialize Firebase
        const firebaseConfig = {
            apiKey: "AIzaSyC_x3lZhNx7xoTv-aadYNd54k_remUaz5M",
            authDomain: "bamboo-c6078.firebaseapp.com",
            databaseURL: "https://bamboo-c6078.firebaseio.com",
            projectId: "bamboo-c6078",
            storageBucket: "bamboo-c6078.appspot.com",
            messagingSenderId: "694201511002",
            appId: "1:694201511002:web:06a338a487491c2d4b7c63"
        };
        firebase.initializeApp(firebaseConfig);

        function signInWithGoogle() {
            var provider = new firebase.auth.GoogleAuthProvider();
            provider.addScope('profile');
            provider.addScope('email');
            provider.addScope('https://www.googleapis.com/auth/plus.me');
            provider.setCustomParameters({
                'login_hint': 'user@example.com',
                'prompt': 'select_account'
            });
            firebase.auth().signInWithPopup(provider).then(function(result) {
                // This gives you a Google Access Token. You can use it to access the Google API.
                var token = result.credential.accessToken;
                // The signed-in user info.
                var user = result.user;
                // ...

                $('#uid').val(user.uid);
                $('#email-social').val(user.email);
                $('#socialLogin').submit();
            }).catch(function(error) {
                // Handle Errors here.
                var errorCode = error.code;
                var errorMessage = error.message;
                // The email of the user's account used.
                var email = error.email;
                // The firebase.auth.AuthCredential type that was used.
                var credential = error.credential;
                alert('Error Code: ' + errorCode);
                alert("Error Message: " + errorMessage);
                // ...
            });
            firebase.auth().signOut().then(function() {
                // Sign-out successful.
            }).catch(function(error) {
                // An error happened.
            });

        }

        function signInWithFacebook() {
            var provider = new firebase.auth.FacebookAuthProvider();
            provider.setCustomParameters({
                'display': 'popup'
            });
            firebase.auth().signInWithPopup(provider).then(function(result) {
                // This gives you a Facebook Access Token. You can use it to access the Facebook API.
                var token = result.credential.accessToken;
                // The signed-in user info.
                var user = result.user;

                $('#uid').val(user.uid);
                $('#email-social').val(user.email);
                $('#socialLogin').submit();
                // ...
            }).catch(function(error) {
                // Handle Errors here.
                var errorCode = error.code;
                var errorMessage = error.message;
                // The email of the user's account used.
                var email = error.email;
                // The firebase.auth.AuthCredential type that was used.
                var credential = error.credential;
                alert('Error Code: ' + errorCode);
                alert("Error Message: " + errorMessage);
                // ...
            });
        }

        function signInWithApple() {
            var provider = new firebase.auth.OAuthProvider('apple.com');
            provider.addScope('email');
            provider.addScope('name');
            firebase
                .auth()
                .signInWithPopup(provider)
                .then(function(result) {
                    // The signed-in user info.
                    var user = result.user;
                    // You can also get the Apple OAuth Access and ID Tokens.
                    var accessToken = result.credential.accessToken;
                    var idToken = result.credential.idToken;

                    $('#uid').val(user.uid);
                    $('#email-social').val(user.email);
                    $('#socialLogin').submit();
                    // ...
                })
                .catch(function(error) {
                    // Handle Errors here.
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    // The email of the user's account used.
                    var email = error.email;
                    // The firebase.auth.AuthCredential type that was used.
                    var credential = error.credential;
                    alert('Error Code: ' + errorCode);
                    alert("Error Message: " + errorMessage);
                    // ...
                });


        }

    </script>
    @if (\Session::has('success'))
        <script>
            alert('{{ \Session::get('
                success ') }}');

        </script>
    @endif
@endsection
