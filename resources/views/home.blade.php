@extends('layouts.app')

@section('content')
<div class="container round-border">
  <form method="POST" action="/save/{{ $user->id }}" enctype="multipart/form-data" >
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row">
        <div class="col-md-3">
          <h2>Notes</h2>
            <textarea rows="25" cols="30" maxlength="500" id="notes" name="notes" style="resize:none;">{{ $user->notes }}</textarea>
        </div>
        <div class="col-md-3">
          <h2>Websites</h2>
            @foreach($user->websites as $website)
              <input type="text" name="websites[]" onclick="location.assign('//' + this.value)" value="{{$website->website}}"/><br ><br >
            @endforeach
            <input type="text" name="websites[]" /><br ><br >
            <input type="text" name="websites[]" /><br ><br >
            <input type="text" name="websites[]" /><br ><br >
            <input type="text" name="websites[]" /><br ><br >
        </div>
        <div class="col-md-3">
          <h2>Images</h2>
          @if(count($user->images) == 4)
            You can only have a maximum of 4 images
            <br/>
          @else
            <input type="file" name="image" id="image">
            <br />
          @endif
          @php($count = 0)
          @foreach($user->images as $image)
            <a href="{{ asset('/uploadedimages/' . $user->email . '/' . $image->image) }}">
              <img width="100px" length="100px" src="{{ asset('/uploadedimages/' . $user->email . '/' . $image->image) }}" />
            </a>
            <input type="checkbox" name="delete[]" value="{{ $image->id }}"> delete
            <br />
          @endforeach
        </div>
        <div class="col-md-3">
          <h2>TBD</h2>
          <textarea rows="25" cols="30" maxlength="500" id="tbd" name="tbd" style="resize:none;">{{$user->tbd}}</textarea>
        </div>
    </div>
    <br />
    <div class="row">
      <div class="col-md-3 col-md-offset-5">
        <button  type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </form>
</div>
@endsection
