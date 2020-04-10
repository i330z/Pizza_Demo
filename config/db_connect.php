    <?php
    
    // connect to database

    $conn = mysqli_connect('localhost','izzaz','test1234','pizza_hut');

    // check connection

    if(!$conn){
        echo 'Connect Error' . mysqli_connect_error();
    }

    ?>