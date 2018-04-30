@extends ('index')

@section('content')

<div class="first_row">
	<div id="team_home">{{ $game->homeTeam->name }}</div>
	<div id="team_away">{{ $game->awayTeam->name }}</div>	
	<div id="score_middle">{{ $game->score_home }} : {{ $game->score_away }}</div>	
</div>

<div class="info">
	<div id="info_left">
		<table class="table table-bordered table-sm">
		@foreach ($scorePeriod as $row)
			@if ($loop->first)
				<tr>
					@foreach ($row as $item)
						<th> {{ $item }} </th>
					@endforeach
				</tr>
			@else
				<tr>
					@foreach ($row as $item)
						<td> {{ $item }} </td>
					@endforeach	
				</tr>			
			@endif
		@endforeach
		</table>
	</div>
	<div id="info_right">
		<span class="amp">Date:</span> {{ $game->start_date_time }}<br>
		<span class="amp">Venue: </span>{{ $game->venue->venue }}<br>
		<span class="amp">City: </span>{{ $game->venue->city->city }}, {{ $game->venue->city->country->country_name }}<br>
		<span class="amp">Attendance: </span>{{ $game->attendance }}
	</div>
</div>

<h4>{{ $game->homeTeam->name }}</h4>

	@include ('gamestats.table_header')

		@foreach ($homeTeamStats as $row)
		<tr>
			@if ($loop->remaining >= 1)

				@foreach ($row as $item)
					@if ($loop->first)
						<td>{{ Html::link('player/'.$homeTeamPlayers[$loop->parent->index], $item) }}</td>
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


<h4>{{ $game->awayTeam->name }}</h4>

	@include ('gamestats.table_header')

	@foreach ($awayTeamStats as $row)
		<tr>
			@if ($loop->remaining >= 1)

				@foreach ($row as $item)
					@if ($loop->first)
						<td>{{ Html::link('player/'.$awayTeamPlayers[$loop->parent->index], $item) }}</td>
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



@endsection