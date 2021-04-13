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

		  
		  
        </div>	  


        <div>


          <div class="bg-white mt-10 rounded-lg p-6 md:p-10 md:max-w-md mx-auto shadow-md">
            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Boards</label>
            <div class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 space-y-2">
			 <?php foreach($boards as $board): ?>
			<div class="bg-white shadow p-6 rounded-lg"><a href="board/<?php echo $board['ID'];?>"><div class="flex"><div><?php echo $board['name'];?> <div class="text-gray-400 text-xs"><?php echo zdateRelative($board['date_created']);?></div></div></a><div class="ml-auto  text-red-500"><form method="post"><input type="hidden" name="remove" value="<?php echo $board['ID'];?>" /><button class="focus:outline-none uppercase font-bold" type="submit"> delete</button>

			</form>
			<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
echo "arwerew";
  // collect value of input field
		$boardId = $_POST['remove'];
		User::deleteBoard($boardId);
		header('location: /private/public_html/home');		
}
		?>			
			</div></div></div>
			 <?php endforeach; ?>			

			</div>
          </div>

        </div>			


</div>		  
