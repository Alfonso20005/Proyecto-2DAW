<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | Boral</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo baseUrl();?>/public/templates/assets/images/boral.ico">

    <!-- App css -->
    <link href="<?php echo baseUrl();?>/templates/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo baseUrl();?>/templates/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo baseUrl();?>/templates/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    text-decoration: none;
    list-style: none;
}

body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #c9ffcc;
}

.container{
    position: relative;
    width: 450px;
    height: 425px;
    background: #fff;
    margin: 20px;
    border-radius: 30px;
    box-shadow: 0 0 30px rgba(0, 0, 0, .2);
    overflow: hidden;
}

.container h1{
    font-size: 36px;
    margin: -10px 0;
}

form{
    width: 100%;
}

.form-box{
    position: absolute;
    right: 0;
    width: 100%;
    height: 100%;
    background: #fff;
    display: flex;
    align-items: center;
    color: #333;
    text-align: center;
    padding: 40px;
}

.input-box{
    position: relative;
    margin: 30px 0;
}

.input-box input{
    width: 100%;
    padding: 13px 50px 13px 20px;
    background: #eee;
    border-radius: 8px;
    border: none;
    outline: none;
    font-size: 16px;
    color: #333;
    font-weight: 500;
}

.input-box input::placeholder{
    color: #888;
    font-weight: 400;
}

.input-box i{
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
}

.btn{
    width: 100%;
    height: 48px;
    background: #78ec74;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: #fff;
    font-weight: 600;
}

.social-icons {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.social-icons a {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    color: #333;
    text-decoration: none;
    background-color: #fff;
    transition: background-color 0.3s ease;
}

.social-icons a:hover {
    background-color: #f5f5f5;
}

.social-icons i {
    font-size: 20px;
    margin-right: 10px;
}

@media screen and (max-width: 650px){
    .container{ height: calc(100vh - 40px); }

    .form-box{
        bottom: 0;
        width: 100%;
        height: 70%;
    }
}

@media screen and (max-width: 400px){
    .form-box { padding: 20px; }
}
        
        

    </style>
</head>

<body>

    <div class="container">
          <div class="form-box login">
            <form method="post" action="<?php echo baseUrl();?>/SiginController/loginAuth">
                  <h1>Iniciar Sesion</h1>
                <?php if (!empty(validation_errors())): ?>
                <br>
                                <div class="alert alert-danger">
                                
                                        <?php foreach (validation_errors() as $error): ?>
                                            <span><?= esc($error); ?></span>
                                <br>
                                        <?php endforeach; ?>
                                    
                                </div>
                            <?php endif; ?>
                  <div class="input-box">
                      <input type="text" id="username" placeholder="Username" name="username" value="<?= set_value('username'); ?>">
                      <i class='bx bxs-user'></i>
                  </div>
                  <!-- Formulario de Login -->
                <div class="input-box">
                    <input type="password" id="password" placeholder="Password" name="password" />
                    <i class='bx bxs-lock-alt' id="lock-icon-login" style="cursor: pointer;"></i>
                    <i class='bx bxs-lock-open-alt' id="unlock-icon-login" style="display: none; cursor: pointer;"></i>
                </div>
                  <button type="submit" class="btn">Iniciar Sesion</button>
                 
              </form>
          </div>
      </div>


    <!-- Vendor js -->
    <script src="<?php echo baseUrl();?>/templates/assets/js/vendor.min.js"></script>

    <script>
        const loginPasswordInput = document.getElementById('password');
const lockIconLogin = document.getElementById('lock-icon-login');
const unlockIconLogin = document.getElementById('unlock-icon-login');

let loginPasswordVisible = false;

lockIconLogin.addEventListener('click', function() {
    loginPasswordInput.type = 'text';  // Mostrar el password
    lockIconLogin.style.display = 'none';  // Ocultar candado cerrado
    unlockIconLogin.style.display = 'block';  // Mostrar candado abierto
    loginPasswordVisible = true;  // Marcamos como visible
});

unlockIconLogin.addEventListener('click', function() {
    loginPasswordInput.type = 'password';  // Cambiar a tipo password
    unlockIconLogin.style.display = 'none';  // Ocultar candado abierto
    lockIconLogin.style.display = 'block';  // Mostrar candado cerrado
    loginPasswordVisible = false;  // Marcamos como oculto
});

    
    </script>
</body>

</html>
