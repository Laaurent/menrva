<section class="user-container__side px-4">
    <div class="">
        <article class="flex justify-between">
            <h5>SUGGESTIONS</h5>
            <a class="hidden xl:block" href="/">voir tout</a>
        </article>
        @for ($i = 0; $i < 3; $i++) <article class="flex justify-between items-center py-2">
            <div class="flex gap-3">
                <div class="w-12 h-12 bg-white rounded-full"></div>
                <div class="flex flex-col">
                    <h5>LOREM Ipsum</h5>
                    <span class="text-secondary">Diplome Lorem</span>
                </div>
            </div>

            <a class="no-underline" href="/profil/2">
                >
            </a>
            </article>
            @endfor
    </div>
</section>