<h1>Changer de mot de passe</h1>
<div class"line">
    <div class="mod">
    {{ Alert::render('invalid_pwd') }}
    {{ $form->open() }}
    <fieldset>
    	<p>Vous devez indiquer votre mot de passe actuel pour pouvoir changer de mot de passe.</p>
    	{{ $form->password('old_password', 'Mot de passe actuel') }}
    </fieldset>
    <fieldset>
        {{ $form->password('password', 'Nouveau mot de passe') }}
        {{ $form->password('password_confirmation', 'Confirmez le mot de passe') }}
    </fieldset>
    {{ $form->submit('Changer le mot de passe') }}
    {{ $form->close() }}
   	</div>
</div>