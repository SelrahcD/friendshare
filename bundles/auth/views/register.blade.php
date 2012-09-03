<section>
<h2>Créer un compte</h2>
{{ $form->open() }}
    <fieldset>
        {{ $form->text('firstname', 'Prénom') }}
        {{ $form->text('lastname', 'Nom') }}
        {{ $form->text('email', 'Email') }}
        {{ $form->password('password', 'Mot de passe') }}
        {{ $form->password('password_confirmation', 'Confirmez votre mot de passe') }}
        {{ $form->submit('Créer un compte') }}
    </fieldset>
{{ Form::close() }}
</section>