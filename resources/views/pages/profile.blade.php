<x-layouts.app game profile>
    <main class="profile-screen">
        <h1>{{ __('Profile') }}</h1>
        @if (session('status')) <p class="form-success">{{ session('status') }}</p> @endif
        <section class="profile-form-card">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf @method('PUT')
                <label class="profile-field">{{ __('Username:') }}<input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" readonly required></label>
                <label class="profile-field">{{ __('Email:') }}<input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" readonly required></label>
                <label class="profile-field">{{ __('Current password:') }}<input type="password" name="current_password" readonly></label>
                <label class="profile-field">{{ __('New password:') }}<input type="password" name="password" readonly></label>
                <label class="profile-field">{{ __('Confirm password:') }}<input type="password" name="password_confirmation" readonly></label>
                <button class="profile-pencil" id="edit-profile" type="button" aria-label="{{ __('Edit profile') }}" title="{{ __('Edit profile') }}">✎</button>
                @foreach ($errors->all() as $error) <p class="form-error">{{ $error }}</p> @endforeach
                <button class="profile-save" id="save-profile" type="submit" hidden>{{ __('Save profile') }}</button>
            </form>
        </section>
        <div class="profile-actions">
            <button class="delete-account" id="open-delete-account" type="button">{{ __('Delete account') }}</button>
            <form method="POST" action="{{ route('logout') }}" class="profile-logout-form">
                @csrf
                <button class="profile-logout" type="submit">{{ __('Log out') }}</button>
            </form>
        </div>

        <div class="delete-modal" id="delete-modal" hidden>
            <div class="delete-modal-backdrop" data-close-delete></div>
            <section class="delete-modal-card" role="dialog" aria-modal="true" aria-labelledby="delete-modal-title">
                <h2 id="delete-modal-title">{{ __('Delete account') }}</h2>
                <p>{{ __('Enter your password to delete your account') }}</p>
                <form method="POST" action="{{ route('profile.delete') }}">
                    @csrf @method('DELETE')
                    <input class="delete-password" type="password" name="password" aria-label="{{ __('Password') }}" required autofocus>
                    <div class="delete-modal-actions">
                        <button class="delete-cancel" type="button" data-close-delete>{{ __('Cancel') }}</button>
                        <button class="delete-confirm" type="submit">{{ __('Delete') }}</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
</x-layouts.app>
