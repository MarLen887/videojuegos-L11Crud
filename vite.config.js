import { defineConfig } from "vite";
export default defineConfig({
    base: '/videojuegos/dist',
    build:{
        manifest: true,
        rollupOptions: {
            input:[
                'assets/css/app.css',
                'assets/js/app.js'
            ],
        },
    },
})