
<!-- Js de plugins-->
<script src="{{asset('packages/jquery-3.4.1/jquery.min.js')}}" ></script> 
<!-- <script src="{{ asset('packages/jquery.min.js') }}"></script> -->
<script src="{{asset('packages/dropzone/dropzone.js') }}" ></script>
<script src="{{asset('packages/popper-1.16.0/popper.min.js') }}" ></script>
<script src="{{asset('packages/bootstrap-4.4.1/js/bootstrap.min.js') }}"></script>
<!-- <script src="{{ asset('packages/boostrap/bootstrap.min.js')}}"></script> -->
<script src="{{asset('packages/fontawesome-5.0.7/fontawesome.js') }}"></script>
<script src="{{asset('packages/fotoroma-4.6.4/fotorama.js') }}" ></script>
<script src="{{asset('packages/datatables-1.10.7/jquery.dataTables.min.js') }}" ></script>

<!-- <script src="{{ asset('packages/fontawesome-5.0.7/fontawesome.js') }}" ></script> -->
<!-- <script src="{{ asset('packages/fotoroma-4.6.4/fotorama.js') }}" ></script> -->



<!-- <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> -->

<!-- Globales-->
<script src="{{ asset('js/main.js') }}"></script>

<!-- JS usado en las pestallas de los administradores-->
<script src="{{ asset('js/admin/projectsList.js') }}"></script>

<!-- JS usado en las pestallas de los clientes-->
<script src="{{ asset('js/client/products.js') }}"></script>
<script src="{{ asset('js/client/services.js') }}"></script>
<script src="{{ asset('js/client/general.js') }}"></script>

<!--  Scripts extras-->
<!-- <script src="{{ asset('packages/jquery.min.js') }}"></script>
<script src="{{ asset('packages/boostrap/bootstrap.min.js')}}"></script>  -->
<script>
  function addActiveClass(){
    var objs = document.getElementsByTagName('a');          // take all 'a' tags
    for(var i = 0; i < objs.length; i++){
      if(objs[i].href == window.location.href){             // check if the user is on this link
        objs[i].className = objs[i].className + " active";  // add additional 'active' class
      }
    }
  }
  addActiveClass();
</script>