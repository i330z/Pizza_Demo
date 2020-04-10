<?php

include('config/db_connect.php');

$email = $title = $ingredients = '';
$error = array('email'=>'', 'title'=>'', 'ingredient'=>'');
    if(isset($_POST['submit'])){
        // echo htmlspecialchars($_POST['email']);
        // echo htmlspecialchars($_POST['title']);
        // echo htmlspecialchars($_POST['ingredients']);

        if(empty($_POST['email'])){
            $error['email'] = 'An email is required <br />';
        }else{
            $email = htmlspecialchars($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error['email']='Please Enter a valid email';
            }
        }

        if(empty($_POST['title'])){
            $error['title']='An title is required <br />';
        }else{
            $title = htmlspecialchars($_POST['title']);
            if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
                $error['title']='Please Enter a Valid title, letter and spaces only';
            }
        }

        if(empty($_POST['ingredients'])){
            $error['ingredient']='An ingredients is required <br />';
        }else{
            $ingredients = htmlspecialchars($_POST['ingredients']);
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)){
                $error['ingredient']='Please Enter a Valid title, letter and spaces only';
            }
        }

        if(array_filter($error)){

        }else{

            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $title = mysqli_real_escape_string($conn,$_POST['title']);
            $ingredients = mysqli_real_escape_string($conn,$_POST['ingredients']);


            $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";

            if(mysqli_query($conn,$sql)){
                header('Location:index.php');
            }else{
                echo 'query error:' . mysqli_error($conn); 
            }

            
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php') ?>


    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form class="white" action="add.php" method="POST">
        
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
        <div class="red-text"><?php echo $error['email']; ?></div>
        <label for="email">Pizza Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title)?>">
        <div class="red-text"><?php echo $error['title']; ?></div>
        <label for="email">Ingredients:</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
        <div class="red-text"><?php echo $error['ingredient']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class=""btn brand z-depth-0>
        </div>
        
        </form>
    </section>


    <?php include('templates/footer.php') ?>
    
</body>
</html>