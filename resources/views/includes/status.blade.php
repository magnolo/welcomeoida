@if(Session::has('message'))
    @section('scriptsPost')
    <script>
      swal({
        title:"{{ Session::get('title') }}",
        text:"{{ Session::get('message') }}",

        type:"{{ Session::get('status') }}"
      });
      console.log({{ Session::get('response') }})
    </script>
    @stop
@endif
