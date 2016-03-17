@if(Session::has('message'))
    @section('scripts')
    <script>
      swal({
        title:"{{ Session::get('title') }}",
        text:"{{ Session::get('message') }}",

        type:"{{ Session::get('status') }}"
      });
    </script>
    @stop
@endif
