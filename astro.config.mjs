// @ts-check
import { defineConfig } from 'astro/config';

// https://astro.build/config
export default defineConfig({
  site: 'https://wahanatotalita.com',
  trailingSlash: 'always',
  build: {
    format: 'directory'
  },
  redirects: {
    '/pelatihan/ahli-k3-umum-surabaya/': '/pelatihan-k3-surabaya/'
  }
});
