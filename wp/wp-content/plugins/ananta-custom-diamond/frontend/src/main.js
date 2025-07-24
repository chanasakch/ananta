import { createApp } from 'vue';
import DiamondSelector from './components/DiamondSelector.vue'; // ✅ ใช้ชื่อใหม่

document.addEventListener('DOMContentLoaded', () => {
  const mountEl = document.createElement('div');
  mountEl.id = 'diamond-selector-app';
  document.querySelector('form.cart')?.prepend(mountEl);

  if (document.getElementById('diamond-selector-app')) {
    const app = createApp(DiamondSelector);
    app.mount('#diamond-selector-app');
  }
});
