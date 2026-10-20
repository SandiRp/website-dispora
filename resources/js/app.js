

import Alpine from 'alpinejs';
import { installMedia } from './media';

window.Alpine = Alpine;

installMedia(Alpine);
Alpine.start();
