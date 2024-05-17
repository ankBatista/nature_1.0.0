<template>
   <section class="curiosity-section">
      <div v-if="activeCuriosity" class="heading-wrap secondary-bg">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-6">
                  <div class="section-head white-section-head">
                     <div class="back-title">{{ activeCuriosity.title }}</div>
                     <h2 class="section-title">{{ activeCuriosity.caption }}
                        <span class="primary-color">{{ activeCuriosity.subcaption }}</span>
                     </h2>
                     <div class="section-disc">{{ activeCuriosity.description }}</div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <figure class="video-banner">
                     <img :src="urlimg + activeCuriosity.banner" alt="">
                     <div class="video-button">
                        <a id="video-container" :data-video-id="activeCuriosity.video">
                           <i class="fas fa-play"></i>
                        </a>
                     </div>
                  </figure>
               </div>
            </div>
         </div>
      </div>
      <div v-else>
         <p>Nenhuma curiosidade ativa encontrada.</p>
      </div>
   </section>
</template>

<script>
export default {
   name: 'ServicesComponent',
   props: ['dados'], // Receba os dados como uma propriedade
   data() {
      return {
         urlimg: 'http://localhost:8000/storage/',
         currentIndex: 0,
         timer: null
      }
   },
   computed: {
      filteredCuriosities() {
         return this.dados.filter(curiosity => curiosity.active === 1);
      },
      activeCuriosity() {
         return this.filteredCuriosities[this.currentIndex];
      }
   },
   mounted() {
      // Inicia o ciclo automático a cada 25 segundos
      this.timer = setInterval(this.nextCuriosity, 25000);
   },
   beforeDestroy() {
      // Limpa o temporizador quando o componente é destruído
      clearInterval(this.timer);
   },
   methods: {
      nextCuriosity() {
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