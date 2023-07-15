<!DOCTYPE html>

<head>
    <title> Admin log in </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background: #e9eef5;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            background: #fff;
            padding: 20px;
            max-width: 330px;
            width: 100%;
            border-radius: 22px;
            box-shadow: 0px 27px 20px 0px rgba(0, 0, 0, 0.43);
            position: relative;
            overflow: hidden;
        }

        .header {
            height: 26px;
            clear: both;
        }

        h4 {
            float: left;
            font-size: 13px;
            color: #2091eb;
        }

        h3 {
            float: right;
            font-size: 20px;
            color: #e0e0e0;
        }

        form {
            margin: 48px 29px;

        }

        .label {
            color: #6a7082;
            font-size: 14px;
            font-weight: 600;
        }

        .input {
            margin-top: 17px;
        }

        .input .label p {
            display: inline-block;
        }

        .input .label i {
            display: inline-block;
        }

        .input input {
            padding: 11px;
            margin-top: 7px;
            border-radius: 3px;
            border: 1px solid #eaeef5;
            outline: none;
            background: #f5f6fa;
            width: 100%;
        }

        button {
            padding: 10px 28px;
            margin: 16px auto;
            display: block;
            background: #209ef0;
            border: none;
            color: #eee;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
        }

        .login-with {
            margin: 0 29px;
        }

        .login-with ul {
            list-style: none;
        }

        li {
            margin: 7px 38px;
        }

        .login-with ul li i,
        .login-with ul li p {
            display: inline;
            color: #6a7082;
            font-size: 13px;
        }

        ul li span {
            width: 17px;
            height: 17px;
            border: 1px solid #6a7082;
            display: inline-block;
            font-size: 12px;
            text-align: center;
            line-height: 15px;
        }

        .footer p {
            font-size: 10px;
            font-weight: 700;
            color: #848997;
            float: right;
            margin-top: 20px;
        }

        .footer p:first-child {
            float: left;
        }


        .overlayer {
            position: absolute;
            top: 0%;
            left: 0%;
            height: 100%;
            width: 100%;
            display: flex;
            background: #2091eb;
            justify-content: center;
            align-items: center;
            color: #eee;
            overflow: hidden;
        }

        .overlayer p {
            font-size: 39px;
            margin-top: 120px;
            font-weight: 800;
            text-align: center;
        }

        .overlayer {
            position: absolute;
            top: 0%;
            left: 0%;
            height: 100%;
            width: 100%;
            display: none;
            background: NONE;
            justify-content: center;
            align-items: center;
            color: #eee;
            z-index: 1;
        }

        .over {
            position: absolute;
            top: 58%;
            left: 48%;
            height: 0;
            width: 0;
            border-radius: 50%;
            background: #2091eb;
            transition: all .3s linear;
        }

        .over.active {
            top: -46px;
            left: -35%;
            height: 564px;
            width: 564px;
            border-radius: 50%;
        }

        .over.active~.overlayer {
            display: unset;
        }

        .overlayer p {
            font-size: 39px;
            margin-top: 120px;
            font-weight: 800;
            text-align: center;
        }

        i.fa.fa-close {
            margin: 150px auto;
            display: block;
            width: 50px;
            height: 50px;
            line-height: 40px;
            border: 5px solid;
            font-size: 31px;
            text-align: center;
            border-radius: 50%;
            cursor: pointer;
        }

        span.error__message {
            min-width: 280px;
            top: 15%;
            right: -100%;
            border-radius: 3px;
            display: flex;
            min-height: 40px;
            padding: 11px;
            background: red;
            position: absolute;
            z-index: 9999999;
            transform: scale(0);
            opacity: 0;
            transition: 0.5s ease-in-out;
            color: white;
        }

        span.error__message.active {
            right: 5%;
            transform: scale(1);
            opacity: 1;
        }

        span.error__message.active:before {
            content: '';
            width: 100%;
            height: 5px;
            transition: 0.5s ease-in-out;
            position: absolute;
            left: 0;
            bottom: 0;
            background: blueviolet;
            border: 5px;
            animation: increaseWidth 5.4s 0.3s linear;
        }

        @keyframes increaseWidth {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php include('./layouts/errorbar.php'); ?>
    <div class="container">
        <div class="header">
            <h4>Admin login</h4>
            <h3>Login to Continue</h3>
        </div>

        <form>
            <div class="input">
                <div class="label">
                    <p>Email</p>
                </div class="label">
                <input type="text" name="email">
            </div>
            <div class="input">
                <div class="label">
                    <p>password</p>
                </div class="label">
                <input type="password" name="password">
            </div>
            <button class="btn">Login</button>
        </form>
    </div>
    <script src="assets/js/all.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/fetch.js"></script>
    <script>
        document.querySelector('form button').onclick = (e) => {
            e.preventDefault();
            var detailsForm = new FormData(document.querySelector('form'));
            fetchData('./functions/adminauthuntication.php', detailsForm).then(res => res.text()).then(data => {
                if (data != 'Added') {
                    errorMassege(data, 'red');
                } else {
                    errorMassege('Added', 'green');
                    setTimeout(() => location.href = 'admin.php', 1500)
                }
            })
        }
    </script>
</body>

</html>