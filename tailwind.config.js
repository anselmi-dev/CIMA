import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import preset from './vendor/filament/support/tailwind.config.preset'

const isProduction = process.env.NODE_ENV === 'production';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],

    plugins: [
        forms,
        typography
    ],

    
    theme: {
        screens: {
            'xs':'440px',
            ...defaultTheme.screens,
        },
        extend: {
            blur: {
                xs: '2px',
            },
            backdropBlur: {
                xs: '2px',
            },
            fontSize: {
                xxs: '0.6rem',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'infinite-scroll': 'infinite-scroll 25s linear infinite',
            },
            keyframes: {
                'infinite-scroll': {
                    from: { transform: 'translateX(0)' },
                    to: { transform: 'translateX(-100%)' },
                }
            },
            zIndex: {
                '1': '1',
                '2': '2',
                '3': '3',
                '4': '4',
                '5': '5',
                '50': '50',
                '100': '100',
            },
            colors: {
                A1: {
                    'default': '#009c8c',
                    'hover': '#0a655e',
                    '50': '#effefb',
                    '100': '#c7fff3',
                    '200': '#90ffe7',
                    '300': '#51f7db',
                    '400': '#1de4c8',
                    '500': '#04c8af',
                    '600': '#009c8c',
                    '700': '#058074',
                    '800': '#0a655e',
                    '900': '#0d544e',
                    '950': '#003331',
                },

                A2: {
                    'default': '#0087d1',
                    '50': '#f0f9ff',
                    '100': '#e0f2fe',
                    '200': '#b9e5fe',
                    '300': '#7cd1fd',
                    '400': '#36bbfa',
                    '500': '#0ca3eb',
                    '600': '#0087d1',
                    '700': '#0167a3',
                    '800': '#065786',
                    '900': '#0b496f',
                    '950': '#072e4a',
                },
    
                A3: {
                    'default': '#90dadb',
                    '50': '#f0fbfb',
                    '100': '#daf3f2',
                    '200': '#b8e9e9',
                    '300': '#90dadb',
                    '400': '#50bdc0',
                    '500': '#34a1a6',
                    '600': '#2e848c',
                    '700': '#2b6a73',
                    '800': '#2a5960',
                    '900': '#274a52',
                    '950': '#153137',
                },

                A4: {
                    'default': '#009c8c',
                    '50': '#effefb',
                    '100': '#c7fff3',
                    '200': '#90ffe7',
                    '300': '#51f7db',
                    '400': '#1de4c8',
                    '500': '#04c8af',
                    '600': '#009c8c',
                    '700': '#058074',
                    '800': '#0a655e',
                    '900': '#0d544e',
                    '950': '#003331',
                },

                A5: {
                    'default': '#00b2b7',
                    '50': '#edfffe',
                    '100': '#c0feff',
                    '200': '#81fbff',
                    '300': '#3af8ff',
                    '400': '#00ffff',
                    '500': '#00e1e2',
                    '600': '#00b2b7',
                    '700': '#008c91',
                    '800': '#006c72',
                    '900': '#04585d',
                    '950': '#00343a',
                },

                primary: {
                    '50': '#effefb',
                    '100': '#c7fff3',
                    '200': '#90ffe7',
                    '300': '#51f7db',
                    '400': '#1de4c8',
                    '500': '#04c8af',
                    '600': '#009c8c',
                    '700': '#058074',
                    '800': '#0a655e',
                    '900': '#0d544e',
                    '950': '#003331',
                }
            }
        }
    }
};
