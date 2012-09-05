<h1>Modifier mon compte</h1>
<div class"line">
    <div class="mod">
    {{ Alert::render('invalid_pwd') }}
    {{ $form->open() }}
        <fieldset>
            {{ $form->text('firstname', 'Prénom') }}
            {{ $form->text('lastname', 'Nom') }}
            {{ $form->text('email', 'Email') }}
        </fieldset>
        <fieldset>
            <p>Afin de valider les modifications vous devez indiquer votre mot de passe.</p>
            <!-- current password field -->
            {{ $form->password('current_password', 'Mot de passe actuel') }}
        </fieldset>
        {{ $form->submit('Effectuer les changements') }}
    {{ $form->close() }}
    <h2>Photo</h2>
    {{ $form->open_for_files('account/change_photo') }}
    <fieldset>
        {{ HTML::image('avatars/'. Auth::user()->image, Auth::user()->firstname . ' ' . Auth::user()->lastname .' photo', array('class' => 'left')) }}
        {{ $form->file('image', 'Photo') }}
    </fieldset>
    {{ $form->submit('Changer de photo') }}
    {{ $form->close() }}
    </div>
</div>