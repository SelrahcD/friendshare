<h1>Dashboard</h1>
<div class="row txtcenter stat-container">
	<div class="col w200p"><p>Vous avez <span class="stat-number neutral">{{ HTML::link('friends', '7') }}</span> amis</p>
	</div>
	<div class="col w200p"><p>Vous devez <span class="stat-number negative">16,46€</span></p>
	</div>
	<div class="col w200p"><p>On vous doit <span class="stat-number positive">12€24</span></p>
	</div>
</div>
<div class="line">
	<div class="mod clearfix w400p">
	<h2>Amis</h2>
	<ul class="friends-list">
		<li>{{ HTML::image('avatars/'. Auth::user()->image('small'), Auth::user()->firstname . ' ' . Auth::user()->lastname .' photo', array('class' => 'avatar')) }}<p class="inbl">Vous devez <span class="negative">12€25</span> à Martin Alain</p></li>
		<li><img src="http://placehold.it/50x50" class="avatar" /><p class="inbl">Vous devez <span class="negative">3€30</span> à Bruce Willis</p></li>
		<li><img src="http://placehold.it/50x50" class="avatar" /><p class="inbl">Jean-Maxime Devaux vous doit <span class="positive">37€20</span></p></li>
	</ul>
	<p>
	{{ HTML::link('friends', 'Tous les amis', array('class' => 'button right'))}}
	</p>
	</div>
</div>