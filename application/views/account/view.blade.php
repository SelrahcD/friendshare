<h1>Mon compte</h1>
<div class="line">
	<div class="mod w100">
	{{ HTML::image('avatars/'. Auth::user()->image, Auth::user()->firstname . ' ' . Auth::user()->lastname .' photo', array('class' => 'left')) }}
		<p>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
		<p>{{ Auth::user()->email }}</p>
		<p>{{ HTML::link('account/modify', 'Modifier mes informations', array('class' => 'button right')) }}</p>
	</div>
</div>

<div class"line">
	<div class="mod w100">
		<h2>Changer de mot de passe</h2>
		<p>Il vous est possible de changer votre mot de passe.</p>
		<p>{{ HTML::link('account/change_pwd', 'Changer de mot de passe', array('class' => 'button right')) }}</p>
	</div>
</div>