<h1>Rechercher des amis</h1>
<div class="line">
	<div class="mod">
		@if(sizeof($people->results) > 0)
		<table class="friends-table">
			@foreach($people->results as $person)
			<tr>
				<td class="small-photo"><a href="/friends/v/{{$person->id}}">{{ HTML::image('avatars/'. $person->image('small'), $person->firstname . ' ' . $person->lastname .' photo') }}</a></td>
				<td><a href="/friends/v/{{$person->id}}">{{ $person->firstname }} {{ $person->lastname }}</a></td>
				<td>
				@if(($isAFriend = Auth::user()->isFriendWith($person)))
				Vous êtes déjà amis
				@else
					@if(($communFriends = sizeof(Auth::user()->sharedFriendsWith($person))) == 0)
					Vous n'avez pas d'amis en commun.
					@elseif($communFriends == 1)
					Vous avez un ami en commun.
					@else
					Vous avez {{ $communFriends }} amis en commun.
					@endif
				@endif
				</td>
				<td>
				@if($isAFriend)
				<a href="/friends/v/{{$person->id}}">Voir les interactions</a>
				@else
				<a href="/friends/add/{{$person->id}}">Ajouter à mes amis</a>
				@endif
				</td>
			</tr>
			@endforeach
		</table>
		{{ $people->links() }}
		@else
		<p>La recherche n'a rien retourné.</p>
		@endif
	</div>
</div>