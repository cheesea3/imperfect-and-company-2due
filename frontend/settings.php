<?php
/*Call our notification handling*/ include("../frontend/sitenotif.php");
?>
<?php
?>


<?php if(isset($success)): ?>
			<div class="pt-8">	
           <div class="bg-green-200 border-l-4 border-green-300 text-green-800 p-4">
  <p class="font-bold">Success!</p>
  <p><?php switch($success){case "username": echo('Your username has been changed.'); break; case "password": echo('Your password has been changed.'); break; default: break;}?></p>
</div>
</div>
<?php endif; ?>

<style>

  .body{background-color:white !important;}

  .tab {
    opacity:0;
    visibility:hidden;
    transform:translate(0,50px);
  }
  
  .active-tab,.active-button{
    transition:transform 0.2s,background 0.2s,color 0.2s;
  }
  
  .active-tab{
    visibility:visible;
    opacity:1;
    transform:translate(0,0);
    z-index:99;
  }
  .active-button{
    background:white !important;
    color:#3730a3;
  }
</style>
<div class="tabs mx-auto text-indigo-800 m-10" style="max-width:450px;">
  <div class="top flex text-gray-100 rounded-t-sm overflow-hidden">
    <div class="header p-2 px-3 bg-indigo-800 w-full font-semibold uppercase">Settings</div>
    <div class="buttons ml-auto my-auto flex">
      <span tab="1" class="btn bg-indigo-800 cursor-pointer p-2 px-3">Change Username</span>
      <span tab="2" class="btn bg-indigo-800 cursor-pointer p-2 px-3">Change Password</span>
      <span tab="3" class="btn bg-indigo-800 cursor-pointer p-2 px-3">Log out</span>
    </div>
  </div>
  <div class="center text-gray-800 relative">
<!-- tab start -->
   <div class="tab bg-white rounded-b-md w-full border border-t-0 absolute top-0">
      <p class="text-xl p-3 px-5 font-semibold">Change Username</p>
      <div class="p-3 px-5">
        <?php include('components/changeusername/changeusername.php'); ?>
        <br>
        <div tab="2" class="oint text-sm my-4 p-2 px-4 cursor-pointer font-semibold inline-block bg-indigo-800 rounded-sm text-indigo-100">Next</div>
      </div>     
   
   </div>
<!--     tab end -->
   <div class="tab bg-white rounded-b-md w-full border border-t-0 absolute top-0">
      <p class="text-xl p-3 px-5 font-semibold">Change Password</p>
        <?php include('components/changepassword/changepassword.php'); ?>
        <br>
<div class="border-t border-gray-200">
      <div class="p-4 flex items-center space-x-4">		
        <div tab="1" class="flex justify-center w-full text-sm px-4 py-3 cursor-pointer font-semibold   rounded-sm"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
</svg>Back</div>		
        <div tab="3" class="flex justify-center w-full text-sm px-4 py-3 cursor-pointer font-semibold inline-block bg-indigo-800 rounded-sm text-indigo-100">Next</div>
      </div> 
</div>	  
   </div>
<!-- tab end -->
   <div class="tab bg-white rounded-b-md w-full border border-t-0 absolute top-0">
      <p class="text-xl p-3 px-5 font-semibold">Log out</p>
      <div class="p-3 px-5">
        <?php include('components/logout/logout.php'); ?>
        <br>
        <div tab="2" class="oint text-sm my-4 p-2 px-4 cursor-pointer font-semibold inline-block bg-indigo-800 rounded-sm text-indigo-100">Previous</div>
      </div>     
   
   </div>
  </div>
</div>

<script>
const root = document.querySelector(".tabs"),tabs=root.querySelectorAll(".tab"),btns=root.querySelectorAll(".btn");
  root.onclick = function(e){
    var t = e.target,val = t.getAttribute("tab");
    if(val != null){
      tabs.forEach(each=>{each.classList.remove("active-tab");});
      btns.forEach(each=>{each.classList.remove("active-button");});
      tabs[val - 1].classList.add("active-tab");
      btns[val - 1].classList.add("active-button");
    }
  }
</script>