<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Boral | Verificar Codigo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
      <link rel="shortcut icon" href="<?php echo baseUrl();?>/public/templates/assets/images/boral.ico">

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
    height: 450px;
    background: #fff;
    margin: 20px;
    border-radius: 30px;
    box-shadow: 0 0 30px rgba(0, 0, 0, .2);
    overflow: hidden;
}

.container h1{
    font-size: 36px;
    margin: 20px 0;
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
    flex-direction: column;
}

.input-boxes{
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.input-box{
    position: relative;
    width: 50px;
}

.input-box input{
    width: 100%;
    padding: 15px;
    background: #eee;
    border-radius: 8px;
    border: none;
    outline: none;
    font-size: 16px;
    text-align: center;
    color: #333;
    font-weight: 500;
    margin-bottom: 40px;
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
    margin-bottom: 15px;
}

.small-text {
    font-size: 14px;
    color: #666;
    margin-top: 30px;
    margin-bottom: 20px;
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
        <div class="form-box verify-code">
            <form method="post" action="<?= base_url(); ?>verificarCodigo">
                <h1>Verificar Código</h1>
                <p class="small-text">Ya hemos enviado el email a <strong><?= $email; ?></strong>. Revisa tu bandeja de entrada.</p>
                <div class="input-boxes">
                    <!-- 6 Input Boxes -->
                    <div class="input-box">
                        <input type="text" id="code-1" name="codigo[]" maxlength="1" oninput="moveFocus(this, 'code-2')" onkeydown="moveFocusBackward(event, this, 'code-1')" />
                    </div>
                    <div class="input-box">
                        <input type="text" id="code-2" name="codigo[]" maxlength="1" oninput="moveFocus(this, 'code-3')" onkeydown="moveFocusBackward(event, this, 'code-1')" />
                    </div>
                    <div class="input-box">
                        <input type="text" id="code-3" name="codigo[]" maxlength="1" oninput="moveFocus(this, 'code-4')" onkeydown="moveFocusBackward(event, this, 'code-2')" />
                    </div>
                    <div class="input-box">
                        <input type="text" id="code-4" name="codigo[]" maxlength="1" oninput="moveFocus(this, 'code-5')" onkeydown="moveFocusBackward(event, this, 'code-3')" />
                    </div>
                    <div class="input-box">
                        <input type="text" id="code-5" name="codigo[]" maxlength="1" oninput="moveFocus(this, 'code-6')" onkeydown="moveFocusBackward(event, this, 'code-4')" />
                    </div>
                    <div class="input-box">
                        <input type="text" id="code-6" name="codigo[]" maxlength="1" onkeydown="moveFocusBackward(event, this, 'code-5')" />
                    </div>
                </div>
                <button type="submit" class="btn">Verificar</button>

                <!-- Small Text Below -->
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?= $error; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <script>
        // Mover al siguiente campo de entrada automáticamente al escribir
        function moveFocus(currentInput, nextInputId) {
            if (currentInput.value.length == 1) {
                document.getElementById(nextInputId).focus();
            }
        }

        // Mover al campo anterior cuando se presiona "backspace" o se borra un carácter
        function moveFocusBackward(event, currentInput, previousInputId) {
            if (event.key === "Backspace" && currentInput.value === "") {
                document.getElementById(previousInputId).focus();
            }
        }
    </script>

</body>

</html>
