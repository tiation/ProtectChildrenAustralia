export default function About() {
  return (
    <div className="container mx-auto px-4 py-12">
      <div className="max-w-4xl mx-auto">
        <h1 className="text-5xl font-bold mb-8 bg-gradient-to-r from-primary-light to-accent-light dark:from-primary-dark dark:to-accent-dark bg-clip-text text-transparent text-center">
          About Us
        </h1>
        
        <div className="prose prose-lg max-w-none dark:prose-invert">
          <p className="text-xl text-center mb-12 text-gray-600 dark:text-gray-300">
            Protect Children Australia is dedicated to safeguarding the wellbeing and future of Australia&apos;s most vulnerable population - our children.
          </p>
          
          <div className="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
            <div className="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg">
              <h2 className="text-3xl font-bold mb-4 text-primary-light dark:text-primary-dark">Our Mission</h2>
              <p className="text-gray-600 dark:text-gray-300">
                To create a safer Australia where every child can grow up free from harm, with access to the resources, 
                support, and protection they deserve. We work tirelessly to prevent child abuse and exploitation through 
                education, advocacy, and community engagement.
              </p>
            </div>
            
            <div className="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg">
              <h2 className="text-3xl font-bold mb-4 text-primary-light dark:text-primary-dark">Our Vision</h2>
              <p className="text-gray-600 dark:text-gray-300">
                A future where all Australian children live in safe, nurturing environments that allow them to thrive. 
                We envision communities that are informed, equipped, and committed to protecting children from harm 
                and ensuring their fundamental rights are respected.
              </p>
            </div>
          </div>
          
          <div className="mb-16">
            <h2 className="text-3xl font-bold mb-8 text-center">Our Impact</h2>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
              <div className="text-center p-6 bg-gradient-to-br from-primary-light/10 to-accent-light/10 dark:from-primary-dark/10 dark:to-accent-dark/10 rounded-2xl">
                <h3 className="text-4xl font-bold mb-2 text-primary-light dark:text-primary-dark">10,000+</h3>
                <p className="text-gray-600 dark:text-gray-300">Children Supported</p>
              </div>
              <div className="text-center p-6 bg-gradient-to-br from-primary-light/10 to-accent-light/10 dark:from-primary-dark/10 dark:to-accent-dark/10 rounded-2xl">
                <h3 className="text-4xl font-bold mb-2 text-primary-light dark:text-primary-dark">500+</h3>
                <p className="text-gray-600 dark:text-gray-300">Families Assisted</p>
              </div>
              <div className="text-center p-6 bg-gradient-to-br from-primary-light/10 to-accent-light/10 dark:from-primary-dark/10 dark:to-accent-dark/10 rounded-2xl">
                <h3 className="text-4xl font-bold mb-2 text-primary-light dark:text-primary-dark">100+</h3>
                <p className="text-gray-600 dark:text-gray-300">Community Partners</p>
              </div>
            </div>
          </div>
          
          <div className="bg-gradient-to-r from-primary-light/10 to-accent-light/10 dark:from-primary-dark/10 dark:to-accent-dark/10 p-8 rounded-2xl">
            <h2 className="text-3xl font-bold mb-4 text-center">Our Approach</h2>
            <p className="text-gray-600 dark:text-gray-300 mb-4">
              We believe that protecting children requires a comprehensive, community-based approach. Our work focuses on:
            </p>
            <ul className="space-y-2 text-gray-600 dark:text-gray-300">
              <li>• <strong>Prevention:</strong> Education and awareness programs to prevent abuse before it occurs</li>
              <li>• <strong>Protection:</strong> Direct support services for at-risk children and families</li>
              <li>• <strong>Partnership:</strong> Collaboration with government, organizations, and communities</li>
              <li>• <strong>Policy:</strong> Advocacy for stronger child protection laws and regulations</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  );
}