<?php
    //Проверка на действительность сессии юзера
    if(!isset($_COOKIE['user'])){
        header('Location: /index');
    }
//    foreach ($data as $row){
//        echo '<h1>'.$row.'</h1>';
//    }
 //   function draw(){ //Вывод таблицы с задачами на страницу
        //$items = getItemsFromDB();
        //$model = new Model_Taskslist;
        //$items = $model->getItemsFromDB();

 //   }

?>
<h2> Welcome, <?=$_SESSION['user']?> </h2>
<div class="row">
    <h3> Tasks list </h3>
    <form action="" method="post">
        <div class="row row-col-2">
            <div class="col-6">
                <input type="text" class="form-control" name="task" placeholder="Enter text..."> 
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-dark" name="add"><b>ADD TASK</b></button>
            </div>
        </div>
        <div class="row row-col-2">
            <div class="col-3">
                <button type="submit" class="btn btn-outline-dark" name="remove"><b>REMOVE ALL</b> </button>
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-outline-dark" name="readyall"><b>READY ALL</b> </button>
            </div>
        </div>
    </form>
</div>
<div>
    <table class="table">
    <?php
    foreach ($data as $row) {
        echo '<form action="" method="post">';
        echo '<input type="hidden" name="id" value="'.htmlspecialchars($row['id']) . '">';
        echo '<tr>';
        if($row['status'] == '0'){
            echo '<td> <button class="btn btn-danger disabled">  </button> </td>';
        }
        else{
            echo '<td> <button class="btn btn-success disabled">  </button> </td>';
        }
        echo '<td>' . $row['description'] . '</td>';
        echo '<td>' . $row['created_at'] . '</td>';
        if($row['status'] == '0'){
            echo ' <td class="tabbut"> <button type="submit" class="btn btn-outline-dark" name="ready"><b> READY </b></button></td>';
        }
        else{
            echo ' <td class="tabbut"> <button type="submit" class="btn btn-outline-dark" name="unready"><b> UNREADY </b></button></td>';
        }
        echo ' <td class="tabbut"> <button type="submit" class="btn btn-outline-dark" name="delete"><b> DELETE </b></button></td>';
        echo '</tr>';
        echo '</form>';
    }
        $controller = new Controller_Taskslist();
        $controller->handle();
                  
    ?>
    </table>
</div>