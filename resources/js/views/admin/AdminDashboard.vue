<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-3 col-md-4 col-12">
        <SideBar :drawer ="drawer" />
      </div>
      <div class="col-lg-9 col-md-8 col-12">
        <div class="row">
          <div class="col-12">
            <TopBar  @drawer="getdrawer"/>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-10 offset-lg-1 col-md-8">
            <slot></slot>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import TopBar from "../../components/TopBar.vue";
import SideBar from "../../components/admin/AdminSideBar.vue";
export default {
  components: {
    TopBar,
    SideBar,
  },
  data(){
    return{
      drawer : false,
    };
  },
    methods: {
      getdrawer(value){
        this.drawer = value;
        
      }
    },
};
</script>

