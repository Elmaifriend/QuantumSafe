<nav
    x-data="{ displayMenu: false }"
    class="z-50 bg-glass relative flex w-full items-center justify-center p-8 shadow-2xl backdrop-blur-lg"
>
    <div class="container flex items-center justify-between">
        <ul
            x-show="displayMenu"
            x-cloak
            x-on:click.outside="displayMenu = false"
            x-transition
            class="lg:hidden bg-glass divide-secondary/20 absolute left-1/2 top-[120%] w-11/12 -translate-x-1/2 gap-6 divide-y rounded-2xl p-4 backdrop-blur-lg"
        >
            <div class="divide-secondary/20 flex flex-col gap-4 divide-y py-4">
                <h1 class="text-headline-large px-2 py-4 lg:hidden">QuantumSafe</h1>
                <li class="px-2 py-4">
                    <x-button.text href="{{ route('home') }}" class="text-xl">Inicio</x-button.text>
                </li>
                <li class="px-2 py-4">
                    <x-button.text href="#" class="text-xl">Nosotros</x-button.text>
                </li>
                <li class="px-2 py-4">
                    <x-button.text href="#" class="text-xl">Precios</x-button.text>
                </li>
                <li class="px-2 py-4">
                    <x-button.text href="#" class="text-xl">FAQ</x-button.text>
                </li>
                <li class="px-2 py-4">
                    <x-button.text href="#" class="text-xl">Politicas</x-button.text>
                </li>
            </div>
        </ul>
        <ul class="hidden lg:flex p-4 w-fit divide-x divide-secondary/20">
            <div class="divide-secondary/20 flex gap-4 flex-row divide-y-0 px-4 py-0">
                <li class="px-0 py-0">
                    <x-button.text href="{{ route('home') }}" class="text-body-small">Inicio</x-button.text>
                </li>
                <li class="px-0 py-0">
                    <x-button.text href="" class="text-body-small">Nosotros</x-button.text>
                </li>
                <li class="px-0 py-0">
                    <x-button.text href="" class="text-body-small">Precios</x-button.text>
                </li>
                <li class="px-0 py-0">
                    <x-button.text href="" class="text-body-small">FAQ</x-button.text>
                </li>
                <li class="px-0 py-0">
                    <x-button.text href="" class="text-body-small">Politicas</x-button.text>
                </li>
            </div>
        </ul>
        <div class="flex flex-row-reverse items-center gap-4 lg:flex-row">
            <x-button href="#">
                Ingresar
            </x-button>
        </div>
        <x-button.text x-on:click="displayMenu = !displayMenu" class="text-headline-medium lg:hidden">
            <i class="bx bx-menu"></i>
        </x-button.text>
    </div>
</nav>
