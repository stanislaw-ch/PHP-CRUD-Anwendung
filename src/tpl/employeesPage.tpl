<div class="md:w-96 sm:w-96 w-full mx-auto p-7 mb-5 bg-white shadow-lg shadow-black-500/50">
    <form class="flex flex-col box-border" action="/employees" method="post">
        %createForm%
    </form>
</div>

<div class="w-full xl:w-4/6 mx-auto mb-5 p-5 pb-10 md:p-7 md:pb-10 bg-white shadow-lg shadow-black-500/50">
    <h2 class="mb-5 text-center text-lg">Mitarbeiter</h2>
    <ul class="relative">
        <li class="flex content-center h-10 text-white bg-slate-700">
            <span class="flex self-center justify-center w-8">#</span>
            <span class="flex self-center grow basis-40 pl-2 hidden sm:flex">Vorname</span>
            <span class="flex self-center grow basis-40 pl-2">Nachname</span>
            <span class="flex self-center grow basis-40 pl-2 hidden lg:flex">Geschlecht</span>
            <span class="flex self-center grow basis-40 pl-2 hidden sm:flex">Gehalt</span>
            <span class="flex self-center grow pl-2 basis-40">Abteilung</span>
        </li>
        %table%
        <div class="
                    hidden
                    absolute block bg-gray-200  px-3 rounded-lg -bottom-8 left-72
                    after:content-[''] after:absolute
                    after:bottom-full after:left-2/4 after:-ml-14 after:border-8
                    after:border-solid after:border-b-gray-200 after:border-r-transparent
                    after:border-l-transparent after:border-t-transparent
             "
             id="tip-employee"
        >Click to change</div>
    </ul>
</div>