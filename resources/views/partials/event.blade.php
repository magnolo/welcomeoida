<div class="col s12 m4">
  <div class="card small">
    <div class="card-image waves-effect waves-block waves-light">
        @if($event->image_id)
      <img class="activator" src="{{ $event['image']['path']}}">
      @else
      <img class="activator" src="http://placehold.it/350x200?text=Kein+Bild+vorhanden">
      @endif
    </div>
    <div class="card-content">
       <span class="card-title activator grey-text text-darken-4">{{ $event['title'] }}<i class="material-icons right">more_vert</i></span>
      <p>
          <a href="{{ route('user.event', ['id' => $event['id']])}}">Bearbeiten</a>
          @if($event['is_public'])
          <i class="material-icons right green-text" title="feigeschalten">lock_open</i>
          @else
        <i class="material-icons right red-text" title="noch nicht freigeschalten">lock_outline</i>
        @endif
      </p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">{{ $event['title'] }}<i class="material-icons right">close</i></span>
      <div>{{ $event['date']}}</div>
      <div>{{ $event['address']}}</div>
      <p>{{ $event['description']}}</p>
    </div>
  </div>
</div>
