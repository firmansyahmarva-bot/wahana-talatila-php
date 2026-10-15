// @ts-check
import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';

// https://astro.build/config
export default defineConfig({
  site: 'https://wahanatotalita.com',
  trailingSlash: 'always',
  integrations: [sitemap()],
  build: {
    format: 'directory'
  },
  redirects: {
    '/pelatihan/ahli-k3-umum-surabaya/': '/pelatihan-k3-surabaya/'
  }
});

