<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <x-dashboard.sideList :active="request()->routeIs('dashboard.index')" title="Dashboard" icon="fas fa-columns" :href="route('dashboard.index')" />
            <x-dashboard.sideList :active="request()->routeIs('dashboard.categories.*')" title="Categories" icon="fa-solid fa-boxes-stacked" :href="route('dashboard.categories.index')" />

            <x-dashboard.sideList :active="request()->routeIs('dashboard.hightlight.*')" title="Hightlight Product" icon="fas fa-highlighter" :href="route('dashboard.hightlight.index')" />

            <div class="my-4 mt-5 border-t-2 border-slate-300 py-2 pb-3">
                <p class="uppercase text-slate-400 text-heading text-sm">products</p>
                <x-dashboard.sideList :active="request()->routeIs('dashboard.products.index')" title="Products" icon="fa-solid fa-box-open" :href="route('dashboard.products.index')" />
                <x-dashboard.sideList :active="request()->routeIs('dashboard.products.draft')" title="Products Draft" icon="fa-brands fa-dropbox" :href="route('dashboard.products.draft')" />
            </div>

        </ul>
    </div>
</aside>
