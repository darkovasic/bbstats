<div class="col-md-2 border border-right-0">
  <div id="aba_logo">
    <img src="{{URL::asset('/images/ABA-Liga_logo-2015.jpg')}}">
  </div>
  <div id="selection" class="form-group border-top">
      <label for="sel1">Select season:</label>
      <select class="form-control" id="select-season">
        <option>2017/18</option>
      </select>
      <label for="sel2">Select team:</label>
      <select class="form-control" id="select-team">
        @foreach ($teams as $team)
          {{ $team }}
        @endforeach
      </select>              
  </div>
</div>