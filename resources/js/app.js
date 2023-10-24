// resources/js/app.js
import 'bootstrap/dist/css/bootstrap.min.css';
import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
