<?php 
$username = isset($_POST['submit']) ? htmlspecialchars($_POST['username']) : 'Guest';
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #c084fc, #f472b6);
    }

    .glow-text {
      text-shadow: 0 0 10px rgba(255,255,255,0.6), 0 0 20px rgba(255,255,255,0.3);
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen text-white">

  <div class="text-center p-8 bg-white bg-opacity-10 backdrop-blur-md rounded-2xl shadow-xl">
    <h1 class="text-5xl font-bold glow-text mb-4">WELCOME,</h1>
    <p class="text-3xl font-semibold glow-text"><?php echo $username; ?> 👋</p>
    <p class="mt-6 text-lg text-pink-100">Thanks for logging in. Have a great day!</p>
  </div>

</body>
</html>
