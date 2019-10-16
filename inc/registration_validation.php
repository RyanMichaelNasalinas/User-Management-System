<?php 

include "./init/init.php";

        if (isset($_POST['register'])) {

             $database->firstname = $database->escape(Validation::helper_uc($_POST['firstname']));
            $database->lastname = $database->escape(Validation::helper_uc($_POST['lastname']));
            $database->age = $database->escape($_POST['age']);
            $database->gender = $database->escape($_POST['gender']);
            $database->username = $database->escape($_POST['username']);
            $database->password = $database->escape(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $database->email = $database->escape($_POST['email']);
            $database->user_type = $database->escape($_POST['user_type']);
            $database->user_status = $database->escape('pending');

            
              $data = [
                //Array Errors
                'firstname_err' => '',
                'lastname_err' => '',
                'age_err' => '',
                'gender_err' => '',
                'username_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'email_err' => '',
                'user_type_err' => ''
            ];

           
        
            
                    if($data != null) {
                            if(empty($_POST['firstname'])) {
                                $data['firstname_err'] = 'Firstname should not be empty';
                            }
                            if(empty($_POST['lastname'])) {
                                $data['lastname_err'] = 'Lastname should not be empty';
                            }
                            if(empty($_POST['age'])) {
                                $data['age_err'] = 'Age should not be empty';
                            }
                        
                            //Validate Username
                            if(empty($_POST['username'])) {
                                $data['username_err'] = 'Username should not be empty';
                            } else {
                                if($validation->check_username($_POST['username'])) {
                                    $data['username_err'] = 'Username is already existed';
                                }
                            }
                            
                            if(empty($_POST['password'])) {
                                $data['password_err'] = 'Password should not be empty';
                            } elseif(strlen($_POST['password']) < 8) {
                                $data['password_err'] = 'Password shoud be more than 8 Characters';
                            } elseif(!preg_match('/[A-Z]/',$_POST['password'])) {
                                $data['password_err'] = 'Password should contain atleast a uppercase letter';
                            } elseif(!preg_match('/[a-z]/',$_POST['password'])) {
                                $data['password_err'] = 'Password should contain atleast a lower letter';
                            } elseif(!preg_match('/[0-9]/',$_POST['password'])) {
                                $data['password_err'] = 'Password should contain atleast a number';
                            } elseif(!preg_match('/[A-Za-z0-9\s]/',$_POST['password'])) {    
                                $data['password_err'] = 'Password should contain atleast a symbol';
                            }

                            if(empty($_POST['confirm_password'])) {
                                $data['confirm_password_err'] = 'Confirm Password should not be empty';
                            } else {
                                if($_POST['confirm_password'] != $_POST['password']) {
                                    $data['confirm_password_err'] = 'Password is not matched';
                                }
                            }
                            //Validate Password
                            if(empty($_POST['email'])) {
                                $data['email_err'] = 'Email should not be empty';
                            } else {
                                if($validation->check_email($_POST['email'])) {
                                    $data['email_err'] = 'Email is already existed';
                                }
                            }
                            if(empty($_POST['user_type'])) {
                                $data['user_type_err'] = 'User Type should not be empty';
                            }


                            
                            if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['age_err']) 
                                && empty($data['username_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) 
                                && empty($data['email_err']) && empty($data['user_type'])) {

                                if($database->add_user()) {
                                    echo "User has been created";
                                    unset($_POST['firstname'],$_POST['lastname'],$_POST['age'],$_POST['gender'],$_POST['firstname'],$_POST['username'],$_POST['password'],
                                    $_POST['confirm_password'],$_POST['email'],$_POST['user_type']
                                    );
                                } else {
                                    die("Something went wrong");
                                }
                                
                                    
                            } 

                          
                    } 
                                
                            
                        
               
                 

         

           

            // $msg = $validation->check_empty(
            //     $_POST,
            //     ['firstname', 'lastname', 'age', 'gender', 'username', 'password', 'confirm_password', 'email', 'user_type']
            // );






            // if ($msg != null) {
            // $errors[] =  '<div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
            //                 <strong>' . $msg . 'should not be empty</strong>
            //                 <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
            //                     <span aria-hidden="true">&times;</span>
            //                 </button>
            //             </div>';
            // } elseif($validation->check_username($_POST['username'])) {
            //         $errors[]  = '<div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
            //                                     <strong> Username is already taken </strong>
            //                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
            //                                         <span aria-hidden="true">&times;</span>
            //                                     </button>
            //                                 </div>';
            // } elseif($validation->check_email($_POST['email'])) {
            //     $errors[] = '<div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
            //                                     <strong> Email is already taken </strong>
            //                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
            //                                         <span aria-hidden="true">&times;</span>
            //                                     </button>
            //                                 </div>';
            // } elseif($validation->compare_password($_POST['password'],$_POST['confirm_password'])) {
            //         $errors[] = '<div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
            //                                                 <strong> Password is not matched </strong>
            //                                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
            //                                                     <span aria-hidden="true">&times;</span>
            //                                                 </button>
            //                                             </div>';
            // } else {

            //         $database->add_user();
            //             $errors[]    = '<div class="alert alert-success alert-dismissable fade show text-center" role="alert">
            //                         <strong> User has been added successfully </strong>
            //                         <button type="button" class="close" data-dismiss="alert" aria-label="Close" class="hidden">
            //                             <span aria-hidden="true">&times;</span>
            //                         </button>
            //                     </div>';

            //         unset($_POST['firstname'],
            //         $_POST['lastname'],
            //         $_POST['age'],
            //         $_POST['gender'],
            //         $_POST['username'],
            //         $_POST['password'],
            //         $_POST['confirm_password'],
            //         $_POST['email'],
            //         $_POST['user_type']);
                
            //     }
    
            }


?>