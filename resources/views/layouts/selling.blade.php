<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Selling</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<style>
.hero{
    position: relative;
    height: 600px;
    background-image: url('quotes.jpg');
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
}
.overlay{
    position: absolute;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.6);
}
.hero-content{
    position: relative;
    text-align: center;
    color: white;
}
.quote{
    font-size: 120px;
    color: #f4d03f;
    font-weight: bold;
    margin-bottom:-30px
}
.sell-btn{
    background-color: black;
    color: white;
    padding: 14px 30px;
    font-size: 16px;
    cursor: pointer;
}
.sell-btn:hover{
    background-color: #333;
}

</style>

<body class="bg-gray-100 font-[Inter]">

    @include('components.navbar')
    @include('components.navSell')

    <main>
        @yield('content')
    </main>

    @include('components.footerSubs')
    @include('components.footer')

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>