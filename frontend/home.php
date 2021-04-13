<body class="antialiased sans-serif bg-gray-300" data-new-gr-c-s-check-loaded="14.1005.0" data-gr-ext-installed="">

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer=""></script>

      <!-- Header -->
      <div class="bg-cover bg-center bg-no-repeat bg-blue-900">
        <div class="container mx-auto px-4 pt-4 md:pt-10 pb-40"></div>
      </div>
      <!-- /Header -->
      <div class="container mx-auto px-4 py-4 -mt-40">	  
        <!-- Welcome Page -->
        <div>

		  <form method="post">
          <div class="bg-white rounded-lg p-6 md:p-10 md:max-w-md mx-auto shadow-md">
            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wid">Create a new board</label>
            <input type="text" name="boardname" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="Pick a board name and hit enter...">
			<button class="py-2 px-1 ml-auto flex rounded-lg mt-2 px-4 font-bold bg-blue-500 focus:outline-none select-none text-white transition hover:bg-blue-700 cursor-pointer transition-delay-400" >Create</button>
          </div>
		  </form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // collect value of input field
		$boardname = $_POST['boardname'];
		
	if($_POST['boardname'] != ""){	
User::createBoard($boardname);
  header('location: /private/public_html/home');
	} else {
	echo "something went wrong!";
	}	
}
?>
		  
		  
        </div>	  
 <?php foreach($boards as $board): ?>  
<?php echo $board['name'];?>
 <?php endforeach; ?>

        <div>


          <div class="bg-white mt-10 rounded-lg p-6 md:p-10 md:max-w-md mx-auto shadow-md">
            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Boards</label>
            <div class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
			<div class="bg-white shadow p-6 rounded-lg"><div class="flex"><div>board1</div><div class="ml-auto">text</div></div></div>
			</div>
          </div>

        </div>			


</div>		  
