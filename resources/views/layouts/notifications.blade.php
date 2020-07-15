@if ($errors->any())
    @foreach ($errors->all() as $error)
      <script type="text/javascript">
      $(document).ready(function(){
        $.fn.notifyMe('danger', 120, "{{ $error}}");
      });
    </script>
    @endforeach
  @endif

  @if(session()->get('error'))
    <script type="text/javascript">
      $(document).ready(function(){
        $.fn.notifyMe('danger', 120, "{{ session()->get('error')}}");
      });
    </script> 
  @endif

  @if(session()->get('success'))
    <script type="text/javascript">
     // alert();
      $(document).ready(function(){
        $.fn.notifyMe('success', 5, "{{ session()->get('success')}}");
      });      
    </script>  
  @endif
<?php 
Session::forget('error');
Session::forget('success');
?>