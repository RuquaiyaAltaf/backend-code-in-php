

<?php

//clean all null entities
function clean($string){
    return htmlentities($string);
}
// place all entities to header location
function redirect($location){
    
    return header("location:{$location}");
    
}
//call message

function set_message($message){

    if(!empty($message)){
        $_SESSION['message'] = $message;
    }
    else{
        $message ="";
    }
}
// diaplay message

function display_message(){
    
  if(isset($_SESSION['message'])){
      echo $_SESSION['message'];
      unset($_SESSION['message']);
  }
    
}
function username_exist($username){
    $sql = "SELECT id FROM users WHERE username ='{$username}'" ;
    $result = query($sql);
    if(row_count($result)== 1){
        return true;
    }
    else{
        
        return false;
    }
}





//create a random number that we can use further and md5 encrypt data
 function token_genetrator(){

     $token = $_SESSION['token']= md5(uniqid(mt_rand(),true));
    return $token;
}
function email_existed($email){
    $sql = "SELECT id FROM users WHERE email ='{$email}'" ;
    $result = query($sql);
    if(row_count($result) == 1){
        return true;
    }
    else{
        
        return false;
    }
}
 



//validate the user input

function validate_user_register(){
    $errors=[];
    $min = 3;
    $max = 20;
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        $first_name         = escape(clean($_POST['first_name']));
        $last_name          = clean($_POST['last_name']);
        $username           = clean($_POST['username']);
        $email              = clean($_POST['email']);
        $password           = clean($_POST['password']);
        $fconfirm_password  = clean($_POST['confirm_password']);

//        if(strlen($first_name)>$min && strlen($first_name)< $max){
//            $errors[] =  "please enter more than 3 words and less than 20";
//        }

        if(strlen($fconfirm_password)!== strlen($password)){

        $errors[] =  "Password not matched";

        }

        if(!empty($errors)){
            foreach($errors as $error){
             validation_error($error);

            }
        }
        else{



         if(user_register($first_name,$last_name,$username,$email,$password)) {


             
              set_message("<p class='bg-success text-center'>USER REGISTER SUCCESSFULLY </p>");

              redirect ("index.php");



         }else{
                set_message("<p class='bg-danger text-center'>USER CANNOT REGISTER  </p>");
                  redirect ("register.php");

         }
        }
    }

}
// check conditions for user registration
function user_register($first_name,$last_name,$username,$email,$password){
    
        $first_name = escape($first_name);
        $last_name  = escape($last_name);
        $username   = escape($username);
        $email      = escape($email);
        $password   = escape($password);


//
        if(email_existed($email)){
            return false;
        }elseif (username_exist($username)){
            return false;
        }else{

            $password =md5($password);
            $validation =md5($username);
        $sql = "INSERT INTO users (first_name, last_name, username, email, password, validatecode, active) 
                VALUES ('{$first_name}','{$last_name}','{$username}','{$email}','{$password}','{$validation}','0')";

       $result =query($sql);
        confirm($result);

//                $subject = "Activate Account";
//                //in localhost we have to give your website link
//                $msg = "Please click the link below to active your account http://localhost/login/activate.php?email={$email}&code={$validation}";
//                $headers = "From noreply@ruquaiyaaltaf.com";
//                send_emial ($email,$subject,$msg,$headers);

            return true;
    }

}
 
?>