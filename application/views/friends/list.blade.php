<h1>Amis</h1>
<div class="line">
	<div class="mod">
		@if(sizeof($friends) > 0)
		<table class="friends-table">
			@foreach($friends->results as $friend)
			<tr>
				<td class="small-photo"><a href="/friends/v/{{$friend->id}}">{{ HTML::image('avatars/'. $friend->image('small'), $friend->firstname . ' ' . $friend->lastname .' photo') }}</a></td>
				<td><a href="/friends/v/{{$friend->id}}">{{ $friend->firstname }} {{ $friend->lastname }}</a></td>
				@if($friend->pivot->debt >= 0)
				<td class="positive">
				@else
				<td class="negative">
				@endif
				<a href="/friends/v/{{$friend->id}}">{{ Money::render($friend->pivot->debt) }}</a></td>
				<td class="w200p"><a href="friends/v/{{$friend->id}}">Voir les interactions</a></td>
			</tr>
			@endforeach
		</table>
		{{ $friends->links() }}
		@else
		<p>Vous n'avez pas d'amis. N'hésitez pas à en ajouter !</p>
		@endif
	</div>
</div>
<div class="line">
	<div class="mod">
		<h2>Rechercher un ami</h2>
		<p>Vous pouvez rechercher un ami par son nom et prénom.</p>
		{{ $form->open('friends/search') }}
		{{ $form->text('friend_data', 'Rechercher') }}
		{{ $form->submit('Chercher') }}
		{{ $form->close() }}
	</div>
</div>