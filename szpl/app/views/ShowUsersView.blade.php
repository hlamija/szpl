@extends('layout.defaultAdmin')



@section('links')

<script src="/project/szpl/public/tablesorter/jquery.tablesorter.min.js" type="text/javascript"></script> 

<link rel="stylesheet" href="/project/szpl/public/tablesorter/themes/blue/style.css"></link>
<style type="text/css">
.Buttons{
  position: absolute;
  right:20px;
}
</style>
<script type="text/javascript"> 
$(document).ready(function() { 
  $("#my-table-sorter").tablesorter(); 

$("#Change").on("click", function(e){
      e.preventDefault();
      var id= $.trim($('input[name=radioBtn]:checked').attr('value'));
      $('#my-table-sorter tr').each(function(){
        if($.trim(parseInt($(this).find('td').eq(1).text())) == id){
          //uzimamo sve vrijednosti polja iz reda gdje je Id== cekiranom ID-u
          var uid = $(this).find('td').eq(1).text();
          var username = $(this).find('td').eq(2).text();
          var email =$(this).find('td').eq(3).text();
          var address=  $(this).find('td').eq(4).text();
          var role=  $(this).find('td').eq(5).text();
            //proslijedjujemo pokupljene informacije iz tabele u modal za eventualne izmjene
          $('#inputUsername').attr('value',username);
          $('#inputEmail').attr('value',email);
          $('#inputAddress').attr('value',address);
          $('#inputPassword').attr('placeholder','input new password');
          $('#userRole').val($.trim(role));

          $('#myModal').modal('show');

        }
    });
    });

  $("#Delete").on('click', function(event) {
    event.preventDefault();
        $.ajax({
          url: '/path/to/file',
          type: 'POST',
          dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
          data: {param1: 'value1'},
        })
        .done(function() {
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
        
  });
                
  });

</script>
@endsection

@section('mainContent')
	<table id="my-table-sorter" class="table table-striped"> 
  <thead> 
    <tr> 
      <th>Change</th>
      <th>Id</th>
      <th>Username</th> 
      <th>Address</th> 
      <th>Email</th> 
      <th>Role</th> 
    </tr> 
  </thead> 
  <tbody> 
     <?php 
    foreach ($users as $u)
    {
    ?>
    <tr> 
      <td><input type="radio" id="radioBtn" name="radioBtn" class="radio" value='<?php echo $u->id  ?>'></input></td>
      <td id="id">{{$u->id}}</td>
      <td id="username">{{$u->username}}</td> 
      <td>{{$u->adress}}</td> 
      <td>{{$u->email}}</td> 
      <td>{{BaseController::getUserRole($u->id)}}</td> 
    </tr> 
    <?php }?>
  </tbody> 
</table>
<div class="Buttons">
  <input type="button" id="Change" class="btn" name="Change" value="Izmjeni Podatke"></input>
  <input type="button" id="Delete" class="btn" name="Change" value="Izbrisi Korisika"></input>
</div>

<div id="myModal" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Izmjena Korisnika</h3>
  </div>
  <div class="modal-body">
    <div class="control-group">
      <label class="control-label" for="inputUsername">Username</label>
    <div class="controls">
      <input type="text" id="inputUsername" placeholder="Username">
    </div>
     </div>
    <div class="control-group">
      <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
      <input type="text" id="inputEmail" placeholder="Email">
    </div>
     </div>
      <div class="control-group">
      <label class="control-label" for="inputAddress">Address</label>
    <div class="controls">
      <input type="text" id="inputAddress" placeholder="Address">
    </div>
     </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
      <input type="password" id="inputPassword" placeholder="Password">
    </div>
  </div>
   <label class="control-label" for="inputUsername">User Role</label>
<select id="userRole">
  <option >Administrator</option>
  <option >Korisnik</option>
  <option >Aviokompanija</option>
</select>
  </div>
  <div class="modal-footer">
    <a href="" class="btn">Close</a>
    <a href="" class="btn btn-primary">Save changes</a>
  </div>
</div>


@endsection