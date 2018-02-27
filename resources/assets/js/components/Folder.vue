<template>
    <div>
        <li v-for="(item, key) in menu.folders">
            <span class="folder" @click="openClose()">
                <i class="fas fa-fw fa-folder-open" v-show="opened"></i>
                <i class="fas fa-fw fa-folder" v-show="! opened"></i>
                {{ item.name }}
            </span>
            <ul class="menu tree">
                <mw-folder :menu="item.folders" 
                           v-show="opened"
                >
                </mw-folder>
            </ul>
        </li>
         <li  class="link" v-for="link in menu.links">
            <i class="fas fa-file fa-fw"></i>
            <a :href="link.url">{{ link.name }}</a>
        </li>
    </div>    
</template>

<style lang="scss">
    .folder {
        display: inline-block;
        cursor: pointer;
    }
</style>

<script>  
export default {
    name: 'mw-folder',
    props: ['menu'],
    data: function() {
        return {
            opened: false,
        };
    },
    methods: {
        isOpen: function () {
            return this.opened;
        },
        openClose: function()
        {
            this.opened = ! this.opened;
        }
    },
    mounted: function () {
        console.log(this.folders);
    },
};
</script>