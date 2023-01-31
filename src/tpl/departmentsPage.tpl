<div class="md:w-96 sm:w-96 w-full mx-auto p-7 mb-5 bg-white shadow-lg shadow-black-500/50">
    <form class="flex flex-col box-border" action="/departments" method="post">
        %createForm%
    </form>
</div>

<div class="md:w-96 sm:w-96 w-full mx-auto p-7 pb-10 mb-5 bg-white shadow-lg shadow-black-500/50">
    <h2 class="mb-5 text-center text-lg">Abteilungen</h2>
    <ul class="relative">
        <li class="flex content-center h-10 text-white bg-slate-700">
            <span class="flex self-center justify-center w-8">#</span>
            <span class="flex self-center justify-center flex-1">Abteilung</span>
            <span class="flex self-center justify-center basis-20">Anz. MA</span>
        </li>
        %table%
        <div class="
                    hidden
                    absolute block bg-gray-200  px-3 rounded-lg -bottom-8 left-32
                    after:content-[''] after:absolute
                    after:bottom-full after:left-2/4 after:-ml-14 after:border-8
                    after:border-solid after:border-b-gray-200 after:border-r-transparent
                    after:border-l-transparent after:border-t-transparent
             "
             id="tip-department"
        >Click to change</div>
    </ul>
</div>