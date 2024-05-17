<template>
    <!-- faq html start -->
    <section id="faq">

        <div class="faq-page-section">
            <div class="container">
                <div class="faq-page-container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="section-head">
                                <div class="back-title">FAQ</div>
                                <h2 class="section-title banner-title">Frequently Asked <span
                                        class="primary-color">Questions
                                        <svg class="title-shape" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 500 150" preserveAspectRatio="none">
                                            <path
                                                d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9">
                                            </path>
                                        </svg>
                                    </span></h2>
                                <div class="section-disc">
                                    Magna voluptatum dolorem! Dolores! Sociosqu commodo nobis imperdiet lacinia? Magni!
                                    Felis, elementum nobis imperdiet lacinia nobis imperdiet lacinia imperdiet lacinia
                                    nobis
                                    imperdiet lacinia nobis.
                                </div>
                            </div>

                            <!-- Perguntas e respostas inicio -->
                            <div>
                                <!-- Lado dos FAQs ativos -->
                                <div id="active-faqs" class="accordion-content" role="tablist">
                                    <div v-for="(faq, index) in faqsAtivos" :key="'active-' + index"
                                        class="card tab-pane" :id="'accordion-active-' + index" role="tabpanel"
                                        :aria-labelledby="'accordion-active-' + index">
                                        <div class="card-header" role="tab" :id="'qus-active-' + index">
                                            <h5 class="mb-0">
                                                <a class="collapsed" :data-bs-toggle="'collapse'"
                                                    :href="'#collapse-active-' + index" :aria-expanded="false"
                                                    :aria-controls="'collapse-active-' + index">
                                                    {{ faq.question }}
                                                </a>
                                            </h5>
                                        </div>
                                        <div :id="'collapse-active-' + index" class="collapse"
                                            :class="{ 'show': index === 0 }" :data-bs-parent="'#active-faqs'"
                                            role="tabpanel" :aria-labelledby="'qus-active-' + index">
                                            <div class="card-body">
                                                {{ faq.response }}
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <!-- Perguntas e respostas fim -->
                        </div>


                        <div class="col-lg-5">
                            <div class="qsn-form-container">
                                <h4>Any Questions? Ask Us!!</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec
                                    ullam
                                    corper</p>
                                <form>
                                    <p>
                                        <input type="text" name="name" placeholder="Your Name*">
                                    </p>
                                    <p>
                                        <input type="email" name="email" placeholder="Your Email*">
                                    </p>
                                    <p>
                                        <input type="number" name="number" placeholder="Your Number*">
                                    </p>
                                    <p>
                                        <textarea rows="8" placeholder="Enter your message"></textarea>
                                    </p>
                                    <p>
                                        <input type="submit" name="submit" value="SUBMIT MESSAGE">
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="faq-page-container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="faq-testimonial">
                                <figure class="faq-image">
                                    <img src="assets/images/img4.jpg" alt="">
                                </figure>
                                <div class="testimonial-content">
                                    <span class="quote-icon">
                                        <i class="fas fa-quote-left"></i>
                                    </span>
                                    <h4>Give Us A Chance To Prove It!</h4>
                                    <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus
                                        nec
                                        ullamcorper mattis, pulvinar dapibus leo."</p>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-7">
                            <div class="faq-content-wrap">
                                <div class="section-head">
                                    <div class="back-title">BENEFITS</div>
                                    <h2 class="section-title banner-title">Benefits & What we <span
                                            class="primary-color">do?
                                            <svg class="title-shape" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 500 150" preserveAspectRatio="none">
                                                <path
                                                    d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9">
                                                </path>
                                            </svg>
                                        </span></h2>
                                </div>

                                <!-- Lado dos FAQs inativos -->
                                <div id="inactive-faqs" class="accordion-content" role="tablist">
                                    <div v-for="(faq, index) in faqsInativos" :key="'inactive-' + index"
                                        class="card tab-pane" :id="'accordion-inactive-' + index" role="tabpanel"
                                        :aria-labelledby="'accordion-inactive-' + index">
                                        <div class="card-header" role="tab" :id="'qus-inactive-' + index">
                                            <h5 class="mb-0">
                                                <a class="collapsed" :data-bs-toggle="'collapse'"
                                                    :href="'#collapse-inactive-' + index" :aria-expanded="false"
                                                    :aria-controls="'collapse-inactive-' + index">
                                                    {{ faq.question }}
                                                </a>
                                            </h5>
                                        </div>
                                        <div :id="'collapse-inactive-' + index" class="collapse"
                                            :class="{ 'show': index === 0 }" :data-bs-parent="'#inactive-faqs'"
                                            role="tabpanel" :aria-labelledby="'qus-inactive-' + index">
                                            <div class="card-body">
                                                {{ faq.response }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</template>

<script>
export default {
    name: 'FaqComponent',
    props: ['dados'], // Receba os dados como uma propriedade

    computed: {
        faqsAtivos() {
            // Filtrar os dados para tabela da esquerda
            return this.dados.filter(item => item.active);
        },
        faqsInativos() {
            /// Filtrar os dados para tabela da direita
            return this.dados.filter(item => !item.active);
        }
    }
}
</script>

<style></style>