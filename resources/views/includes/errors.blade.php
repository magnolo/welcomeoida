@if($errors->has())
@foreach($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
    @section('scripts')
    <script>
      var message =
          '<ul>' +
              @foreach($errors->all() as $error)
                  '<li>{{ $error }}</li>'+
              @endforeach
          '</ul>';
      swal({
        title:'Fehler bei der Registrierung',
        text:message,
        html:true,
        type:'error'
      });
    </script>
    @stop

@endif
