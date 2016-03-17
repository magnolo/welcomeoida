@if(Session::has('message'))
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
        title:"{{ Session::get('title') }}",
        text:"{{ Session::get('message') }}",

        type:"{{ Session::get('status') }}"
      });
    </script>
    @stop
@endif
