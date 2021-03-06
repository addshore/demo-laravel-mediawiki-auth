<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OauthLoginController extends Controller {
	public function __construct() {
		$this->middleware( 'guest' )->only( [ 'login', 'callback' ] );
		$this->middleware( 'auth' )->only( 'logout' );
	}

	public function login() {
		return Socialite::driver( 'mediawiki' )
			->redirect();
	}

	public function callback() {
		$socialiteUser = Socialite::driver( 'mediawiki' )->user();

		$user = User::firstOrCreate( [
			'username' => $socialiteUser->name,
		] );

		Auth::login( $user, false );
		return redirect()->intended( '/' );
	}

	public function logout( Request $request ) {
		$this->guard()->logout();
		$request->session()->invalidate();
		return redirect( '/' );
	}

	private function guard() {
		return Auth::guard();
	}
}
