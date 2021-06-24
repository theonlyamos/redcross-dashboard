<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DATA CENTER W/R</title>
     <link rel='icon' href="/red/pic/favicon.ico">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .wrapper {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: linear-gradient(90deg, rgba(2, 0, 6, 1)0%, rgba(9, 9, 121, 1)35%, rgba(0, 212, 255, 1)100%);
        }

        h2 {
            font-family: poppins;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 50px;
            font-weight: bold;
            color: red;
            text-transform: uppercase;
            margin: 0;
        }

        .box div {
            position: absolute;
            width: 60px;
            height: 60px;
            background-color: transparent;
            border: 6px solid rgba(255, 255.255, 0.8);
        }

        .box div:nth-child(1) {
            top: 12%;
            left: 42%;
            animation: animate 10s linear infinite;
        }

        .box div:nth-child(2) {
            top: 70%;
            left: 50%;
            animation: animate 7s linear infinite;
        }

        .box div:nth-child(3) {
            top: 17%;
            left: 6%;
            animation: animate 9s linear infinite;
        }

        .box div:nth-child(4) {
            top: 20%;
            left: 60%;
            animation: animate 10s linear infinite;
        }

        .box div:nth-child(5) {
            top: 67%;
            left: 10%;
            animation: animate 6s linear infinite;
        }

        .box div:nth-child(6) {
            top: 80%;
            left: 70%;
            animation: animate 12s linear infinite;
        }

        .box div:nth-child(7) {
            top: 60%;
            left: 80%;
            animation: animate 15s linear infinite;
        }

        .box div:nth-child(8) {
            top: 32%;
            left: 25%;
            animation: animate 16s linear infinite;
        }

        .box div:nth-child(9) {
            top: 90%;
            left: 25%;
            animation: animate 9s linear infinite;
        }

        .box div:nth-child(10) {
            top: 20%;
            left: 80%;
            animation: animate 5s linear infinite;
        }

        @keyframes animate {
            0% {
                transform: scale(0)translateY(0) rotate(0);
                opacity: 1;
            }

            100% {
                transform: scale(1.3)translateY(-90px) rotate(360deg);
                opacity: 0;
            }
        }

        h2 a {
            text-decoration: none;
            color: red;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <h2><a href="index.html">CLICK HERE</a></h2>
        <div class="box">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</body>

</html>
