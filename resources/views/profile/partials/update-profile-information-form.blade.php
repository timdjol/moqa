<h2>Профиль</h2>
{{--<form id="send-verification" method="post" action="{{ route('verification.send') }}">--}}
{{--    @csrf--}}
{{--    <button class="more">Отправить</button>--}}
{{--</form>--}}

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')
    <div class="form-group">
        <label for="">Ваше имя</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">
    </div>

    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" value="{{ old('name', $user->email) }}">
        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>
    <button class="more">Сохранить</button>
    @if (session('status') === 'profile-updated')
        <p>Сохранено</p>
    @endif
</form>
