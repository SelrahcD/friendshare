<!doctype html>
<!--[if lte IE 7]> <html class="no-js ie7 oldie" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 oldie" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>FriendShare</title>
	<meta name="viewport" content="width=device-width">
	<!--[if lt IE 9]><script src="/js/html5shiv.js"></script><![endif]-->
	{{ HTML::style('css/auth.css') }}
</head>
<body>
	<header class="line main-header clearfix">
		<div class="w800p center">
		{{ HTML::link('/', 'FriendShare', array('class' => 'home-link left'))}}
		<nav class="main-nav">
			<ul>
				<li>{{ HTML::link('friends', 'Amis')}}</li>
				<li>{{ HTML::link('expenses', 'Dépenses')}}</li>
				<li>{{ HTML::link('account', 'Mon compte')}}</li>
				<li>{{ HTML::link('logout', 'Se déconnecter')}}</li>
			</ul>
		</nav>
		</div>
	</header>
	@if( Alert::has_alerts('main'))
	<div class="w800p center">
	{{ Alert::render('main') }}
	</div>
	@endif
	<div class="main-content">
		<div class="w800p center">
		{{ $content }}
		</div>
	</div>
	<footer class="main-footer">
		<p>&copy; <a href="http://www.chorip.am">Chorip.am</a> - 2012</p>
	</footer>
</body>
</html>