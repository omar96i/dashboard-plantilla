<template>
    <div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Acciones</h6>
            </div>
            <div class="card-body row text-center">
                <div class="col-12 col-sm-6 p-2">
                    <button v-bind:class="[{ 'active': select_view == 'roles'}, 'btn', 'btn-info', 'btn-sm', 'btn-block']" @click="selectView('roles')">Roles</button>
                </div>
                <div class="col-12 col-sm-6 p-2">
                    <button v-bind:class="[{ 'active': select_view == 'permisos'}, 'btn', 'btn-info', 'btn-sm', 'btn-block']" @click="selectView('permisos')">Permisos</button>
                </div>
            </div>
        </div>
        <permisos-view v-if="select_view == 'permisos'"></permisos-view>
        <role-view v-if="select_view == 'roles'"></role-view>
    </div>
</template>
<script>
import PermisoView from './PermisoView.vue'
import RoleView from './RoleView.vue'
export default {
    components:{
        'permisos-view' : PermisoView,
        'role-view' : RoleView
    },
    data(){
        return{
            select_view : 'roles'
        }
    },
    methods:{
        selectView(view){
            this.select_view = view
        },
    }
}
</script>
