<h2>Удаление аккаунта</h2>
<form method="post" action="{{ route('profile.destroy') }}" class="p-6">
    @csrf
    @method('delete')
    <h4>Вы уверены, что хотите удалить аккаунт?</h4>
    <p>После удаления вашей учетной записи все ее ресурсы и данные будут безвозвратно удалены. Пожалуйста, введите свой
        пароль, чтобы подтвердить, что вы хотите навсегда удалить свою учетную запись.</p>

    <div class="form-group">
        <label for="">Пароль</label>
        <input type="password" name="password" value="{{ __('Password') }}">
        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2"/>
    </div>
    <button class="more">Удалить аккаунт</button>
</form>

<style>
    h2{
        margin-top: 40px;
    }
</style>

