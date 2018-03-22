@extends('layouts.app')

@section('content')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">

<section class="hero is-login is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
        <div class="column is-4 is-offset-4">
          <h3 class="title has-text-grey">Login</h3>
          <p class="subtitle has-text-grey">Please login to proceed.</p>
          <div class="card">
            <!-- <figure class="avatar">
              <img src="https://placehold.it/128x128">
            </figure> -->
            <div class="card-image has-text-centered">
              <i class="fa fa-user-circle"></i>
            </div>
            <div class="box">
            <form method="POST" action="{{ route('login') }}">
                @csrf
              <div class="field">
                <div class="control">
                  <input class="input is-large {{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" id="email" type="email" placeholder="Your Email" autofocus="" required>
                    @if ($errors->has('email'))
                        <span class="help is-danger">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
              </div>

              <div class="field">
                <div class="control">
                  <input class="input is-large { $errors->has('password') ? ' is-danger' : '' }}" id="password" name="password" type="password" placeholder="Your Password" required>
                  @if ($errors->has('password'))
                    <span class="help is-danger">
                        {{ $errors->first('password') }}
                    </span>
                  @endif
                </div>
              </div>
              <div class="field">
                <label class="checkbox">
                  <input type="checkbox" name="remembered" {{ old('remember') ? 'checked' : '' }}>
                  Remember me
                </label>
              </div>
              <button type="submit" class="button is-block is-info is-large is-fullwidth">Login</button>
            </form>
            </div>
          </div>
          <p>
            <a href="{{ route('register') }}">Sign Up</a> &nbsp;·&nbsp;
            <a href="{{ route('password.request') }}">Forgot Password</a> &nbsp;·&nbsp;
            <a href="../">Need Help?</a>
          </p>
        </div>
      </div>
    </div>
  </section>
@endsection
