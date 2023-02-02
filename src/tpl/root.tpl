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

<template id="department-row-form">
    <form action="departments" id="form-department" method="post" class="mb-0" data-id="">
        <div class="row-department flex flex-col p-5 shadow-lg shadow-black-500/50">
            <span id="index" class="hidden flex self-center justify-center w-8">3</span>
            <div class="w-full">
                <input type="text"
                       name="name"
                       class="
                            flex w-full self-center [appearance:textfield]
                            pl-2 grow border-b-2 border-black focus:outline-none
                            h-8 appearance-none"
                       id="name"
                />
            </div>
            <input type="hidden" name="action" value="update"/>
            <input type="hidden" name="id"/>

            <div class="flex w-full justify-end order-4">
                <button
                        id="update"
                        class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4"
                        type="button"
                >Update
                <button
                        id="delete"
                        class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4"
                        type="button"
                >Delete
                </button>
            </div>
        </div>
    </form>
</template>

<template id="employee-row-form">
    <form action="employees" id="form-employee" method="post" class="box-border relative mb-0" data-id="">
        <div class="row-department flex flex-col sm:flex-row w-full flex-wrap mx-auto p-7 shadow-lg shadow-black-500/50">
            <span id="index" class="hidden absolute left-0 top-7 flex self-center justify-center w-8">3</span>
            <div class="flex flex-col sm:flex-row sm:order-1 grow sm:w-1/3">
                <div class="mr-2 w-full">
                    <label for="firstname" class=" text-md font-medium">Vorname</label>
                    <input type="text"
                           name="firstname"
                           class="w-full border-b-2 border-black px-1 mb-5 h-8 focus:outline-none"
                           id="firstname"
                    />
                </div>
                <div class="mr-2 w-full">
                    <label for="lastname" class=" text-md font-medium">Nachname</label>
                    <input type="text"
                           name="lastname"
                           class="w-full border-b-2 border-black px-1 mb-5 h-8 focus:outline-none"
                           id="lastname"
                    />
                </div>
            </div>

            <div class="flex flex-col w-full sm:order-3 sm:basis-72 sm:w-1/3">
                <label class="block text-md font-medium">Geschlecht</label>
                <input type="hidden" name="gender_id">
                <div id="gender" class="flex mt-2 mb-5 sm:mb-0 justify-between"></div>
            </div>

            <div class="flex flex-col sm:flex-row sm:order-2 grow sm:w-1/3 ">
                <div class="mr-2 w-full">
                    <label for="salary" class=" text-md font-medium">Gehalt</label>
                    <input type="text"
                           name="salary"
                           class="w-full border-b-2 border-black px-1 mb-5 h-8 focus:outline-none"
                           id="salary"
                    />
                </div>
                <div class="w-full mr-2">
                    <label for="department" class="text-md font-medium">Abteilung</label>
                    <select name="department_id" class="w-full border-b-2 border-black mb-5 h-8 focus:outline-none">
                    </select>
                </div>
            </div>
            <input type="hidden" name="action"/>
            <input type="hidden" name="id"/>

            <div class="flex w-full justify-end order-4">
                <button
                    id="update"
                    class="w-20 h-7 mt-4 sm:mt-0 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4"
                    type="button"
                >Update
                <button
                    id="delete"
                    class="w-20 h-7 mt-4 sm:mt-0 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4"
                    type="button"
                >Delete
                </button>
            </div>
        </div>
    </form>
</template>

<template id="employee-gender">
    <div class="flex items-center">
        <input id="weiblich" type="radio" name="gender_id" value="1" class="mr-2">
        <label for="weiblich">weiblich</label>
    </div>
</template>

<template id="tip-message">
    <div id="tip-message-wrapper"
         class="
            absolute block bg-gray-200  px-2 rounded-sm -bottom-7 left-44 text-sm
            after:content-[''] after:absolute
            after:bottom-full after:left-2/4 after:-ml-12 after:border-8
            after:border-solid after:border-b-gray-200 after:border-r-transparent
            after:border-l-transparent after:border-t-transparent
    ">
        Click to change
    </div>
</template>
</body>
</html>