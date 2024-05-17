<template>
   <section class="service-section">
      <div class="service-item-inner">
         <div class="container">
            <div class="row">
               <!-- Iterar sobre os dados para criar cards dinamicamente -->
               <div class="col-sm-6 col-md-3" v-for="(item, index) in dados" :key="index">
                  <div class="service-item">
                     <figure class="service-icon">
                        <img :src="urlimg + item.icon" alt="">
                     </figure>
                     <div class="service-content">
                        <h4>{{ item.title }}</h4>
                        <p>{{ limit(item.content) }}</p>

                        <!-- Correção: Remova o ++ do :data-bs-target -->
                        <button type="button" class="button-round-primary" data-bs-toggle="modal"
                           :data-bs-target="'#modalShow-' + index">
                           SAIBA MAIS
                        </button>
                     </div>
                     <!-- Inicio Modal Saiba mais -->
                     <div class="modal fade" :id="'modalShow-' + index" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content ">
                              <div class="modal-body">
                                 <div class="service-content mt-2">
                                    <h4>{{ item.title }}</h4>
                                    <p>{{ item.content }}</p>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- fim do modal Saiba Mais -->

                  </div>
               </div>
               <!-- Fim do loop -->
            </div>
         </div>
      </div>
   </section>
</template>

<script>
export default {
   name: 'ServicesComponent',
   props: ['dados'],// Receba os dados como uma propriedade
   data() {
      return {
         urlimg: 'http://localhost:8000/storage/',
      }
   },
   methods: {
      limit(conteudo) {
         if (conteudo.length > 50) {
            return conteudo.slice(0, 50) + '...'; // Limita o conteúdo a 50 caracteres e adiciona reticências
         }
         return conteudo; // Retorna o conteúdo sem alterações se for menor ou igual a 50 caracteres
      }
   }
}
</script>

<style></style>
