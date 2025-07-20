export const themeConfig = {
  colors: {
    primary: {
      light: '#00fff2', // cyan
      dark: '#ff00ff', // magenta
    },
    background: {
      light: {
        start: '#ffffff',
        end: '#f3f4f6',
      },
      dark: {
        start: '#000000',
        end: '#111827',
      },
    },
    text: {
      light: '#1f2937',
      dark: '#f9fafb',
    },
    accent: {
      light: '#00fff2',
      dark: '#ff00ff',
    },
  },
  gradients: {
    primary: {
      light: 'bg-gradient-to-r from-cyan-400 to-cyan-600',
      dark: 'bg-gradient-to-r from-fuchsia-500 to-cyan-500',
    },
    background: {
      light: 'bg-gradient-to-br from-white to-gray-100',
      dark: 'bg-gradient-to-br from-gray-950 to-gray-900',
    },
  },
  shadows: {
    neon: {
      light: '0 0 10px rgba(0, 255, 242, 0.5), 0 0 20px rgba(0, 255, 242, 0.3)',
      dark: '0 0 10px rgba(255, 0, 255, 0.5), 0 0 20px rgba(0, 255, 242, 0.3)',
    },
  },
};
