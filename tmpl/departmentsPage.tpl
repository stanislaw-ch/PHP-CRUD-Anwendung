<div class="md:w-96 sm:w-96 w-full mx-auto p-7 mb-5 bg-white shadow-lg shadow-black-500/50">
    <form class="flex flex-col box-border" action="/departments" method="post">
        %createForm%
    </form>
</div>

<div class="md:w-96 sm:w-96 w-full mx-auto p-7 pb-10 mb-5 bg-white shadow-lg shadow-black-500/50">
    <h2 class="mb-5 text-center text-lg">Abteilungen</h2>
    <ul>
        <li class="flex content-center h-10 text-white bg-slate-700">
            <span class="flex self-center justify-center w-8">#</span>
            <span class="flex self-center justify-center flex-1">Abteilung</span>
        </li>
        %table%
    </ul>
</div>