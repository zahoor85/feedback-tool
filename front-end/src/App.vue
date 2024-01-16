
<template>
  <div id="app" class="min-h-screen bg-gray-100 relative">
    <Loader />
    <Nav />
    <router-view />
    
  </div>
</template>

<script>

import Loader from './components/Loader.vue';
import Nav from './components/Nav.vue';

export default {
  name: "App",
  components: {
    Loader,
    Nav
}
}

</script>
