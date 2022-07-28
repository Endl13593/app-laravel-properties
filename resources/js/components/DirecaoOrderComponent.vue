<template>
    <div>
        {{title}}
        <i v-show="direcao === 'desc' && orderBy === 'id'" class="el-icon-d-caret"></i>
        <i v-show="direcao === 'asc'  && orderBy === coluna"  class="el-icon-caret-top"></i>
        <i v-show="direcao === 'desc' && orderBy === coluna" class="el-icon-caret-bottom"></i>
    </div>
</template>

<script>
export default {
    name: "DirecaoOrderComponent",

    props: {
        title: {
            type: String,
            required: true
        },
        direcao: {
            type: String,
            required: true
        },
        orderBy: {
            type: String,
            required: true
        },
        coluna: {
            type: String,
            required: true
        }
    },

}
</script>
