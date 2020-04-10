<?php

    // connect to database

    $conn = mysqli_connect('localhost','izzaz','test1234','pizza_hut');

    // check connection

    if(!$conn){
        echo 'Connect Error' . mysqli_connect_error();
    }

    // write query for all pizzas

    $sql = 'SELECT title, ingredients, id FROM pizzas';

    // make query and get result

    $result = mysqli_query($conn, $sql);

    // fetch the resulting row as an array

    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free results from memory
    mysqli_free_result($result);

    // closing connection

    mysqli_close($conn); 
    
    // print_r($pizzas);
?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php') ?>

    <h4 class="center grey-text">Pizzas !</h4>

    <div class="container">
        <div class="row">
            <?php 
            foreach($pizzas as $pizza): ?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h5><?php echo htmlspecialchars($pizza['title']); ?></h5>
                            <ul>
                                <?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                                    <li><?php echo htmlspecialchars($ing) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo $pizza['id']?>" class="brand-text">
                                more-info
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include('templates/footer.php') ?>
    
</body>
</html>

