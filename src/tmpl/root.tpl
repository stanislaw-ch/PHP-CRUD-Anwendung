<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>%title%</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 flex flex-col min-h-screen">
<nav class="bg-white mb-5">
    <div class="">
        <ul class="flex justify-center">
            <li>
                <a href="/"
                   class="py-3.5 px-6 inline-block hover:bg-gray-300 font-medium %isActiveMain%">Home</a>
            </li>
            <li>
                <a href="employees"
                   class="py-3.5 px-6 inline-block hover:bg-gray-300 font-medium %isActiveEmployee%">Mitarbeiter</a>
            </li>
            <li>
                <a href="departments"
                   class="py-3.5 px-6 inline-block hover:bg-gray-300 font-medium %isActiveDepartment%">Abteilungen</a>
            </li>
        </ul>
    </div>
</nav>

%middle%

<footer class="flex flex-col bg-slate-700 h-20 mt-auto justify-center">
    <a href="https://github.com/stanislaw-ch/PHP-CRUD-Anwendung" target=”_blank”
       class="self-center hover:underline hover:underline-offset-4 text-white">GitHub</a>
</footer>
<script src="/src/assets/js/main.js"></script>
</body>
</html>