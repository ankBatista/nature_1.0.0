<template>
  <div>
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div ref="toast" :class="['toast', statusClass]" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="" class="rounded me-2" alt="">
          <strong class="me-auto">{{ getPropertyValue('title') }}</strong>
          <small>{{ getPropertyValue('status') }}</small>
          <button type="button" class="btn-close" @click="hideToast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          {{ getPropertyValue('content') }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ToastComponent',
  props: ['dadosToast'],
  methods: {
    getPropertyValue(key) {
      // Encontra o objeto que contém a propriedade desejada
      const obj = this.dadosToast.find(item => item.hasOwnProperty(key));
      // Retorna o valor da propriedade
      return obj ? obj[key] : '';
    },
    showToast() {
      const toastElement = this.$refs.toast;
      const toast = new bootstrap.Toast(toastElement);
      toast.show();
    },
    hideToast() {
      const toastElement = this.$refs.toast;
      const toast = bootstrap.Toast.getInstance(toastElement);
      toast.hide();
    }
  },
  computed: {
    statusClass() {
      // Define a classe com base no status
      return {
        'bg-success': this.getPropertyValue('status') === 'success',
        'bg-danger': this.getPropertyValue('status') === 'danger',
        'bg-warning': this.getPropertyValue('status') === 'alert'
      };
    }
  }
};
</script>
