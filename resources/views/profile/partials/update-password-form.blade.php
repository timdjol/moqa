<section>
    <h2>Обновление пароля</h2>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        @error ('current_password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="">Текущий пароль</label>
            <input type="password" name="current_password" value="{{ __('Current Password') }}">
        </div>
        @error ('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="">Новый пароль</label>
            <input type="password" name="password" value="{{ __('New Password') }}">
        </div>
        @error ('password_confirmation')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="">Подтверждение пароля</label>
            <input type="password" name="password_confirmation" value="{{ __('Confirm Password') }}">
        </div>

        <button class="more">Сохранить</button>

        @if (session('status') === 'password-updated')
            <p>Сохранено</p>
        @endif
    </form>
</section>
