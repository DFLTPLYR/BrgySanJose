import prettier from 'eslint-config-prettier';
import vue from 'eslint-plugin-vue';
import { defineConfig } from 'eslint-define-config';

export default defineConfig({
extends: [
    ...vue.configs['flat/essential'],
    'prettier',
],
ignores: [
    'vendor',
    'node_modules',
    'public',
    'bootstrap/ssr',
    'tailwind.config.js',
    'resources/js/components/ui/*',
],
rules: {
    'vue/multi-word-component-names': 'off',
    // Removed TypeScript-specific rules
    prettier
},
});
