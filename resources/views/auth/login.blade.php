<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Discogs Login</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>

body{
    margin:0;
    background:#1f1f1f;
    font-family:'Inter',sans-serif;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.card{
    width:310px;
    background:white;
    padding:35px;
    border-radius:6px;
    margin-top:80px;
}

.logo{
    text-align:center;
    font-size:45px;
    font-weight:850;
    margin-bottom:10px;
    font-family: Arial, Helvetica, sans-serif;
}

.logo a{
    color: black;
    text-decoration: none !important;
}

.welcome{
    text-align:center;
    font-size:25px;
    margin-bottom:6%;
    margin-top:8%;
}

.subtitle{
    text-align:center;
    color:#555;
    font-size:15px;
    margin-bottom:8%;
}

.input{
    width:100%;
    padding:10px;
    margin-bottom:12px;
    border:1px solid #ccc;
    border-radius:4px;
    box-sizing:border-box;
}

/* kotak password + icon mata */
.password-box{
    position:relative;
}

.eye{
    position:absolute;
    right:10px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
}

.password-box .eye{
    position:absolute;
    right:10px;
    top:35%;
    transform:translateY(-50%);
    cursor:pointer;
}

.captcha{
    border:1px solid #ccc;
    border-radius:4px;
    padding:12px;
    display:flex;
    align-items:center;
    margin-bottom:10px;
    font-size: 15px;
}

.captcha input{
    margin-right:10px;
}

.forgot{
    font-size:13px;
    margin-bottom:15px;
}

.forgot a{
    color:#1a73e8;
    text-decoration:underlined;
}

.continue{
    width:100%;
    padding:12px;
    background:#333;
    color:white;
    border:none;
    border-radius:4px;
    font-size:15px;
    cursor:pointer;
}

.signup{
    text-align:left;
    font-size:14px;
    margin-top:15px;
}

.divider{
    display:flex;
    align-items:center;
    margin:18px 0;
    font-size:5px;
}

.divider hr{
    flex:1;
    border:none;
    border-top:1px solid #ccc;
}

.divider span{
    margin:0 10px;
    font-size:13px;
    color:#555;
}

.social{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:4px;
    background:white;
    margin-bottom:8px;
    display:flex;
    align-items:center;
    justify-content:left;
    cursor:pointer;
}

.social img{
    width:18px;
    margin-right:8px;
    border-radius:10px;
}

</style>
</head>

<body>

<div class="card">

<div class="logo">
    <a href="/welcome" class="text-3xl font-extrabold tracking-tight no-underline text-white">
        Discogs
    </a>
</div>

<div class="welcome">Welcome</div>

<div class="subtitle">Log in to Discogs to continue</div>

<form method="POST" action="/login">
@csrf

<input class="input" type="text" placeholder="Username or email address *">

<div class="password-box">
<input class="input" id="password" type="password" placeholder="Password *">
<span class="eye" onclick="togglePassword()">👁</span>
</div>

<div class="captcha">
<input type="checkbox">
<span>I'm not a robot</span>
</div>

<div class="forgot">
<a href="#">Forgot password?</a>
</div>

<button class="continue">Continue</button>
</form>

<div class="signup">
Don't have an account? <a href="/signup">Sign up</a>
</div>

<div class="divider">
<hr>
<span>OR</span>
<hr>
</div>

<div class="social">
<img src="https://cdn-icons-png.flaticon.com/512/300/300221.png">
Continue with Google
</div>

<div class="social">
<img src="https://cdn-icons-png.flaticon.com/512/0/747.png">
Continue with Apple
</div>

<div class="social">
<img src="https://cdn-icons-png.flaticon.com/512/124/124010.png">
Continue with Facebook
</div>

</div>

<script>
function togglePassword(){
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>

</body>
</html>
