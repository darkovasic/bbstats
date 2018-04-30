<div id="aba_logo">
  <img src="{{URL::asset('/images/ABA-Liga_logo-2015.jpg')}}">
</div>

<div id="selection" class="border-top">
  <form action="/submit">
    @csrf
    <div class="form-group">
      <label for="season_id">Select season:</label>
      <select class="form-control input-sm" id="season_id">
        <option>2017/18</option>
      </select>
    </div>
    <div class="form-group">
      <label for="team_id">Select team:</label>
      <select class="form-control input-sm" id="team_id" name="team_id">
        <option value="0" disabled="true" selected="true">-Select Team-</option>
        @foreach ($teams as $team)
          <option value="{{ $team->id }}">{{ $team->name }}</option>
        @endforeach
      </select> 

      @foreach ($errors->all() as $error)
        <span class="error">{{ $error }}</span>
      @endforeach
    </div>

    <div class="form-group">
      <label for="player_id">Select player:</label>
      <select class="form-control input-sm" id="player_id" name="player_id">
        <option value="0" disabled="true" selected="true">-Select Player-</option>
      </select>
    </div>
    <div class="form-group">
      <button type="submit" name='submit' class="btn btn-success btn-block">Go!</button>
    </div>
  </form>
</div>


