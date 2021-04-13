<?php if(count($GLOBALS['errors']) > 0): ?>
			<div class="pt-8">	
           <div class="bg-red-200 border-l-4 border-red-300 text-red-800 p-4">
  <p class="font-bold">Bruh...</p>
        <?php foreach($GLOBALS['errors'] as $error): ?>  
  <p><?php echo $error; ?></p>
        <?php endforeach; ?>  
</div>
</div>
<?php endif; ?>