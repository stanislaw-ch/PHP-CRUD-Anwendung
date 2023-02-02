<div class="md:w-96 sm:w-96 w-full mx-auto p-7 pb-10 mb-5 bg-white shadow-lg shadow-black-500/50">
    <h2 class="mb-5 text-center text-lg">Abteilungen</h2>
    <ul class="">
        <li class="flex content-center h-10 text-white bg-slate-700">
            <span class="flex self-center justify-center w-8">#</span>
            <span class="flex self-center basis-20 grow pl-2">Abteilung</span>
            <span class="flex self-center justify-center basis-20">Anz. MA</span>
        </li>
        %departmentsTable%
    </ul>
</div>
<div class="w-full xl:w-4/6 mx-auto mb-5 p-5 pb-10 md:p-7 md:pb-10 bg-white shadow-lg shadow-black-500/50">
    <h2 class="mb-5 text-center text-lg">Mitarbeiter</h2>
    <ul class="">
        <li class="flex content-center h-10 text-white bg-slate-700">
            <span class="flex self-center justify-center w-8 basis-10 flex-2">#</span>
            <span class="flex self-center basis-20 flex-1 pl-2">Vorname</span>
            <span class="flex self-center pl-2 basis-20 flex-1">Nachname</span>
            <span class="flex self-center basis-20 flex-1 pl-2 hidden sm:flex">Geschlecht</span>
            <span class="flex self-center basis-20 flex-1 pl-2 hidden sm:flex">Gehalt</span>
            <span class="flex self-center basis-20 flex-1 pl-2 hidden sm:flex">Abteilung</span>
        </li>
        %employeesTable%
    </ul>
</div>