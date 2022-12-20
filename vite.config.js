import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

import * as dotenv from 'dotenv'
import fs from 'fs'

dotenv.config()

const devPort = 3030;
const devHost = 'localhost'

// Generate .env file in DEV mode.
if ('dev' === process.env.NODE_ENV) {
    const env = `ENV_MODE='dev' \nDEV_PORT=${devPort} \nDEV_SERVER=http://${devHost}:${devPort}/`
    fs.writeFile('.env', env, (error) => {
        if (error) {
            console.error(error)
        }
    })
} else {
    fs.unlink('.env', (error) => {
        if (error) {
            console.error(error)
        }
    })
}

export default defineConfig({
    base: 'dev' === process.env.NODE_ENV ?  '/wp-content/plugins/boilerplate-plugin/' : './',
    plugins: [
        vue(),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./src', import.meta.url)),
            'vue': 'vue/dist/vue.esm-bundler.js',
        }
    },
    build: {
        outDir: 'build',
        emptyOutDir: true,
        rollupOptions: {
            input: [
                'src/main.js',
            ],
            output: {
                chunkFileNames: '[name].js',
                entryFileNames: '[name].js',
                assetFileNames: ({ name }) => {
                    if (/\.css$/.test(name ?? '')) {
                        return '[name][extname]';
                    }

                    return '[name][extname]';
                },
            }
        },
    },
    server: {
        port: devPort,
        strictPort: true,
        hmr: {
            host: devHost,
            port: devPort,
            protocol: 'ws',
        }
    }
})
