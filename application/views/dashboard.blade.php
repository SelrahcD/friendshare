<h1>Dashboard</h1>
<div class="row txtcenter stat-container">
	<div class="col w200p"><p>Vous avez <span class="stat-number neutral">{{ HTML::link('friends', $friendsNumber) }}</span>
	@if($friendsNumber > 1)
	 amis
	 @else 
	 ami
	 @endif</p>
	</div>
	<div class="col w200p"><p>Vous devez <span class="stat-number negative">{{ Money::render(Auth::user()->debit) }}</span></p>
	</div>
	<div class="col w200p"><p>On vous doit <span class="stat-number positive">{{ Money::render(Auth::user()->credit) }}</span></p>
	</div>
</div>
<div class="line">
	<div class="mod clearfix w400p">
	<h2>Amis</h2>
	@if(sizeof($friends) > 0)
		<table class="friends-table">
			@foreach($friends as $friend)
			<tr>
				<td class="small-photo"><a href="friends/v/{{$friend->id}}">{{ HTML::image('avatars/'. $friend->image('small'), $friend->firstname . ' ' . $friend->lastname .' photo') }}</a></td>
				<td><a href="friends/v/{{$friend->id}}">
				@if($friend->pivot->debt >= 0)
					{{ $friend->firstname }} {{ $friend->lastname }} vous doit <span class="positive">{{ Money::render($friend->pivot->debt) }}</span>.
				@else
				Vous devez <span class="negative">{{ Money::render($friend->pivot->debt) }}</span> à {{ $friend->firstname }} {{ $friend->lastname }}.
				@endif
				</a>
				</td>
			</tr>
			@endforeach
		</table>
		@else
		<p>Vous n'avez pas d'amis. N'hésitez pas à {{ HTML::link('friends', 'en ajouter !')}}</p>
		@endif
	<p>
	{{ HTML::link('friends', 'Tous les amis', array('class' => 'button right'))}}
	</p>
	</div>
</div>