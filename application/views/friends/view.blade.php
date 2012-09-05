<h1>Amis</h1>
<div class="line">
	<div class="mod">
		@if(sizeof($friends) > 0)
		<table class="friends-table">
			@foreach($friends as $friend)
			<tr>
				<td class="small-photo"><a href="#">{{ HTML::image('avatars/'. $friend->image('small'), $friend->firstname . ' ' . $friend->lastname .' photo') }}</a></td>
				<td><a href="#">{{ $friend->firstname }} {{ $friend->lastname }}</a></td>
				@if($friend->pivot->debt >= 0)
				<td class="positive">
				@else
				<td class="negative">
				@endif
				<a href="#">{{ abs($friend->pivot->debt) }}</a></td>
				<td class="w200p"><a href="#">Voir les interactions</a></td>
			</tr>
			@endforeach
		</table>
		@else
		<p>Vous n'avez pas d'amis. N'hésitez pas à en ajouter !</p>
		@endif
	</div>
</div>
<div class="line">
	<div class="mod">
		<h2>Ajouter de nouveaux amis</h2>
		<p>Vous pouvez ajouter des nouveaux amis en les recherchant par leur noms et prénoms.</p>
	</div>
</div>