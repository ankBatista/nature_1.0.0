<template>
    <div class="progress-section" id="volunteer">
        <div class="container">
            <div class="row">
                <div v-for="(item, index) in dados" :key="index" class="col-md-6">
                    <div class="process-count-item" :class="(index % 2 === 0) ? 'secondary-bg' : 'primary-bg'">
                        <span class="process-number">{{ index + 1 }}.</span>
                        <div class="process-content">
                            <h4>{{ item.title }}</h4>
                            <p>{{ item.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CardsComponent',
    props: ['dados'] // Recebe os dados do componente pai
}
</script>
