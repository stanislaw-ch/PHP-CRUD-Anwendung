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
<script type="module" src="/src/assets/js/main.js"></script>

<template id="departmentRow">
    <form action="departments" name="form" id="form" method="post" class="mb-0">
        <li class="
                row-department
                flex h-10

                "
        >
            <span id="index" class="flex self-center justify-center w-8">3</span>
            <input type="text"
                   name="name"
                   class="
                        flex self-center [appearance:textfield]
                        pl-2 mr-2 grow border-b-2 border-black focus:outline-none
                        h-8 appearance-none"
                   id="name"
            />
            <input type="hidden" name="action"  value="update" />
            <input type="hidden" name="id"/>

            <button
                    id="deleteDepartment"
                    class="
                            ml-auto
                            w-12 mr-1
                            bg-transperent hover:underline text-sm
                        "
                    type="button"
            >Delete
            </button>
            </li>
    </form>
</template>


<template id="departmentRow1">
        <li class="
                row-department
                flex h-10

                "
        >
            <span id="index" class="flex self-center justify-center w-8">3</span>
            <span id="name" class="flex self-center grow pl-2"></span>
            <span id="amount-employees" class="flex self-center justify-center basis-20"></span>
            <input id="id" type="hidden" name="id"/>
        </li>
</template>
</body>
</html>