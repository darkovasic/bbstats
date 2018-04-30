@extends ('index')

@section('content')

<div class="first_row">
	{{ $player->first_name }} {{ $player->last_name }} #{{ $player->number }}
</div>
<div class="info">
	<div id="info_left">
		<table class="table table-bordered table-sm" id="player-avg">
				<tr>
					<th><span style="font-weight: 700">Season Average</span></th>
					<th>MPG</th>
					<th>PPG</th>
					<th>RPG</th>
					<th>APG</th>
				</tr>
				<tr>
					<td><span style="font-size: 1.7rem; font-weight: 400">2017/18</span></td>
					@foreach ($seasonAvg as $item)
						<td><span id="avg"> {{ $item }} </span></td>
					@endforeach	
				</tr>			
		</table>
	</div>
	<div id="info_right">
		<span class="amp">Role:</span> {{ $player->role->role }}<br>
		<span class="amp">Height:</span> {{ $player->height }} cm<br>
		<span class="amp">Date of birth:</span> {{ $player->birth_date }}<br>
		<span class="amp">Country:</span> {{ $player->country->country_name }}<br>
	</div>
</div>
<div>

	<h4>Per Game</h4>

	@include ('player.table_header')

		@foreach ($table as $row)
		<tr>
			@if ($loop->remaining >= 2)

				@foreach ($row as $item)
					@if ($loop->first)
						<td>{{ Html::link('gamestats/'.$gameId[$loop->parent->index], $gameName[$loop->parent->index]) }}</td>
					@else
						<td class="right">{{ $item }}</td>
					@endif
				@endforeach

			@else

				@foreach ($row as $item)
					@if ($loop->first)
						<td>{{ $item }}</td>
					@else
						<td class="right">{{ $item }}</td>
					@endif
				@endforeach

			@endif			
		</tr>
		@endforeach
	</table>	
</div>

@endsection