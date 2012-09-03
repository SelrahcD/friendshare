<section>
	<h2>Se connecter</h2>
	{{ Alert::render() }}
	<div class="clearfix">
	{{ $form->open() }}
	<fieldset>
	{{ $form->text('email', 'Email') }}
	{{ $form->password('password', 'Mot de passe') }}
	{{ $form->submit('Se connecter') }}
	</fieldset>
	{{ $form->close() }}
	</div>
</section>
<section>
<h2>Vous n'avez pas encore un compte ?</h2>
<p>{{ HTML::link('register', 'Créer un compte.')}}</p>
</section>