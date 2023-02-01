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

<template id="departmentRowForm">
    <form action="departments" id="form-department" method="post" class="mb-0" data-id="">
        <li class="row-department flex h-10">
            <span id="index" class="flex self-center justify-center w-8">3</span>
            <input type="text"
                   name="name"
                   class="
                        flex self-center [appearance:textfield]
                        pl-2 mr-2 grow border-b-2 border-black focus:outline-none
                        h-8 appearance-none"
                   id="name"
            />
            <input type="hidden" name="action" value="update"/>
            <input type="hidden" name="id"/>
            <button
                    id="deleteDepartment"
                    class="ml-auto w-12 mr-1 bg-transperent hover:underline text-sm"
                    type="button"
            >Delete
            </button>
        </li>
    </form>
</template>

<template id="employeeRowForm">
    <form action="employees" id="form-employee" method="post" class="relative mb-0" data-id="">
        <li class="row-department flex flex-col grow md:w-96 sm:w-96 w-full mx-auto p-7 mb-5  shadow-lg shadow-black-500/50">
            <span id="index" class="absolute left-0 top-2 flex self-center justify-center w-8">3</span>
            <label for="firstname" class="block text-md font-medium">Vorname</label>
            <input type="text"
                   name="firstname"
                   class="border-b-2 border-black px-1 mb-5 h-8 focus:outline-none"
                   id="firstname"
            />
            <label for="lastname" class="block text-md font-medium">Nachname</label>
            <input type="text"
                   name="lastname"
                   class="border-b-2 border-black px-1 mb-5 h-8 focus:outline-none"
                   id="lastname"
            />
            <label class="block text-md font-medium">Geschlecht</label>
            <input type="hidden" name="gender_id">
            <div id="gender" class="flex mt-2 mb-5 justify-between">

            </div>
            <label for="salary" class="block text-md font-medium">Gehalt</label>
            <input type="text"
                   name="salary"
                   class="border-b-2 border-black px-1 mb-5 h-8 focus:outline-none"
                   id="salary"
            />
            <label for="department" class="block text-md font-medium">Abteilung</label>
            <select name="department_id" class="border-b-2 border-black mb-5 h-8 focus:outline-none">
            </select>
            <input type="hidden" name="action"/>
            <input type="hidden" name="id"/>

            <div class="flex w-full justify-end">
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
        </li>
    </form>
</template>

<template id="employeeGender">
    <div class="flex items-center">
        <input id="weiblich" type="radio" name="gender_id" value="1" class="mr-2">
        <label for="weiblich">weiblich</label>
    </div>
</template>
</body>
</html>