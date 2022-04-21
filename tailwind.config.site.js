//--------------------------------------------------------------------------
// Tailwind site configuration
//--------------------------------------------------------------------------
//
// Use this file to completely define the current sites design system by
// adding and extending to Tailwinds default utility classes.
//

const defaultTheme = require('tailwindcss/defaultTheme')
const plugin = require('tailwindcss/plugin')
const colors = require('tailwindcss/colors')

module.exports = {
  presets: [],
  theme: {
    // Here we define the default colors available. If you want to include
    // all default Tailwind colors you should extend the colors instead.
    colors: {
      black:   '#000',
      white:  '#fff',
      // Neutrals: neutral colors, with a default fallback if you don't need shades. Always set a DEFAULT when you use shades.
      neutral: {
        DEFAULT: '#414036',
        light: '#F4F4F1',
      },
      // Primary: primary brand color with a default fallback if you don't need shades. Always set a DEFAULT when you use shades.
      primary: 'var(--color-primary)',
      secondary: 'var(--color-secondary)',
      tertiary: 'var(--color-tertiary)',
    },
    extend: {
      animation: {
        'down': 'down var(--animation-navigation-down-duration) ease-in 1 both',
        'up': 'up var(--animation-navigation-up-duration) ease-out 1 both',
        'down-safe': 'down 0s ease-in 1 both',
        'up-safe': 'up 0s ease-out 1 both'
      },
      boxShadow: {
        top: '0 1px 5px rgba(65, 64, 54 ,0.3)'
      },
      keyframes: {
        down: {
          '0%': { transform: 'translate3d(0,-100%,0)', opacity: 0 },
          '10%, 100%': { opacity: 1 },
          '30%': { transform: 'translate3d(0,20%,0)' },
          '50%': { transform: 'translate3d(0,-10%,0)' },
          '70%': { transform: 'translate3d(0,5%,0)' },
          '90%': { transform: 'translate3d(0,-2%,0)' },
          '100%': { transform: 'translate3d(0,0,0)', },
        },
        up: {
          '0%': { transform: 'translate3d(0,0,0)', opacity: 1 },
          '75%': { opacity: 0 },
          '100%': { transform: 'translate3d(0,-100%,0)', opacity: 0 },
        }
      },
      // Set default transition durations and easing when using the transition utilities.
      transitionDuration: {
        DEFAULT: '300ms',
      },
      transitionTimingFunction: {
        DEFAULT: 'cubic-bezier(0.4, 0, 0.2, 1)',
      },
    },
    // Remove the font families you don't want to use.
    fontFamily: {
      mono: [
        // Use a custom mono font for this site by changing 'Anonymous' to the
        // font name you want and uncommenting the following line.
        // 'Anonymous',
        ...defaultTheme.fontFamily.mono,
      ],
      sans: [
        // Use a custom sans serif font for this site by changing 'Gaultier' to the
        // font name you want and uncommenting the following line.
        'BreveSansText',
        ...defaultTheme.fontFamily.sans,
      ],
      title: [
        // Use a custom serif font for this site by changing 'Lavigne' to the
        // font name you want and uncommenting the following line.
        'BreveDisplay',
        ...defaultTheme.fontFamily.serif,
      ],
    },
    // The font weights available for this site.
    fontWeight: {
      // hairline: 100,
      // thin: 200,
      light: 300,
      normal: 400,
      medium: 500,
      semibold: 600,
      // bold: 700,
      // extrabold: 800,
      // black: 900,
    },
  },
  plugins: [
    plugin(function({ addBase, theme }) {
      addBase({
        ':root': {
          '--color-primary': '#13E87C',
          '--color-secondary': '#FF0274',
          '--color-tertiary': '#0098F1',
          '--animation-navigation-down-duration': '.6s',
          '--animation-navigation-up-duration': '.3s'
        },
        '@supports (color: color(display-p3 1 1 1))': {
            ':root': {
                '--color-primary': 'color(display-p3 0.07450980392 0.9098039216 0.4862745098)',
                '--color-secondary': 'color(display-p3 1 0.007843137255 0.4549019608)',
                '--color-tertiary': 'color(display-p3 0 0.5960784314 0.9450980392)'
            }
        },
        // Default color transition on links unless user prefers reduced motion.
        '@media (prefers-reduced-motion: no-preference)': {
          'a': {
            transition: 'color .3s ease-in-out',
          },
        },
        'html': {
            color: theme('colors.neutral.DEFAULT'),
            //--------------------------------------------------------------------------
            // Set sans, serif or mono stack with optional custom font as default.
            //--------------------------------------------------------------------------
            // fontFamily: theme('fontFamily.mono'),
            fontFamily: theme('fontFamily.sans'),
            fontWeight: theme('fontWeight.medium'),
            // fontFamily: theme('fontFamily.serif'),
        },
      })
    }),

    // Custom components for this particular site.
    plugin(function({ addComponents, theme }) {
      const components = {
      }
      addComponents(components)
    }),

    // Custom utilities for this particular site.
    plugin(function({ addUtilities, theme, variants }) {
      const newUtilities = {
      }
      addUtilities(newUtilities)
    }),
  ]
}
