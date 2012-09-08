<div class="line clearfix">
	<div class="mod">
	{{ HTML::image('avatars/'. $friend->image, $friend->firstname . ' ' . $friend->lastname .' photo', array('class' => 'left')) }}
	<h1>{{ $friend->firstname }} {{ $friend->lastname }}</h1>
	<p class="big">
	@if($friend->pivot->debt >= 0)
	vous doit <span class="positive">{{ Money::render($friend->pivot->debt) }}</span>.
	@else
	Vous lui devez <span class="negative">{{ Money::render($friend->pivot->debt) }}</span>.
	@endif
	</p>
	</div>
</div>
