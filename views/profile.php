 <?php
    if ($user->avatar_path) {
        $avatar_path = $user->avatar_path;
    } else {
        $avatar_path = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email)));
    }

    $subscription = $user->subscription();

    // Check if subscription is active
    $hasActiveSubscription = $subscription && $subscription->isActive();

    ?>

 <!doctype html>
 <html>

 <head>
     <meta charset='utf-8'>
     <meta name='viewport' content='width=device-width, initial-scale=1'>
     <title>Profile of <?= htmlspecialchars($user->username) ?></title>
     <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet'>
     <style>
         .container {
             height: 100vh;
         }

         .card {

             width: 380px;
             border: none;
             border-radius: 15px;
             padding: 8px;
             background-color: #fff;
             position: relative; 
         }

         .upper {

             height: 100px;

         }

         .upper img {

             width: 100%;
             border-top-left-radius: 10px;
             border-top-right-radius: 10px;

         }

         .user {
             position: relative;
         }

         .profile img {


             height: 80px;
             width: 80px;
             margin-top: 2px;


         }

         .profile {

             position: absolute;
             top: -50px;
             left: 38%;
             height: 90px;
             width: 90px;
             border: 3px solid #fff;

             border-radius: 50%;

         }

         .follow {

             border-radius: 15px;
             padding-left: 20px;
             padding-right: 20px;
             height: 35px;
         }

         .stats span {

             font-size: 29px;
         }

         body {
             background-color: #545454;
             font-family: "Poppins", sans-serif;
             font-weight: 300;
         }
     </style>
 </head>

 <body>
     <div class="container d-flex justify-content-center align-items-center">

         <div class="card">



             <div class="user text-center">
                 <div class="profile">
                     <img src="<?= htmlspecialchars($avatar_path) ?>" class="rounded-circle" width="80">
                 </div>
             </div>

             <div class="mt-5 text-center">
                 <h4 class="mb-0"><?= htmlspecialchars($user->username) ?></h4>
                 <span class="mb-0  follow" ><?= htmlspecialchars($user->role()->name) ?></span>
                 <span class="text-muted d-block mb-2"><?= htmlspecialchars($user->email) ?></span>
                 <a class="btn btn-danger btn-sm follow" href="/logout">logout</a>
             </div>
             <div class="mt-4 text-center">
                 <h5>Update Avatar</h5>
                 <form action="/update-avatar" method="POST" enctype="multipart/form-data">
                     <div class="mb-2">
                         <input type="file" name="avatar" required>
                     </div>
                     <input type="submit" class="btn btn-primary btn-sm" value="Upload New Avatar">
                 </form>
             </div>

             <div class="mt-4 text-center">
                 <h5>Subscription Status</h5>
                 <?php if ($hasActiveSubscription) : ?>
                     <p class="text-success">Active</p>
                     <p>Expiry Date: <?= htmlspecialchars($subscription->expiry_date) ?></p>
                     <a class="btn btn-danger btn-sm" href="/unsubscribe">Unsubscribe</a>
                 <?php else : ?>
                     <p class="text-danger">Expired or No Subscription</p>
                     <a class="btn btn-warning btn-sm" href="/subscribe">Subscribe Now</a>
                 <?php endif; ?>
             </div>

             <!-- if admin can manage access -->
             <?php if ($user->isAdmin()) : ?>
                 <div class="mt-4 text-center">
                     <h5>Manage Access</h5>
                     <a class="btn btn-primary btn-sm" href="/manage_roles">Manage Roles</a>
                 </div>
             <?php endif; ?>

             <?php if (!empty($data['error'])) : ?>
                 <div class="error-message-box">
                     <div class="error-message"><?php echo $data['error']; ?></div>
                 </div>
             <?php endif; ?>
             <?php if (!empty($data['success'])) : ?>
                 <div class="success-message-box">
                     <div class="success-message"><?php echo $data['success']; ?></div>
                 </div>
             <?php endif; ?>


         </div>

     </div>
 </body>

 </html>