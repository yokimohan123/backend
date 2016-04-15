
@extends('layouts.backend')
@section('content')
<html>
		<h1>	Users	</h1>
	<div class="container">
  <table width="60%" cellspacing="10" cellpadding="9" border="0" class="data"><h2>
    
     <?php 
 Session::get('key');

     $users=DB::table('users')->get();
       echo "<tr>
      <th><h3><center>Name</th>
       <th><h3><center>Email</th>
     <th><h3><center>Mobile</th>
     <th><h3><center>Address</th>
     </tr>";

     foreach ($users as $user) 

{		

/*
     echo "<tr>
     <th><h3><center>Name</th>
     <th><h3><center>Email</th>
     <th><h3><center>Mobile</th>
     <th><h3><center>Address</th>
     </tr>

     <td><h4><center> $user->name</td>
     <td><h4><center> $user->email</td>
     <td><h4><center> $user->mobile</td>
     <td><h4><center> $user->address</td>";
     */

      echo "<tr>
     <td><h4><center> $user->name</td>
     <td><h4><center> $user->email</td>
     <td><h4><center> $user->mobile</td>
     <td><h4><center> $user->address</td>
     </tr>";






  }
      
       ?>
   </h2>
   </table>
       </html>                            
 @stop 
