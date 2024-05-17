<template>
   <!-- home banner section html start -->
   <section v-if="activebanner" class="home-banner"
      :style="{ 'background-image': 'url(' + urlimg + activebanner.banner + ')' }">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 offset-lg-2">
               <div class="banner-content text-center">
                  <div class="section-head">
                     <div class="back-title">{{ activebanner.title }}</div>
                     <h2 class="section-title banner-title"><span class="primary-color"> {{ activebanner.caption }}
                           <svg class="title-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150"
                              preserveAspectRatio="none">
                              <path
                                 d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9">
                              </path>
                           </svg>
                        </span></h2>
                  </div>
                  <div class="banner-text">
                     <p>{{ activebanner.content }}</p>
                  </div>

               </div>
            </div>
         </div>
      </div>
      <div class="overlay"></div>
   </section>
</template>

<script>
export default {
   name: 'BannerComponent',
   props: ['dados'], // Receba os dados como uma propriedade
   data() {
      return {
         currentIndex: 0,
         timer: null,
         urlimg: import.meta.env.VITE_APP_API_URL + '/storage/',
      }
   },
   computed: {
      filteredCuriosities() {
         return this.dados.filter(banner => banner.active === 1);
      },
      activebanner() {
         return this.filteredCuriosities[this.currentIndex];
      }
   },
   mounted() {
      // Inicia o ciclo automático a cada 25 segundos
      this.timer = setInterval(this.nextbanner, 25000);
   },
   beforeDestroy() {
      // Limpa o temporizador quando o componente é destruído
      clearInterval(this.timer);
   },
   methods: {
      nextbanner() {
         if (this.currentIndex < this.filteredCuriosities.length - 1) {
            this.currentIndex++;
         } else {
            this.currentIndex = 0; // Volta para o primeiro item
         }
      }
   }
}
</script>

<style></style>
