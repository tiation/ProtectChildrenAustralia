import Link from 'next/link';

export default function Home() {
  return (
    <div className="container mx-auto px-4 py-12">
      {/* Hero Section */}
      <section className="text-center py-20">
        <h1 className="text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark bg-clip-text text-transparent">
          Protecting Australia&apos;s Children
        </h1>
        <p className="text-xl md:text-2xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto mb-10">
          Empowering communities to create a safer future for every child
        </p>
        <div className="flex gap-4 justify-center">
          <Link
            href="/donate"
            className="px-8 py-3 bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark text-white rounded-full hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all text-lg font-semibold"
          >
            Make a Difference
          </Link>
          <Link
            href="/about"
            className="px-8 py-3 border-2 border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200 rounded-full hover:border-primary-light dark:hover:border-primary-dark transition-colors text-lg font-semibold"
          >
            Learn More
          </Link>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-20 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div className="p-6 rounded-2xl bg-white dark:bg-gray-900 shadow-lg hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all">
          <h3 className="text-2xl font-bold mb-4 text-primary-light dark:text-primary-dark">Education</h3>
          <p className="text-gray-600 dark:text-gray-300">Providing resources and training to help communities recognize and prevent child abuse.</p>
        </div>
        <div className="p-6 rounded-2xl bg-white dark:bg-gray-900 shadow-lg hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all">
          <h3 className="text-2xl font-bold mb-4 text-primary-light dark:text-primary-dark">Support</h3>
          <p className="text-gray-600 dark:text-gray-300">Offering assistance and guidance to families and organizations in need.</p>
        </div>
        <div className="p-6 rounded-2xl bg-white dark:bg-gray-900 shadow-lg hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all">
          <h3 className="text-2xl font-bold mb-4 text-primary-light dark:text-primary-dark">Advocacy</h3>
          <p className="text-gray-600 dark:text-gray-300">Working with policymakers to strengthen child protection laws and regulations.</p>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 text-center bg-gradient-to-r from-primary-light/10 to-accent-light/10 dark:from-primary-dark/10 dark:to-accent-dark/10 rounded-3xl">
        <h2 className="text-4xl font-bold mb-6">Join Our Mission</h2>
        <p className="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-8">
          Together, we can create a safer Australia for all children. Your support makes a difference.
        </p>
        <Link
          href="/contact"
          className="px-8 py-3 bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark text-white rounded-full hover:shadow-neon-light dark:hover:shadow-neon-dark transition-all text-lg font-semibold inline-block"
        >
          Get Involved
        </Link>
      </section>
    </div>
  );
}
