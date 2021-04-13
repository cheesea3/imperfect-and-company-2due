<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
</head>
<body>
<style>
  body {
    background: cornflowerblue;
    min-width: 1500px;
    width: 100%;
  }
  table td {
    height: 50px;
    padding: 5px;
  }

  table td button {
    height: 35px;
  }

  table {
    background: #CCCCCC;
  }

  .board-column{
    float: left;
    width: 20%;
    background:#ebecf0;
    padding: 5px;
    margin-right: 5px;
    min-height: 924px;

  }

  .board-column h3{
    margin-left: 5px;
  }

  .board {
    min-height: 30px;
    padding: 10px;
    background: white;
    box-shadow:4px 4px 10px rgba(0,0,0,0.06);
    width: 91%;
    display: inline-block;
    margin: 5px;
    border-radius: 3px;
  }
  .board-form  button {
    height: 35px;
  }

  .board-form {
    margin-left: 5px;
  }

  .board-items{
    overflow-y: scroll;
    overflow-x: hidden;
    min-height: 700px;
  }
</style>
<h2 style="text-align: center">Kanban Board</h2>
<div class="bottom" style="margin-bottom: 100px;">
  <form method="post">
    <input type="hidden" value="<?php echo $activeId;?>" name="task"/>
  <div class="board-column">
    <h3>Backlog</h3>
    <div class="board-form">
      <input value="<?php echo get_active_value("backlog", $activeTask);?>" type="text" name="backlog" style="height: 30px; width: 70%" autocomplete="off"/>
      <button type="submit" name="save-backlog">Save</button>
    </div>
    <div class="board-items">
      <?php foreach (get_tasks('backlog') as $task):?>
          <?php echo show_tile($task,'backlog');?>
      <?php endforeach;?>
    </div>
  </div>

  <div class="board-column">
    <h3>Pending</h3>
    <div class="board-form">
      <input value="<?php echo get_active_value("pending", $activeTask);?>" type="text" name="pending" style="height: 30px; width: 70%" autocomplete="off"/>
      <button type="submit" name="save-pending">Save</button>
    </div>
    <div class="board-items">
      <?php foreach (get_tasks('pending') as $task):?>
        <?php echo show_tile($task,'pending');?>
      <?php endforeach;?>
    </div>
  </div>

  <div class="board-column">
    <h3>In Progress</h3>
    <div class="board-form">
      <input value="<?php echo get_active_value("progress", $activeTask);?>" type="text" name="progress" style="height: 30px; width: 70%" autocomplete="off"/>
      <button type="submit" name="save-progress">Save</button>
    </div>
    <div class="board-items">
      <?php foreach (get_tasks('progress') as $task):?>
        <?php echo show_tile($task,'progress');?>
      <?php endforeach;?>
    </div>
  </div>

  <div class="board-column">
    <h3>Completed</h3>
    <div class="board-form">
      <input value="<?php echo get_active_value("completed", $activeTask);?>" type="text" name="completed" style="height: 30px; width: 70%" autocomplete="off"/>
      <button type="submit" name="save-completed">Save</button>
    </div>
    <div class="board-items">
      <?php foreach (get_tasks('completed') as $task):?>
        <?php echo show_tile($task,'completed');?>
      <?php endforeach;?>
    </div>
  </div>
  </form>
</div>

</body>
</html>