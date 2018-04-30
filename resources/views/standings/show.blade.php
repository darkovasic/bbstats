@extends ('index')

@section('content')

<div class="first_row">
	Standings
</div>
<div class="info">

</div>
<div id="div-standings">

	<h4>2017/18 Regular Season</h4>

	@include ('standings.table_header')

		@foreach ($table as $row)
			<tr>
				@foreach ($row as $item)
					@if ($loop->first)
						<td>{{ $item }}</td>
					@else
						<td class="right">{{ $item }}</td>
					@endif
				@endforeach
			</tr>
		@endforeach
	</table>

</div>

@endsection