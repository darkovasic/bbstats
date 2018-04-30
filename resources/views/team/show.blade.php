@extends ('index')

@section('content')

<div class="first_row">
	{{ $team->name }}
</div>
<div class="info">
	<span class="amp">Coach:</span> {{ $team->coach->first_name }} {{ $team->coach->last_name}}<br>
	<span class="amp">Venue:</span> {{ $team->venue->venue }}<br>
	<span class="amp">City:</span> {{ $team->venue->city->city }}<br>
	<span class="amp">Country:</span> {{ $team->venue->city->country->country_name }}
</div>
<div>

	<h4>Per Game</h4>

	@include ('team.table_header')

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