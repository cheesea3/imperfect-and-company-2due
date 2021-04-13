

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
            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wid">Create a new task</label>
            <input type="text" name="taskname" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" placeholder="Type your task, select a column, and hit create...">
			<button class="py-2 px-1 ml-auto flex rounded-lg mt-2 px-4 font-bold bg-blue-500 focus:outline-none select-none text-white transition hover:bg-blue-700 cursor-pointer transition-delay-400" >Create</button>			
			<div><a href="../home"><div class="py-2 px-1 rounded-lg mt-2 px-4 font-bold bg-red-500 focus:outline-none select-none text-white transition hover:bg-red-700 cursor-pointer transition-delay-400">Back</div></a></div>
          </div>
		  </form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // collect value of input field
		$taskname = $_POST['taskname'];
		
	if($_POST['taskname'] != ""){	
User::createTask($taskname, $GLOBALS['url_loc'][2]);
  header('location: /private/public_html/board/' . $GLOBALS['url_loc'][2]);
	} else {
	echo "something went wrong!";
	}	
}
?>
		  
		  
        </div>	  


        <div>


<div class="py-4 md:py-8 flex">
              <div class="flex w-full block overflow-x-auto pb-2 ">

              
                  <div class="w-1/3 md:w-1/4 px-4 flex-shrink-0 justify-center items-center text-center mx-auto">
                    <div class="bg-gray-100 pb-4 rounded-lg shadow overflow-y-auto overflow-x-hidden border-t-8 border-orange-600" style="min-height: 100px">
                      <div class="flex justify-between items-center px-4 py-2 bg-gray-100 sticky top-0">
                        <h2 x-text="board" class="font-medium text-gray-800">To Do</h2>
                        <a href="#" class="inline-flex items-center text-sm font-medium text-blue-500 hover:text-blue-600">
                          <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                          </svg>
                          Add Task
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="w-1/3 md:w-1/4 px-4 flex-shrink-0 justify-center items-center text-center mx-auto">
                    <div class="bg-gray-100 pb-4 space-y-3 rounded-lg shadow overflow-y-auto overflow-x-hidden border-t-8 border-orange-600" style="min-height: 100px">
                      <div class="flex justify-between items-center px-4 py-2 bg-gray-100 sticky top-0">
                        <h2 x-text="board" class="font-medium text-gray-800">Doing</h2>
                        <a href="#" class="inline-flex items-center text-sm font-medium text-blue-500 hover:text-blue-600">
                          <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                          </svg>
                          Add Task
                        </a>
                      </div>
					  <?php foreach($doing as $task): ?>
					  <div class="bg-white shadow p-6 text-center"><?php echo $task['name'];?></div>
					  <?php endforeach ?>
                    </div>
                  </div>			  
                  <div class="w-1/3 md:w-1/4 px-4 flex-shrink-0 justify-center items-center text-center mx-auto">
                    <div class="bg-gray-100 pb-4 rounded-lg shadow overflow-y-auto overflow-x-hidden border-t-8 border-orange-600" style="min-height: 100px">
                      <div class="flex justify-between items-center px-4 py-2 bg-gray-100 sticky top-0">
                        <h2 x-text="board" class="font-medium text-gray-800">Done</h2>
                        <a href="#" class="inline-flex items-center text-sm font-medium text-blue-500 hover:text-blue-600">
                          <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                          </svg>
                          Add Task
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

        </div>			


</div>		
  
