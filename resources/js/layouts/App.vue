<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <router-link :to="{ name: 'home' }" class="navbar-brand"
            >Laravel Test Backend</router-link
            >
            <button
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#navbarCollapse"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'home' }"
                        >
                            Home
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'propriedades' }"
                        >
                            Propriedades
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'contratos' }"
                        >
                            Contratos
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>

        <div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "App",
    watch: {
        $route() {
            $("#navbarCollapse").collapse("hide");
        },
    },
}
</script>

<style scoped>

</style>
