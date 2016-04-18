@if(Session::has('message'))
    @section('scriptsPost')
    <script>
      swal({
        title:"{{ Session::get('title') }}",
        text:"{{ Session::get('message') }}",

        type:"{{ Session::get('status') }}"
      });
      @if(Session::has('response'))
      console.log({!! dd(Session::all()) !!})
      @endif
    </script>
    @stop
@endif
