

<body class="antialiased sans-serif bg-gray-300">

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
            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wid">	 <?php if(!User::ifOwner($boardid)): ?>
							  <div class=" text-lg font-bold">Board belongs to: <?php echo User::getBoardUser($GLOBALS['url_loc'][2]); ?></div>
<?php endif; ?>							  </label>		  
		  
		  					  <?php if(User::ifOwner($boardid)): ?>
            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wid">Create a new task</label>
            <input type="text" name="taskname" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="Type your task, select a column, and hit create...">
			<button class="py-2 px-1 ml-auto flex rounded-lg mt-2 px-4 font-bold bg-blue-500 focus:outline-none select-none text-white transition hover:bg-blue-700 cursor-pointer transition-delay-400" >Create</button>			
			<div class="flex"><div class="py-2 rounded-lg mt-2 px-4 font-bold bg-red-500 focus:outline-none select-none text-white transition hover:bg-red-700 cursor-pointer transition-delay-400"><a href="../home">Back</a></div></div>
			<?php endif; ?>
          </div>
		  					  <?php if(!User::ifOwner($boardid)): ?>
							  <div class="flex py-3"><div class="rounded-lg text-white text-lg font-bold mr-auto p-3 bg-blue-500 justify-start">Board: <?php echo User::getBoardName($GLOBALS['url_loc'][2]); ?></div><div class="rounded-lg p-3 bg-blue-500 text-white text-lg font-bold ml-auto justify-end"><a href="../login">Click here to login</a></div></div>
<?php endif; ?>							  
		  </form>		  
        </div>	  


        <div>


<div class="py-4 md:py-8 flex">
              <div class="flex w-full block overflow-x-auto pb-2 ">

              
                  <div class="w-1/3 md:w-1/4 px-4 flex-shrink-0 justify-center items-center text-center mx-auto">
                    <div class="bg-gray-100 pb-4 space-y-3 rounded-lg shadow overflow-y-auto overflow-x-hidden border-t-8 border-orange-600" style="min-height: 100px">
                      <div class="flex justify-between items-center px-4 py-2 bg-gray-100 sticky top-0">
                        <h2 x-text="board" class="font-medium text-gray-800">2DUE</h2>
                      </div>
					  <?php foreach($todo as $task): ?>
					  <div class="bg-white shadow p-6 text-center" x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak><?php echo $task['name'];?>
					  <?php if(User::ifOwner($boardid)): ?>
					  
		<button type="button" class="flex mx-auto items-center mb-1 text-center justify-center bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-1 px-2 rounded" @click="showModal = true">Edit task</button>


		<!--Overlay-->
		<div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
			<!--Dialog-->
			<div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

				<!--Title-->
				<div class="flex justify-between items-center pb-3">
					<p class="text-2xl font-bold">Edit your task</p>
					<div class="cursor-pointer z-50" @click="showModal = false">
						<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
							<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						</svg>
					</div>
				</div>
				<!-- content -->
				<div class="flex justify-between items-center pb-3">				
				<form method="post"><div class="flex items-center"><div class=" justify-start items-start text-start "><input type="text" name="contents" class="border" placeholder="<?php echo $task['name'];?>" /><input type="hidden" name="edit" value="<?php echo $task['ID'];?>" /></div><div class="justify-end text-end items-end">
					<button type="submit" class="px-4 bg-transparent border-gray-600 hover:border-indigo-500 border p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 focus:outline-none mr-2">Edit</button></div></div></form>							
				</div>


			</div>
			</div>

					  
					  <div><!-- delete task --><form method="post"><input type="hidden" name="taskcol" value="1" /><input type="hidden" name="remove" value="<?php echo $task['ID'];?>" /><button class="justify-center focus:outline-none uppercase font-bold justify-center bg-transparent border border-gray-500 hover:border-red-500 mb-1 text-gray-500 hover:text-red-500 font-bold py-1 px-2 rounded" type="submit" type="submit"> delete</button></form></div>
					  <div class="flex text-blue-500 ml-auto justify-end text-lg font-bold"><!-- move task --><form method="post"><input type="hidden" name="taskcol" value="1" /><input type="hidden" name="move" value="<?php echo $task['ID']?>" /><button class="justify-center focus:outline-none uppercase font-bold justify-center bg-transparent border border-gray-500 hover:border-blue-500 text-gray-500 hover:text-blue-500 font-bold py-1 px-2 rounded " type="submit">Move to right</button></form></div>
					  <?php endif; ?>
					  </div>
					  <?php endforeach ?>
                    </div>
                  </div>
				  
				  
				  
                  <div class="w-1/3 md:w-1/4 px-4 flex-shrink-0 justify-center items-center text-center mx-auto">
                    <div class="bg-gray-100 pb-4 space-y-3 rounded-lg shadow overflow-y-auto overflow-x-hidden border-t-8 border-orange-600" style="min-height: 100px">
                      <div class="flex justify-between items-center px-4 py-2 bg-gray-100 sticky top-0">
                        <h2 x-text="board" class="font-medium text-gray-800">2DUE</h2>
                      </div>
					  <?php foreach($doing as $task): ?>
					  <div class="bg-white shadow p-6 text-center" x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak><?php echo $task['name'];?>
					  <?php if(User::ifOwner($boardid)): ?>
					  
		<button type="button" class="flex mx-auto items-center mb-1 text-center justify-center bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-1 px-2 rounded" @click="showModal = true">Edit task</button>


		<!--Overlay-->
		<div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
			<!--Dialog-->
			<div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

				<!--Title-->
				<div class="flex justify-between items-center pb-3">
					<p class="text-2xl font-bold">Edit your task</p>
					<div class="cursor-pointer z-50" @click="showModal = false">
						<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
							<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						</svg>
					</div>
				</div>
				<!-- content -->
				<div class="flex justify-between items-center pb-3">				
				<form method="post"><div class="flex items-center"><div class=" justify-start items-start text-start "><input type="text" name="contents" class="border" placeholder="<?php echo $task['name'];?>" /><input type="hidden" name="edit" value="<?php echo $task['ID'];?>" /></div><div class="justify-end text-end items-end">
					<button type="submit" class="px-4 bg-transparent border-gray-600 hover:border-indigo-500 border p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 focus:outline-none mr-2">Edit</button></div></div></form>							
				</div>


			</div>
			</div>

					  
					  <div><!-- delete task --><form method="post"><input type="hidden" name="taskcol" value="1" /><input type="hidden" name="remove" value="<?php echo $task['ID'];?>" /><button class="justify-center focus:outline-none uppercase font-bold justify-center bg-transparent border border-gray-500 hover:border-red-500 mb-1 text-gray-500 hover:text-red-500 font-bold py-1 px-2 rounded" type="submit" type="submit"> delete</button></form></div>
						<div class="flex flex-row-reverse">
					  <div class="flex text-blue-500 ml-auto justify-start text-lg font-bold"><!-- move task --><form method="post"><input type="hidden" name="taskcol" value="2" /><input type="hidden" name="move" value="<?php echo $task['ID']?>" /><button class="focus:outline-none uppercase font-bold text-blue-500 mx-2 my-2  type="submit">Move to right</button></form></div>
					  
					  
					  <div class="flex text-blue-500 ml-auto justify-end text-lg font-bold"><!-- move task --><form method="post"><input type="hidden" name="taskcol" value="0" /><input type="hidden" name="move" value="<?php echo $task['ID']?>" /><button class="focus:outline-none uppercase font-bold text-blue-500 mx-2 my-2 " type="submit">Move to left</button></form></div>
					  </div>

					  <?php endif; ?>
					  </div>
					  <?php endforeach ?>
                    </div>
                  </div>

				  
                  <div class="w-1/3 md:w-1/4 px-4 flex-shrink-0 justify-center items-center text-center mx-auto">
                    <div class="bg-gray-100 pb-4 space-y-3 rounded-lg shadow overflow-y-auto overflow-x-hidden border-t-8 border-orange-600" style="min-height: 100px">
                      <div class="flex justify-between items-center px-4 py-2 bg-gray-100 sticky top-0">
                        <h2 x-text="board" class="font-medium text-gray-800">2DUE</h2>
                      </div>
					  <?php foreach($doing as $task): ?>
					  <div class="bg-white shadow p-6 text-center" x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak><?php echo $task['name'];?>
					  <?php if(User::ifOwner($boardid)): ?>
					  
		<button type="button" class="flex mx-auto items-center mb-1 text-center justify-center bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-1 px-2 rounded" @click="showModal = true">Edit task</button>


		<!--Overlay-->
		<div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
			<!--Dialog-->
			<div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

				<!--Title-->
				<div class="flex justify-between items-center pb-3">
					<p class="text-2xl font-bold">Edit your task</p>
					<div class="cursor-pointer z-50" @click="showModal = false">
						<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
							<path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
						</svg>
					</div>
				</div>
				<!-- content -->
				<div class="flex justify-between items-center pb-3">				
				<form method="post"><div class="flex items-center"><div class=" justify-start items-start text-start "><input type="text" name="contents" class="border" placeholder="<?php echo $task['name'];?>" /><input type="hidden" name="edit" value="<?php echo $task['ID'];?>" /></div><div class="justify-end text-end items-end">
					<button type="submit" class="px-4 bg-transparent border-gray-600 hover:border-indigo-500 border p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 focus:outline-none mr-2">Edit</button></div></div></form>							
				</div>


			</div>
			</div>

					  
					  <div><!-- delete task --><form method="post"><input type="hidden" name="taskcol" value="1" /><input type="hidden" name="remove" value="<?php echo $task['ID'];?>" /><button class="justify-center focus:outline-none uppercase font-bold justify-center bg-transparent border border-gray-500 hover:border-red-500 mb-1 text-gray-500 hover:text-red-500 font-bold py-1 px-2 rounded" type="submit" type="submit"> delete</button></form></div>
	  
					  <div class="flex text-blue-500 ml-auto justify-end text-lg font-bold"><!-- move task --><form method="post"><input type="hidden" name="taskcol" value="0" /><input type="hidden" name="move" value="<?php echo $task['ID']?>" /><button class="focus:outline-none uppercase font-bold text-blue-500 mx-2 my-2 " type="submit">Move to left</button></form></div>


					  <?php endif; ?>
					  </div>
					  <?php endforeach ?>
                    </div>
                  </div>
                </div>
            </div>
			

        </div>			


</div>		
  
