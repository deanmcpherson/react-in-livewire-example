import { defineConfig, resolveConfig, transformWithEsbuild } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin'
import react from '@vitejs/plugin-react'
import path from 'path'
import inspect from 'vite-plugin-inspect'
import {sync} from 'glob';
import {readFileSync} from 'fs';
const voltFiles = sync('resources/views/**/*.blade.php')
    .filter(file => {
        const contents = readFileSync(file);
        return (contents.includes('Mingle::volt()'));
    });

function myPlugin() {
 let isDevelopment = false;
  return {
    name: 'blade-tsx',
    enforce: 'pre',
    config(config, {mode}) {

        isDevelopment = mode === 'development';
        return {
          ...config,
          esbuild: {
            ...config.esbuild,
            include: /\.(js|ts|jsx|tsx|php)$/, // .myext
            loader: 'tsx',
          },
        };
      },

    async transform(src, id) {

      if (id.endsWith('.blade.php')) {
                //extract code between <script> tags
                const scriptRegex = /<script>([\s\S]*?)<\/script>/g;
                const scriptMatch = scriptRegex.exec(src);
                const scriptCode = scriptMatch[1];
                const name =`resources/views/${id.split('/resources/views/').pop()}`;
                const preparedCode = `
        import mingle from '@mingle/mingleReact';
        import React from 'react';
        ${scriptCode}
        mingle('${name}${isDevelopment ? '?import' : ''}', render);
        export default function() {

        }
        `

       return preparedCode;

      }
    },
  }
};

export default defineConfig({

    resolve: {
        extensions: ['.mjs', '.js', '.ts', '.jsx', '.tsx', '.json', '.blade.php'],
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            '@livewire': path.resolve(__dirname, 'resources/views/livewire'),
            "@mingle": path.resolve(__dirname, "/vendor/ijpatricio/mingle/resources/js"),
        }
    },
    server: {
        hmr: true
    },
    plugins: [
        inspect(),
        react({
            include: ['.js', '.jsx', '.ts', '.tsx', '.tsx.blade.php'],
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),

        myPlugin(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                ...voltFiles
            ],
            refresh: true
        }),

    ],
});
