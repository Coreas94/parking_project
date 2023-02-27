@if(Session::has('success'))
<script type="text/javascript">
      swal({
            title:'Success!',
            text:"{{Session::get('success')}}",
            timer:5000,
            type:'success'
      }).then((value) => {
         //location.reload();
   }).catch(swal.noop);
</script>
@endif

@if(Session::has('error'))
 <script type="text/javascript">
    swal({
        title:'Oops!',
        text:"{{Session::get('error')}}",
        type:'error',
        timer:5000
    }).then((value) => {
      //location.reload();
    }).catch(swal.noop);
</script>
@endif