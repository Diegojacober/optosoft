<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Optosoft</title>
    <link rel="stylesheet" href="{{ URL::asset('css/index.css') }}">
    <!-- CSS only -->
<link rel="shortcut icon" href="{{ URL::asset('images/icon.svg') }}" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/brands.min.css" integrity="sha512-OivR4OdSsE1onDm/i3J3Hpsm5GmOVvr9r49K3jJ0dnsxVzZgaOJ5MfxEAxCyGrzWozL9uJGKz6un3A7L+redIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/regular.min.css" integrity="sha512-YoxvmIzlVlt4nYJ6QwBqDzFc+2aXL7yQwkAuscf2ZAg7daNQxlgQHV+LLRHnRXFWPHRvXhJuBBjQqHAqRFkcVw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/solid.min.css" integrity="sha512-qzgHTQ60z8RJitD5a28/c47in6WlHGuyRvMusdnuWWBB6fZ0DWG/KyfchGSBlLVeqAz+1LzNq+gGZkCSHnSd3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/svg-with-js.min.css" integrity="sha512-U7WyVKwgyoYSa+qowujpUQIH3omU6SlFFr8m6kiEuuM1lWqoiURgTNskMFEf1la4PDNQzMws/G1u0wKGNxVbcQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/v4-font-face.min.css" integrity="sha512-6G7jwBgoDnShmGCEha+LlzpMNWBHhGYZ6QCHfIXlaHoX9X5eunFwUZRYj8WSaooev6DIWqQXZ6syn2yup6kGZg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/v5-font-face.min.css" integrity="sha512-wVffp1z2cYYhxt8nhif5UsMu415VRqX2CkMeWg5lYyrcpFBLfoMQ6ngVSJG8BumKBl83wf2bMRDwVmTgfoDovQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="text-center text-white " style="background:linear-gradient(180deg,#1363DF 36%,#DFF6FF 64%) ;">
    
    <section class="cover-container">

        <div class="d-flex w-100 h-100 p-3 mgt mx-auto flex-column align-items-center fundo">
            <main class="px-3">
                <h1 id="logo">Optosoft</h1>
                <p class="fnt">Tenha o controle de seus clientes e receitas onde quiser!</p>
                <div class="row">
                    <div class="col-6">
                            <a href="#" style="background-color: #47B5FF;width: 100%" class="btn btn-lg fw-bold text-light"> Adquirir!</a>
                    </div>
    
                    <div class="col-6">
                            <a href="{{route('login')}}" style="background-color: #06283D;width: 100%" class="btn btn-lg fw-bold text-light"><i class="fa-solid fa-arrow-right-to-bracket"></i> Entrar</a>
                    </div>
                </div>
                
              </main>            
        </div>

        <div class="division w-100"></div>

        <div class="info w-100">
           <div class="info1">
                <div class="info--text">
                    <h6>Software especializado para optometristas.</h6>

                    <h3>Além de prescrições, Anmeneses completas e Atestados, O sistema Optosoft oferece funções incriveis,
                    é possível ter o controle de todos seus clientes, agendamentos, sistema financeiro e muito mais.
                    O sistema é totalmente online, armazenado na nuvem, permitindo uma velocidade incrível e acesso 
                    de <b>QUALQUER LUGAR</b>.</h3>
                </div>
                <div class="info--box">
                    <div class="box">
                        <i class="fa-solid fa-print fa-2x"></i>
                        <p>Impressão de prescrições</p>
                    </div>

                    <div class="box">
                        <i class="fa-solid fa-calendar-days fa-2x"></i>
                        <p>Agendamento Rápido</p>
                    </div>

                    <div class="box">
                        <i class="fa-solid fa-coins fa-2x"></i>
                        <p>Controle Financeiro</p>
                    </div>

                    <div class="box">
                        <i class="fa-solid fa-cloud fa-2x"></i>
                        <p>Arquivos na nuvem</p>
                    </div>
                </div>
           </div>
        </div>
    

    </section>
   

    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/brands.min.js" integrity="sha512-KGeeDLRAGeJZYsq3J/4s/X6eZyaxTAlScSN2b7z/H/r2MBZ3pAg4T52SzavEJa2Uthmll5HMhvRaLeuxT76EVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js" integrity="sha512-5qbIAL4qJ/FSsWfIq5Pd0qbqoZpk5NcUVeAAREV2Li4EKzyJDEGlADHhHOSSCw0tHP7z3Q4hNHJXa81P92borQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/regular.min.js" integrity="sha512-eH31QC2/CLTAQpugtCMQh/w68mbefCbaDTsSbmqOk86RICy523PnuNMaFfQ5cAkwwJ1dsnn7OUt8bfkF24zprg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/solid.min.js" integrity="sha512-C92U8X5fKxCN7C6A/AttDsqXQiB7gxwvg/9JCxcqR6KV+F0nvMBwL4wuQc+PwCfQGfazIe7Cm5g0VaHaoZ/BOQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/v4-shims.min.js" integrity="sha512-jV9c9TgJKs4VzfA+DtPAXJqOMs0gsEmfhKEgtT4TqE7SPjwXiDmtDKsh1FXIPX/gDFcckXaVB7xNKD+LIS5GmA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>