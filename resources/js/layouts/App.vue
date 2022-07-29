<template>
    <div>
        <header class="bg-indigo-600">
            <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="w-full py-4 flex items-center justify-between border-b border-indigo-500 lg:border-none">
                    <div class="flex items-center">
                        <router-link
                            :to="{ name: 'home' }"
                        >
                            <img class="h-10 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=white" alt=""></img>
                        </router-link>
                        <div class="hidden ml-10 space-x-8 lg:block">
                            <router-link
                                class="text-base font-medium text-white hover:text-gray-300"
                                :to="{ name: 'home' }"
                            >
                                <span v-if="$route.name === 'home'" class="font-extrabold text-gray-200">Home</span>
                                <span class="hover:text-gray-200" v-else>Home</span>
                            </router-link>
                            <router-link
                                class="text-base font-medium text-white hover:text-gray-300"
                                :to="{ name: 'propriedades' }"
                            >
                                <span v-if="$route.name === 'propriedades'" class="font-extrabold text-gray-200">Propriedades</span>
                                <span class="hover:text-gray-200" v-else>Propriedades</span>
                            </router-link>
                            <router-link
                                class="text-base font-medium text-white hover:text-gray-300"
                                :to="{ name: 'contratos' }"
                            >
                                <span v-if="$route.name === 'contratos'" class="font-extrabold text-gray-300">Contratos</span>
                                <span class="hover:text-gray-200" v-else>Contratos</span>
                            </router-link>
                        </div>
                    </div>
                    <div class="ml-10 flex">
                        <span class="text-base font-medium text-white">Eduardo Nunes</span>
                        <div class="text-base font-medium text-white cursor-pointer ml-6 hover:text-gray-300">
                            <span><i class="el-icon-circle-close"></i> Sair</span>
                        </div>
                    </div>
                </div>
                <div class="py-4 flex flex-wrap justify-center space-x-6 lg:hidden">
                    <router-link
                        class="text-base font-medium text-white hover:text-indigo-50"
                        :to="{ name: 'home' }"
                    >
                        Home
                    </router-link>
                    <router-link
                        class="text-base font-medium text-white hover:text-indigo-50"
                        :to="{ name: 'propriedades' }"
                    >
                        Propriedades
                    </router-link>
                    <router-link
                        class="text-base font-medium text-white hover:text-indigo-50"
                        :to="{ name: 'contratos' }"
                    >
                        Contratos
                    </router-link>
                </div>
            </nav>
        </header>

        <main>
            <div class="container mx-auto py-4">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>

<script>
export default {
    name: "App",
}
</script>

<style scoped>

</style>
