<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Seznam switchů Kovolit, a.s.</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@300&display=swap');

        body {
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            color: #333;
            font-weight: 300;
        }
        .brand {
            margin-bottom: 20px;
        }
        .brand h2 {
            font-weight: 300;
            color: #555;
        }
        .model {
            margin-left: 20px;
        }
        .model h3 {
            font-weight: 300;
            color: #666;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background: #fff;
            margin: 10px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        .printer-info {
            margin-left: 10px;
        }
        .printer-info span {
            font-weight: bold;
        }
        .status {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .online {
            background-color: green;
        }
        .offline {
            background-color: red;
        }
        .unknown {
            background-color: gray;
        }
        .ip-link {
            color: #007bff;
            text-decoration: none;
        }
        .ip-link:hover {
            text-decoration: underline;
        }
		.mac-address {
			font-family: monospace;
			color: #777;
		}
		li.offline {
			background-color: #f5f5f5;
		}
        #loader {
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 1000;
        }
        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        #content {
            display: none;
            max-width: 1000px;
            margin: 100px auto 20px auto;
        }
    </style>
</head>
<body>

<div id="loader">
    <h1>Seznam switchů Kovolit, a.s.</h1>
    <div class="spinner"></div>
</div>

<div id="content"></div>

<script>
    window.onload = function () {
        fetch('load_data.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById("loader").style.display = "none";
                const content = document.getElementById("content");
                content.innerHTML = data;
                content.style.display = "block";
            });
    };
</script>

</body>
</html>
