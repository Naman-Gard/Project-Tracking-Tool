
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/jquery.min.js')}}"></script>

  <!-- datatables -->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.material.min.js"></script>
  
  <script>
    let api_url ='{{env("API_URL")}}'
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <!-- Github buttons -->
   <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
   
   <script src="https://buttons.github.io/buttons.js"></script>
   

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/material-dashboard.min.js?v=3.0.1')}}"></script>
 
  <script>
    
    function removeMessage(item){
        $('.alert-success').addClass('hide-item')
        sessionStorage.removeItem(item)
    }

    function getPermissions(){
      let user_id="{{Session::get('user')['id']}}"
    const filters={
        "user_id":{
            '_eq': user_id
        }
    }
    $.ajax({
      type: "GET",
      url: api_url+'items/permissions?filter='+JSON.stringify(filters),
    }).done((response)=>{
      const user_permits=response.data.pop()
      
      const view=JSON.parse(user_permits.view)
      const edit=JSON.parse(user_permits.edit)
      const add=JSON.parse(user_permits.add)
      const delet=JSON.parse(user_permits.delete)
      // add=modules.filter(e=>!add.includes(e));
      // edit=modules.filter(e=>!edit.includes(e));
      // delet=modules.filter(e=>!delet.includes(e));
      view.forEach((item)=>{
        $('#'+item).removeClass('hide-item');
      });
      add.forEach((item)=>{
        // $('.'+item+'_add').attr("disabled",true);
        $('.'+item+'_add').removeClass('hide-item');
      })
      edit.forEach((item)=>{
        // $('.'+item+'_add').attr("disabled",true);
        $('.'+item+'_edit').removeClass('hide-item');
        $('.'+item+'_action').removeClass('hide-item');
      })
      delet.forEach((item)=>{
        // $('.'+item+'_add').attr("disabled",true);
        $('.'+item+'_delete').removeClass('hide-item');
        $('.'+item+'_action').removeClass('hide-item');
      })

    })
    }
    
    getPermissions()
    
  </script>

 @stack('scripts')