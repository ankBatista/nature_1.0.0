<template>
  <section class="contact-section" style="background-image: url(assets/images/img5.jpg);" id="contact">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="section-head white-section-head">
                            <div class="back-title">FALE CONOSCO</div>
                            <h2 class="section-title">Caso ainda tenha duvidas entre em contato com a <span
                                    class="primary-color">NC Coin!
                                    <svg class="title-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150"
                                        preserveAspectRatio="none">
                                        <path
                                            d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9">
                                        </path>
                                    </svg>
                                </span>
                            </h2>
                            <div class="section-disc">
                                Abaixo veja nossos videos de publicidade, talvez possa lhe responder algumas duvidas e
                                mesmo
                                assim, caso ainda tenha duvidas entre em contato conosco.
                            </div>
                        </div>
                        <div class="video-button">
                            <a id="video-container-two" data-video-id="IUN664s7N-c">
                                <i class="fas fa-play"></i>
                            </a>
                            <span>VER VIDEOS</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="home-contact-form">
                            <form method="post" action="includes/mail.php" id="contact-form" class="contact-form row"
                                novalidate>
                                <div class="col-12 mb-4">
                                    <input type="text" id="fname" name="fullName" required class="form-control"
                                        placeholder="Nome Completo / Full Name*">
                                </div>
                                <div class="col-12 mb-4">
                                    <input type="email" id="email" name="emailAddress" required class="form-control"
                                        placeholder="E-mail*">
                                </div>
                                <div class="col-sm-12 mb-4">
                                    <input type="text" id="subject" name="subject" required class="form-control"
                                        placeholder="Assunto / Subject">
                                </div>
                                <div class="col-sm-12 mb-4">
                                    <input type="tel" id="phone" name="phoneNumber" class="form-control"
                                        placeholder="+1-202-555-0127">
                                </div>
                                <div class="col-sm-12 mb-4">
                                    <textarea name="message" id="message" required cols="30" rows="4"
                                        class="form-control" placeholder="Hello!"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="button-round-secondary">ENVIAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay"></div>
        </section>
</template>

<script>
export default {
name:'ContactComponent'
}
</script>

<style>

</style>