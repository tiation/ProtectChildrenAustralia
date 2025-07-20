'use client';

import Link from 'next/link';
import { ThemeToggle } from './ThemeToggle';

export const Header = () => {
  return (
    <header className="fixed top-0 w-full bg-white/80 dark:bg-gray-950/80 backdrop-blur-sm z-50 border-b border-gray-200 dark:border-gray-800">
      <nav className="container mx-auto px-4 py-4 flex justify-between items-center">
        <Link 
          href="/" 
          className="text-2xl font-bold bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark bg-clip-text text-transparent hover:opacity-80 transition-opacity"
        >
          Protect Children Australia
        </Link>
        
        <div className="flex items-center space-x-6">
          <Link 
            href="/about" 
            className="text-gray-600 dark:text-gray-300 hover:text-primary-light dark:hover:text-primary-dark transition-colors"
          >
            About
          </Link>
          <Link 
            href="/resources" 
            className="text-gray-600 dark:text-gray-300 hover:text-primary-light dark:hover:text-primary-dark transition-colors"
          >
            Resources
          </Link>
          <Link 
            href="/contact" 
            className="text-gray-600 dark:text-gray-300 hover:text-primary-light dark:hover:text-primary-dark transition-colors"
          >
            Contact
          </Link>
          <Link 
            href="/donate" 
            className="px-4 py-2 bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark text-white rounded-full hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all"
          >
            Donate
          </Link>
          <ThemeToggle />
        </div>
      </nav>
    </header>
  );
};
